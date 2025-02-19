<?php

namespace App\Controllers\main;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Common\Result;
use App\Models\TableModel;
use App\Models\BookingModel;

class BookController extends BaseController
{
    private $tables;
    private $bookings;
    function __construct()
    {
        parent::__construct();
        $this->tables = new TableModel();
        $this->tables->protect(true);
        $this->bookings = new BookingModel();
        $this->bookings->protect(true);
    }
    public function index()
    {
        $session = session();

        if(!$session->get('logged_in')){
            if(current_url() === base_url().'/dang_nhap'){
                return view('/dang_nhap');
            }
            return redirect('dang_nhap');
        }
        $data = [
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
            'capacity' => $this->tables->select('DISTINCT(capacity)')->findAll(),
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
        $row = 5;
        $col = 5;

        echo json_encode(['status' => 'success', 'data' => $tables,'row' => $row, 'col' => $col]);
    }
    public function create(){
        $session = session();
        $data = $this->request->getPost();
        
        try {
            foreach($data['tables'] as $table_num){
                $table_id = $this->tables->select('id')->where('table_num',$table_num)->first();
                $datasave = [
                    'table_id' => $table_id['id'],
                    'customer_name' => $session->get('name'),
                    'phone_number' => $session->get('phone_num'),
                    'request' => $data['request'],
                    'time' => $data['time']
                ];
                // dd($datasave);
                
                if (!$this->bookings->save($datasave)) {
                    return redirect()->back()->withInput()->with(Result::MESSAGE_CODE_ERR, 'Không thể lưu dữ liệu!');
                }
            }
            
            return redirect()->to('');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('err','Có lỗi xảy ra với hệ thống');
        }
    }
}
