<?php

namespace App\Controllers\Dashboard\Permission;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Common\Result;

use Exception;

class PermissionController extends BaseController
{
    function __contract(){
        parent::__construct();
    }
    public function add($id,$data){
        $pmmodel = new PermissionModel();
        // dd($data);
        try {
            foreach($data as $role):{
                $pm = [
                    'group_id' => $id,
                    'role_id' => $role
                ];
                $pmmodel->insert($pm);
            }endforeach;
            
            $result = [
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'chỉnh sửa quyền thành công']
            ];
        } catch (Exception $th) {
            $result = [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }

    }
    public function update($data){
        // dd($this->request->getPost());
        $pmmodel = new PermissionModel();
        $pmmodel->where('group_id',$data['group_id'])->delete();
        
        try {
            foreach($data['role'] as $role):{
                $pm = [
                    'group_id' => $data['group_id'],
                    'role_id' => $role
                ];
                $pmmodel->insert($pm);
            }endforeach;
            
            $result = [
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'chỉnh sửa quyền thành công']
            ];
        } catch (Exception $th) {
            $result = [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
        return redirect('dashboard/permission')->withInput()->with($result['messageCode'],$result['message']);
    }
}
