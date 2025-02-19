<?php

namespace App\Controllers\Dashboard\Table;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BookingModel;
use App\Models\TableModel;
use Exception;
use App\Common\Result;
use App\Controllers\MailController;


class BookingController extends BaseController
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
        $booking = new BookingModel();
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $table = $this->tables->select('id, table_num')->findAll();
        $offset = ($currentPage - 1) * $perPage;
        $data = [
            'bookings' => $booking->search($search, $perPage, $offset),
            'search' => $search,
            'perPage' => $perPage,
            'tables' => $table,
            'currentPage' => $currentPage,
            'total' => $booking->getCount($search)
        ];
        return view('admin/booking/table',$data);
    }
    public function add(){
        $data = [
            'floors' => $this->tables->select('DISTINCT(floor)')->findAll(),
            'capacity' => $this->tables->select('DISTINCT(capacity)')->findAll(),
        ];
        return view('admin/booking/add',$data);
    }
    public function create(){
        $data = $this->request->getPost();
        // dd($data);
        try {
            foreach($data['tables'] as $table_num){
                $table_id = $this->tables->select('id')->where('table_num',$table_num)->first();
                $datasave = [
                    'table_id' => $table_id['id'],
                    'customer_name' => $data['customer_name'],
                    'phone_number' => $data['phone_num'],
                    'request' => $data['request'],
                    'time' => $data['time']
                ];
                // dd($datasave);
                
                if (!$this->bookings->save($datasave)) {
                    return redirect()->back()->withInput()->with('error', 'Không thể lưu dữ liệu!');
                }
            }
            return redirect()->to('dashboard/booking')->withInput()->with(Result::MESSAGE_CODE_OK,'Đặt bàn thành công!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with(Result::MESSAGE_CODE_ERR, 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function delete($id){
        $result = $this->Deletebookings($id);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['message']);
    }
    public function Deletebookings($id){
        try {
            $this->bookings->delete(['id'=>$id]);
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
        $table_id = $this->bookings->select('table_id')->where('id', $id)->first(); 
        $booking = $this->bookings->select('id ,table_id, customer_name, phone_number, request, time')->where('id', $id)->first();
        // dd($booking);
        $data =[
            'booking' => $booking,
            'table' => $this->tables->select('table_num')->where('id',$table_id)->first(),
            'floors' => $this->tables->select('DISTINCT(floor)')->get()->getResultArray(),
        ];
        return view('admin/booking/edit',$data);
    }
    public function update(){
        try{
        $data = $this->request->getPost();
        $id = $data['id'];
        unset($data['id']);
        $data['table_id'] = $this->tables->select('id')->where('table_num',$data['table_num'])->get()->getRowArray()['id'] ?? null;;
        // dd($data);
        if($this->bookings->update($id,$data)) {
            $result= [
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Cập nhật thành công']
            ];
            return redirect()->to('dashboard/booking')->withInput()->with($result['messageCode'], $result['message']);
        }} catch(Exception $e){
            $result=[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $e->getMessage()]
            ];
            return redirect()->back()->withInput()->withInput()->with($result['messageCode'], $result['message']);
        }
        
    }
    public function updateid(){
        $booking_id = $this->request->getPost('id'); // Nhận ID booking
        $table = $this->bookings->select('table_id')->where('id', $booking_id)->first();

        if (!$table) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Không tìm thấy booking']);
        }

        $table_id = $table['table_id'];
        $newupdate = $this->request->getPost('role');
        $name = $this->request->getPost('name');

        // Kiểm tra dữ liệu đầu vào
        if (empty($booking_id) || empty($name)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
        }

        try {
            // Cập nhật trạng thái booking
            if ($this->bookings->update($booking_id, [$name => $newupdate])) {
                // Nếu trạng thái là 1, cập nhật trạng thái bàn
                if ($newupdate == 1 && !empty($table_id)) {
                    $this->tables->update($table_id, [$name => '2']);
                }
                $email = new MailController();
                $session = session();
                $email->sendemail($session->get('mottac1106@gmail.com'));
                return $this->response->setJSON(['status' => 'success']);
            }
        } catch (Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Không thể cập nhật']);
        }

}
