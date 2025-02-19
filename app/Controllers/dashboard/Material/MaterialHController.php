<?php

namespace App\Controllers\dashboard\Material;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ExtractMaterialModel;
use App\Models\MaterialType;
use App\Models\MaterialModel;
use App\Models\MaterialUnit;

class MaterialHController extends BaseController
{
    private $tables;
    private $materialh;
    function __construct()
    {
        parent::__construct();
        $this->materialh = new ExtractMaterialModel();
        $this->materialh->protect(true);
        $this->tables = new MaterialModel();
    }
    public function index()
    {
        $units = new MaterialUnit();
        $types = new MaterialType();
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $table = $this->tables->select('material_id, name')->findAll();
        $offset = ($currentPage - 1) * $perPage;
        $typefilter = $this->request->getGet('typefilter') ?? '';
        $unitfilter = $this->request->getGet('unitfilter') ?? '';
        $data =[
            'materials' => $this->tables->search($search, $perPage, $offset,$typefilter,$unitfilter),
            'materialhs' => $this->materialh->select('material_id,quanity')->findAll(),
            'search' => $search,
            'perPage' => $perPage,
            'tables' => $table,
            'types' => $types->findAll(),
            'units' => $units->findAll(),
            'currentPage' => $currentPage,
            'typefilter' => $typefilter,
            'unitfilter' => $unitfilter,
            'total' => $this->materialh->getCount($search)
        ];
        return view('admin/materialhistory/table',$data);
    }
}
