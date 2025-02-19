<?php

namespace App\Controllers\Dashboard\Table;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Common\Result;
use App\Models\TableModel;
use App\Models\PreOrderModel;
use App\Models\StatusTableModel;
use App\Controllers\Notification\NotificationController;

class TableController extends BaseController
{
    private $tables;
    private $notification;
    function __construct()
    {
        parent::__construct();
        $this->tables = new TableModel();
        $this->tables->protect(false);
        $this->notification = new NotificationController();
    }
    public function index()
    {
        $preoderp = new PreOrderModel();
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $capacityfilter = $this->request->getGet('capacityfilter') ?? '';
        $status = new StatusTableModel();
        // dd($capacityfilter);
        $data =[
            'capacitys' => $preoderp->findAll(),
            'tables' => $this->tables->searchtables($search, $perPage, $offset,$capacityfilter),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->tables->getCount($search),
            'capacityfilter' => $capacityfilter,
            'status' => $status->findAll(),
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
        ];
        return view('admin/table/table',$data);
    }
    public function updateid(){
        $material_id = $this->request->getPost('user_id');
        $newupdate = $this->request->getPost('role');
        $name = $this->request->getPost('name');
        $userModel = new TableModel();
        $userModel->update($material_id, [$name => $newupdate]);
        return $this->response->setJSON(['status' => 'success']);
    }
    public function getbyfloor(){
        $floor = $this->request->getGetPost('floor');

        if (empty($floor)) {
            echo json_encode(['status' => 'error', 'message' => 'Type ID is required']);
            return;
        }
        $tables = $this->tables->getByfloor($floor);
        $row = 5;
        $col = 5;

        echo json_encode(['status' => 'success', 'data' => $tables,'row' => $row, 'col' => $col]);
    }
    public function add(){
        $data =[
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
        ];
        return view('admin/table/add',$data);
    }
    public function create(){
        $data = $this->request->getPost();
        $data['status']= '1';
        try {
            $this->tables->save($data);
            $return =[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Thêm tài khoản thành công']
            ];
            
        } catch (Exception $th) {
            $return =[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['thành công' => $th->getMessage()]
            ];
        }
        return redirect()->back()->withInput()->with($return['messageCode'],$return['message']);
    }
    public function delete($id){
        $result = $this->Deletetables($id);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
    }
    public function Deletetables($id){
        try {
            $this->tables->delete(['id'=>$id]);
            return[
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Xoá bàn thành công']
            ];
        } catch (Exception $th) {
            return[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
    }
    public function edit($id){
        $preoderp = new PreOrderModel();
        $status = new StatusTableModel();
        // dd($capacityfilter);
        $data =[
            'capacitys' => $preoderp->findAll(),
            'table' => $this->tables->where('id',$id)->first(),
            'status' => $status->findAll(),
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
        ];
        return view('admin/table/edit',$data);
    }
    public function update(){
        try{
        $data = $this->request->getPost();
        $id = $data['id'];
        unset($data['id']);
        if($this->tables->update($id,$data)) {
            $result= [
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Cập nhật thành công']
            ];
            return redirect()->to('dashboard/table')->withInput()->with($result['messageCode'], $result['message']);
        }} catch(Exception $e){
            $result=[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $e->getMessage()]
            ];
            return redirect()->back()->withInput()->withInput()->with($result['messageCode'], $result['message']);
        }
    }
    
}
