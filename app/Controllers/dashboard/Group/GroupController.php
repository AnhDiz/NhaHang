<?php

namespace App\Controllers\Dashboard\Group;

use App\Controllers\BaseController;
use App\Models\GroupModel;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use Exception;
use App\Common\Result;
use App\Controllers\dashboard\Permission\PermissionController;

class GroupController extends BaseController
{
    private $groupmodel;
    function __construct()
    {
        parent::__construct();
        $this->groupmodel = new GroupModel();
        $this->groupmodel->protect(false);
    }
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $data =[
            'groups' => $this->groupmodel->search($search, $perPage, $offset),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->groupmodel->getCount($search),
        ];
        return view('admin/group/table',$data);
        
    }
    public function add(){
        $groupmodel = new GroupModel();
        $rolemodel = new RoleModel();
        $pmmodel = new PermissionModel();
        $groupedRoles = [];
        $roles = $rolemodel->findAll();
        foreach ($roles as $role) {
            $groupedRoles[$role['type']][] = $role; // Nhóm quyền theo type
        }
        // dd($groupedRoles);
        $data =[
            'roles' => $rolemodel->findAll(),
            'permissions' => $pmmodel->findAll(),
            'groupedRoles' => $groupedRoles
        ];
        return view('admin/group/add',$data);
    }
    public function create(){
        // dd($this->request);
        $result = $this->AddGroupInfo($this->request);
        // dd($result);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
    }
    public function edit($id){
        $groupmodel = new GroupModel();
        $rolemodel = new RoleModel();
        $pmmodel = new PermissionModel();
        $groupedRoles = [];
        $roles = $rolemodel->findAll();
        foreach ($roles as $role) {
            $groupedRoles[$role['type']][] = $role; // Nhóm quyền theo type
        }
        // dd($groupedRoles);
        $data =[
            'group' => $groupmodel->where('group_id',$id)->first(),
            'roles' => $rolemodel->findAll(),
            'permissions' => $pmmodel->findAll(),
            'groupedRoles' => $groupedRoles
        ];
        return view('admin/group/edit',$data);
    }
    public function AddGroupInfo($requestData){
        $validate = $this->ValidateAddGroup($requestData);
        if($validate->getErrors()){
            return [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => $validate->getErrors()
            ];
        }
        
        $datasave = $requestData->getPost();
        try {
            $role = $datasave['role'];
            unset($datasave['role']);
            // dd($role);
            $this->groupmodel->save($datasave);
            $id = $this->groupmodel->select('group_id')->where('groupName',$datasave['groupName'])->first();
            $PermissionController = new PermissionController();
            $PermissionController->add($id,$role);
            return[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Thêm chức vụ thành công']
            ];
        } catch (Exception $th) {
            return[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
    }
    private function ValidateAddGroup($requestData){
        $rule = [
            'groupName' => 'is_unique[group.groupName]',
        ];
        $messages = [
            'groupName'=>[
                'is_unique' => 'chức vụ đã tồn tại'
            ]
        ];
        $this->validation->setRules($rule,$messages);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }
    public function delete($id){

        $result = $this->DeleteGroup($id);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
    }
    public function DeleteGroup($id){
        try {
            $this->groupmodel->delete(['id'=>$id]);
            return[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Xoá chức vụ thành công']
            ];
        } catch (Exception $th) {
            return[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
    }
    public function update(){
        try {
            $data = $this->request->getPost();
            $PermissionController = new PermissionController();
            $PermissionController->update($data);
            unset($data['role']);
            $this->groupmodel->save($data);
            $result=[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Cập nhập chức vụ thành công']
            ];
        } catch (Exception $th) {
            $result =[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
        return redirect('dashboard/group')->withInput()->with($result['messageCode'],$result['message']);
    }
}
