<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TableModel;
use App\Models\PreOrderModel;
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
        $capacityfilter = $this->request->getGet('group') ?? '';
        $data =[
            'capacitys' => $preoderp->findAll(),
            'tables' => $this->tables->searchtables($search, $perPage, $offset,$capacityfilter),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->tables->getCount($search),
            'capacityfilter' => $capacityfilter,
        ];
        return view('admin/table/table',$data);
    }
}
