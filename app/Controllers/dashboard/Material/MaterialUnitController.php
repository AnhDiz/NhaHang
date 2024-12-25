<?php

namespace App\Controllers\dashboard\Material;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MaterialUnit;

class MaterialUnitController extends BaseController
{
    private $materialmodel;
    public function __construct() {
        parent::__construct();
        $this->materialmodel = new MaterialUnit();
        $this->materialmodel->protect(false);
    }
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $data =[
            'types' => $this->materialmodel->search($search, $perPage, $offset),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->materialmodel->getCount($search),
        ];
        return view('admin/materialunit/table',$data);
    }
    public function add()
    {
        return view('admin/materialunit/add');
    }
}
