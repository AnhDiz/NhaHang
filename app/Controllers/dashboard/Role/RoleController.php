<?php

namespace App\Controllers\Dashboard\Role;

use App\Controllers\BaseController;
use App\Models\Rolemodel;
use Exception;
use App\Common\Result;

class RoleController extends BaseController
{
    private $rolemodel;
    function __construct()
    {
        parent::__construct();
        $this->rolemodel = new Rolemodel();
        $this->rolemodel->protect(false);
    }
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $typefilter = $this->request->getGet('typefilter') ?? '';
        $types = $this->rolemodel->select('type')->findAll();
        $uniquetypes = [];
        foreach($types as $type){
            $uniquetypes[$type['type']] = $type['type'];
        }
        $uniquetypes = array_values($uniquetypes);
        $data =[
            'roles' => $this->rolemodel->search($search, $perPage, $offset,$typefilter),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->rolemodel->getCount($search),
            'typefilter' => $typefilter,
            'types' => $uniquetypes,
        ];
        return view('admin/role/table',$data);
    }
    public function add(){
        return view('admin/role/add');
    }
    public function create(){
        try {
            $data = $this->request->getPost();
            // dd($data);
            $datasave[] = [
                'url' => $data['url'],
                'description' =>'xem danh sách '. $data['description'],
                'type' => $data['type']
            ];
            $title = [
                'add' => 'thêm mới',
                'edit' => 'sửa',
                'delete' => 'xóa'
            ]; 
            foreach($data['types'] as $type):
                $datasave[] = [
                    'url' => $data['url'].'/'.$type,
                    'description' => $title[$type].' '. $data['description'],
                    'type' => $data['type']
                ];  
            endforeach;
            // dd($datasave);
            foreach($datasave as $save):
                $this->rolemodel->save($save);
            endforeach;
            $result=[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Cập nhập quyền mới thành công']
            ];
        } catch (Exception $th) {
            $result =[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
        return redirect('dashboard/role')->withInput()->with($result['messageCode'],$result['message']);
    }
    public function edit($id){
        $data['role'] = $this->rolemodel->where('role_id',$id)->first();
        return view('admin/role/edit',$data);
    }
    public function update(){
        try {
            $data = $this->request->getPost();
            $this->rolemodel->save($data);
            $result=[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Cập nhập quyền thành công']
            ];
        } catch (Exception $th) {
            $result =[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
        return redirect('dashboard/role')->withInput()->with($result['messageCode'],$result['message']);
    }
    public function delete($id){
        // dd($id);
        try {;
            $this->rolemodel->delete(['role_id'=>$id]);
            $result=[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Xóa quyền thành công']
            ];
        } catch (Exception $th) {
            $result =[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
        return redirect('dashboard/role')->withInput()->with($result['messageCode'],$result['message']);
    }
}
