<?php

namespace App\Controllers\main;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TableModel;

class BookController extends BaseController
{
    private $tables;
    function __construct()
    {
        parent::__construct();
        $this->tables = new TableModel();
        $this->tables->protect(true);
    }
    public function index()
    {
        $data = [
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
        ];
        return view('main/booking',$data);
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
