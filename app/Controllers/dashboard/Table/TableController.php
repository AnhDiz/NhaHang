<?php

namespace App\Controllers\Dashboard\Table;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
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
        $row = $this->tables->selectMax('row')->where('floor',$floor)->first();
        $col = $this->tables->selectMax('col')->where('floor',$floor)->first();

        echo json_encode(['status' => 'success', 'data' => $tables,'row' => $row, 'col' => $col]);
    }
}
