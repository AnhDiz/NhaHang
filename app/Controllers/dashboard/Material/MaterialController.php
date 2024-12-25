<?php

namespace App\Controllers\dashboard\Material;

use App\Controllers\BaseController;
use App\Controllers\Notification\NotificationController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MaterialModel;
use App\Models\MaterialType;
use App\Models\MaterialUnit;
use App\Models\ExtractMaterialModel;
use App\Common\Result;



class MaterialController extends BaseController
{
    private $materialmodel;
    private $notification;
    public function __construct() {
        parent::__construct();
        $this->materialmodel = new MaterialModel();
        $this->materialmodel->protect(false);
        $this->notification = new NotificationController();
    }
    public function index()
    {
        $units = new MaterialUnit();
        $types = new MaterialType();
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $typefilter = $this->request->getGet('typefilter') ?? '';
        $unitfilter = $this->request->getGet('unitfilter') ?? '';
        $data =[
            'materials' => $this->materialmodel->search($search, $perPage, $offset,$typefilter,$unitfilter),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->materialmodel->getCount($search),
            'types' => $types->findAll(),
            'units' => $units->findAll(),
            'typefilter' => $typefilter,
            'unitfilter' => $unitfilter
        ];
        return view('admin/materials/table',$data);
    }
    public function add(){
        $types = new MaterialType();
        $unit = new MaterialUnit();
        $data =[
            'types' => $types->findAll(),
            'units' => $unit->findAll(),
        ];
        return view('admin/materials/add',$data);
    }
    public function create(){
        $data = $this->request->getPost();
        // dd($data['materials']);

        if (!empty($data)) {
            foreach ($data['materials'] as $product) {
                $this->materialmodel->save([
                    'name' => $product['name'],
                    'material_type_id' => $product['material_type_id'],
                    'unit' => $product['unit'],
                    'number_start' => $product['number_start'],
                    'number_now' => $product['number_start'],
                    'price_per_unit' => $product['price_per_unit'],
                    'time' => $product['time'],
                ]);
                
            }
            $this->notification->create('hệ thống',);
            return redirect()->to('/dashboard/material')->with(Result::MESSAGE_CODE_OK, 'Sản phẩm đã được thêm thành công!');
        }
        return redirect()->back()->with('error', 'Vui lòng nhập ít nhất một sản phẩm!');
    }
    public function updateid(){
        $material_id = $this->request->getPost('user_id');
        $newupdate = $this->request->getPost('role');
        $name = $this->request->getPost('name');
        $userModel = new MaterialModel();
        $userModel->update($material_id, [$name => $newupdate]);
        return $this->response->setJSON(['status' => 'success']);
    }
    public function extract(){
        $units = new MaterialUnit();
        $types = new MaterialType();
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $typefilter = $this->request->getGet('typefilter') ?? '';
        $unitfilter = $this->request->getGet('unitfilter') ?? '';
        $data = $this->materialmodel->select()->findAll();
        $data =[
            'materials' => $this->materialmodel->search($search, $perPage, $offset,$typefilter,$unitfilter),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->materialmodel->getCount($search),
            'types' => $types->findAll(),
            'units' => $units->findAll(),
            'typefilter' => $typefilter,
            'unitfilter' => $unitfilter
        ];
        return view('admin/materials/extract',$data);
    }
    public function getbytype() {
        $type_id = $this->request->getGetPost('type_id');

        if (empty($type_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Type ID is required']);
            return;
        }
        $materials = $this->materialmodel->getMaterialsByType($type_id);

        echo json_encode(['status' => 'success', 'data' => $materials]);
    }
    public function extractM(){
        // dd($this->request->getPost('materials'));
        $data = $this->request->getPost('materials');
        if(empty($data)){
            return redirect()->back()->with('error', 'Vui lòng nhập ít nhất một sản phẩm!');
        }
        $extract = new ExtractMaterialModel();
        foreach($data as $material){
            $extract->save($material);
            $numberRow = $this->materialmodel->select('number_now')->where('material_id',$material['material_id'])->first();
            $number = $numberRow['number_now'];
            $number = $number - $material['quanity'];
            if($number == 0){
                $this->materialmodel->delete(['material_id'=>$material['material_id']]);
            }
            $this->materialmodel->update($material['material_id'],['number_now'=>$number]);
        }
        return redirect()->to('/dashboard/material')->with('success', 'xuất kho thành công');
    }
}
