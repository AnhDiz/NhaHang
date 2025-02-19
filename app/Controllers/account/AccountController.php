<?php

namespace App\Controllers\account;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Controllers\MailController;
use Exception;
use App\Common\Result;


class AccountController extends BaseController
{
    private $mail;
    private $users;
    function __construct()
    {
        parent::__construct();
        $this->users = new UserModel();
        $this->users->protect(false);
        $this->mail = new MailController();
    }
    public function index()
    {
        return view('login');
    }
    public function login()
    {
        $session = session();
        $usermodel = new UserModel();
        $username = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $usermodel->where('email', $username)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'name' => $data['name'],
                    'email'    => $data['email'],
                    'phone_num' =>$data['phone_number'],
                    'group_id' => $data['group_id'],
                    'logged_in'     => TRUE,
                    'is_admin' => $data['is_admin'],
                    'is_inside' => $data['is_inside']
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/dang_nhap');
            }
        }else{
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/dang_nhap');
        }
    }
    public function regist(){
        return view(('regist'));
    }
    public function create(){
        $result = $this->AddUserInfo($this->request);
        if($result['messageCode'] == Result::MESSAGE_CODE_ERR){
            return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
        }else{
            $request = $this->request->getPost(); 
            $data = ['email'=> $request['email']];
            // dd($data);
            return view('otpform',$data);
        }
    }
    public function AddUserInfo($requestData){
        $validate = $this->validateAddUser($requestData);

        if($validate->getErrors()){
            return [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => $validate->getErrors()
            ];
        }

        $datasave = $requestData->getPost();
        // dd($datasave);
        $datasave['is_admin'] = '0';
        $datasave['is_inside'] = '0';
        $datasave['group_id'] = '2';
        $registemail = $datasave['email'];
        // dd($email);
        $otp = $this->mail->generateOTP(6);
        $datasave['otp'] = $otp;
        unset($datasave['password_confirm']);
        $datasave['password'] = password_hash($datasave['password'],PASSWORD_BCRYPT);
        try {
            $this->users->save($datasave);
            $this->mail->sendeotp($registemail,$otp);
            return[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Đăng ký tài khoản thành công']
            ];
        } catch (Exception $th) {
            return[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['thất bại' => $th->getMessage()]
            ];
        }
    }
    private function ValidateAddUser($requestData){
        $rule = [
            'email' => 'valid_email|is_unique[user.email]',
            'name' => 'max_length[100]',
            'password' => 'max_length[30]|min_length[8]',
            'password_confirm' => 'matches[password]'
        ];
        $messages = [
            'email'=>[
                'valid_email' => 'email không đúng dịnh dạng!',
                'is_unique' => 'email đã tồn tại tài khoản'
            ],
            'name' =>[ 
                'max_length' => 'Tên quá dài'
            ],
            'password' =>[
                'max_length' => 'Mật khẩu quá dài',
                'min_length' => 'Mật khẩu tối thiểu phải có 8 ký tự'
            ],
            'password_confirm' =>[
                'matches' => 'Mật khẩu không khớp'
            ]
        ];
        
        $this->validation->setRules($rule,$messages);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/dang_nhap');
    }
    public function otp(){
        $result = $this->checkotp($this->request);
        if($result){
            return redirect()->to('dang_nhap');
        }
        
    }
    public function checkotp($request){
        $data = $request->getPost();
        $db_otp = $this->users->select('otp')->where('email',$data['email'])->first();
        if ($db_otp == $data['otp']){
            return true;
        }else{
            return[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['thất bại' => 'max otp không chính xác']
            ];
        }
    }
}
