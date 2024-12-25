<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use App\Common\Result;


class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password','group_id'];
    public function searchUsers($search = '', $perPage = 10, $offset = 0,$group ='')
    {
        if ($search) {
            $this->like('name', $search)
                 ->orLike('email', $search);
        }
        if($group){
            $this->like('group_id',$group);
        }
        return $this->orderBy('id', 'DESC')
                    ->findAll($perPage, $offset);
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('name', $search)
                 ->orLike('email', $search);
        }

        return $this->countAllResults();
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
    public function UpdateUserInfo($requestData){
        $validate = $this->validateEditUser($requestData);

        if($validate->getErrors()){
            return [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => $validate->getErrors()
            ];
        }
        $datasave = $requestData->getPost();
        if(!empty($datasave['change_password'])){
            unset($datasave['change_password']);
            unset($datasave['password_confirm']);
            $datasave['password'] = password_hash($datasave['password'],PASSWORD_BCRYPT);
        }else{
            unset($datasave['password']);
            unset($datasave['password_confirm']);
        }
        $session = session();
        if($datasave['id'] == $session->get('id')){
            $session->set($datasave);
        }
        $this->users->save($datasave);
        return[
            'status' => Result::STATUS_CODE_OK,
            'messageCode' => Result::MESSAGE_CODE_OK,
            'message' => ['thành công' => 'Cập nhập tài khoản thành công']
        ];
    }

    private function ValidateEditUser($requestData){
        $rule = [
            'email' => 'valid_email|is_unique[user.email, id,'.$requestData->getPost()['id'].']',
            'name' => 'max_length[100]',
        ];
        $messages = [
            'email'=>[
                'valid_email' => 'email không đúng dịnh dạng!',
                'is_unique' => 'email đã tồn tại tài khoản'
            ],
            'name' =>[ 
                'max_length' => 'Tên quá dài'
            ],
            //
        ];
        if(!empty($requestData->getPost()['change_password'])){
            $rule['password'] = 'max_length[30]|min_length[8]';
            $rule['password_confirm'] = 'matches[password]';

            $messages=[
                'password' =>[ 
                    'max_length' => 'Mật khẩu quá dài',
                    'min_length' => 'Mật khẩu tối thiểu phải có 8 ký tự'
                ],
                'password_confirm' =>[
                    'matches' => 'Mật khẩu không khớp'
                ]
            ];
        };
        $this->validation->setRules($rule,$messages);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }
    
}
