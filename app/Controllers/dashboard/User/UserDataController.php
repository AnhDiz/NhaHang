<?php

namespace App\Controllers\dashboard\User;

use App\Controllers\BaseController;
use Exception;
use App\Common\Result;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Controllers\Notification\NotificationController;
class UserDataController extends BaseController
{
    private $users;
    private $notification;
    function __construct()
    {
        parent::__construct();
        $this->users = new UserModel();
        $this->users->protect(false);
        $this->notification = new NotificationController();
    }

    // use ResponseTrait;
    public function index()
    {
        $groupmodel = new GroupModel();
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $groupfilter = $this->request->getGet('groupfilter') ?? '';
        $data =[
            'groups' => $groupmodel->findAll(),
            'users' => $this->users->searchUsers($search, $perPage, $offset,$groupfilter),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->users->getCount($search),
            'groupfilter' => $groupfilter,
        ];
        return view('admin/user/table',$data);
    }
    public function Add(){
        $groupmodel = new GroupModel();
        $data = [
            'groups' => $groupmodel->findAll(),
        ];
        return view('admin/user/add',$data);
    }
    public function create(){
        $result = $this->AddUserInfo($this->request);
        $this->notification->create('hệ thống',);
        // dd($result);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
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
        $datasave['is_inside'] = '1';
        unset($datasave['password_confirm']);
        $datasave['password'] = password_hash($datasave['password'],PASSWORD_BCRYPT);
        try {
            $this->users->save($datasave);
            return[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Thêm tài khoản thành công']
            ];
        } catch (Exception $th) {
            return[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['thành công' => $th->getMessage()]
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
    
    public function edit($id){
        $groupmodel = new GroupModel();
        $data =[
            'user' => $this->GetUserByID($id),
            'groups' => $groupmodel->findAll()
        ];
        return view('admin/user/edit',$data);
    }
    public function GetUserByID($id){
        return $this->users->where('id',$id)->first();
    }
    public function update(){
        $result = $this->users->UpdateUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
    }
    public function delete($id){
        $result = $this->DeleteUser($id);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
    }
    public function DeleteUser($id){
        try {
            $this->users->delete(['id'=>$id]);
            return[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Xoá tài khoản thành công']
            ];
        } catch (Exception $th) {
            return[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
    }
    public function updateGroupid(){
        $userId = $this->request->getPost('user_id');
        $newRole = $this->request->getPost('role');
        $userModel = new UserModel();
        $userModel->update($userId, ['group_id' => $newRole]);
        return $this->response->setJSON(['status' => 'success']);
    }
}
