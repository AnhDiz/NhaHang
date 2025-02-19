<?php

namespace App\Controllers\Dashboard\Table;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Common\Result;
use App\Models\TableModel;
use App\Models\StatusTableModel;
use App\Controllers\Notification\NotificationController;
use App\Models\TableDishModel;
use App\Models\DishModel;

class TableDishController extends BaseController
{
    private $TB;
    private $tables;
    private $dishs;
    private $notification;
    function __construct()
    {
        parent::__construct();
        $this->tables = new TableModel();
        $this->tables->protect(false);
        $this->dishs = new DishModel();
        $this->dishs->protect(false);
        $this->TB = new TableDishModel();
        $this->TB->protect(false);
        $this->notification = new NotificationController();
    }
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $capacityfilter = $this->request->getGet('capacityfilter') ?? '';
        $status = new StatusTableModel();
        // dd($capacityfilter);
        $data =[
            'tabledishs' => $this->TB->findAll(),
            'dishs' => $this->dishs->select('dish_id,name')->findAll(),
            'tables' => $this->tables->select('id,table_num')->findAll(),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->tables->getCount($search),
            'capacityfilter' => $capacityfilter,
            'status' => $status->findAll(),
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
        ];
        return view('admin/TableDish/table',$data);
    }
}
