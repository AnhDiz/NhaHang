<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BookingModel;
use App\Models\BillsModel;
use App\Models\TableModel;
use Exception;
use App\Common\Result;

class PersonalController extends BaseController
{
    private $bills;
    private $bookings;
    private $tables;
    function __construct()
    {
        parent::__construct();
        $this->bills = new BillsModel();
        $this->bills->protect(true);
        $this->bookings = new BookingModel();
        $this->bookings->protect(true);
        $this->tables = new TableModel();
        $this->tables->protect(true);
    }
    public function index()
    {
        
        $data =[
            'bookedtable'=> $this->bookedtable(),
        ];
        return view('main/personal',$data);
    }
    public function bookedtable(){
        $session = session();
        $email = $session->get('email');

        $booked = $this->bookings
            ->select('id, table_id, request, time')
            ->where('status', '1')
            ->where('email', $email)
            ->findAll();

        $bookedtable = [];

        if (!empty($booked)) {
            $tableIds = array_column($booked, 'table_id');

            $tables = $this->tables
                ->select('id, table_num, floor, status, row, col')
                ->whereIn('id', $tableIds)
                ->findAll();

            $tableMap = [];
            foreach ($tables as $table) {
                $tableMap[$table['id']] = $table;
            }

            foreach ($booked as $bk) {
                $tableId = $bk['table_id'];

                if (isset($tableMap[$tableId])) {
                    $bookedtable[] = array_merge($bk, $tableMap[$tableId]);
                } else {
                    $bookedtable[] = $bk;
                }
            }
        }
        return $bookedtable;
    }
    public function bookedetail($id){
        $bookedtable = $this->bookedtable();
        // dd($bookedtable);
        $detail = [];
        foreach($bookedtable as $table){
            if($table['id']== $id){
                $detail['table_id'] = $table['table_id'];
                $detail['request'] = $table['request'];
                $detail['table_num'] = $table['table_num'];
                $detail['floor'] = $table['floor'];
                $detail['status'] = $table['status'];
                $detail['row'] = $table['row'];
                $detail['col'] = $table['col'];
            }
        }
        // dd($detail);
        $data = [
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
            'detail' => $detail
        ];
        return view('main/bookeddetail',$data);
    }
}
