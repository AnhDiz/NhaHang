<?php

namespace App\Controllers\account;

use App\Controllers\BaseController;
use App\Models\UserModel;

use Exception;
use App\Common\Result;


class AccountController extends BaseController
{
    private $otp;
    private $users;
    function __construct()
    {
        parent::__construct();
        $this->users = new UserModel();
        $this->users->protect(false);
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
            return redirect()->to('/login');
        }
    }
    public function regist(){
        return view(('regist'));
    }
    public function create(){
        $result = $this->AddUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
    }
    public function sendemail($datasave){
        $to = $datasave['email'];
        $sub = 'Đăng ký tài khoản';
        $this->otp = $this->generateOTP(6);
        $message = 'Mã xác nhận của bạn: '. $this->otp;

        $email = \Config\Services::email();
        $email->setFrom('htalol1106@gmail.com');
        $email->setTo($to);
        $email->setSubject($sub);
        $email->setMessage($message);
        if($email->send()){
           return view('otpform');
        }
    }
    function generateOTP($length = 6)
    {
        $characters = '0123456789'; // Use numeric characters for OTP
        $otp = '';

        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $otp;
    }
    public function otp(){

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

        $datasave['is_admin'] = '0';
        $datasave['is_inside'] = '0';
        $datasave['group_id'] = '2';
        unset($datasave['password_confirm']);
        $datasave['password'] = password_hash($datasave['password'],PASSWORD_BCRYPT);
        try {
            $this->users->save($datasave);
            $this->sendemail($datasave);
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
}
