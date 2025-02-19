<?php

namespace App\Controllers\Dashboard\Dish;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DishModel;
use App\Models\DishTypeModel;
use App\Common\Result;
use App\Controllers\Notification\NotificationController;

class DishController extends BaseController
{
    private $dishs;
    private $notification;
    function __construct()
    {
        parent::__construct();
        $this->dishs = new DishModel();
        $this->dishs->protect(false);
        $this->notification = new NotificationController();
    }
    public function index()
    {
        // dd(session()->get());
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $typefilter = $this->request->getGet('typefilter');
        $types = new DishTypeModel();
        $data =[
            'dishs' => $this->dishs->search($search, $perPage, $offset,group: $typefilter),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->dishs->getCount($search),
            'types' => $types->findAll(),
            'typefilter' => $typefilter
        ];
        return view('admin/dish/table',$data);
    }
    public function add(){
        $types = new DishTypeModel();
        $data =[
            'types' => $types->findAll()
        ];
        return view('admin/dish/add',$data);
    }
    public function create(){
        $dish = new DishModel();
        $file = $this->request->getFile('image');
        // dd($this->request->getFile('image'));
        $imagename = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imagename = $file->getClientName();
            $file->move('images\dish', $imagename);
        }
        // dd($this->request->getPost());
        $data = [
            'name' => $this->request->getPost('name'),
            'dish_type_id' => $this->request->getPost('type'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $imagename,
        ];
        // dd($data);
        $dish->save($data);
        return redirect()->to('dashboard/dish')->withInput()->with(Result::MESSAGE_CODE_OK,'Thêm món ăn mới thành công');
    }
    public function delete($id)
    {
        $dish = new DishModel();
        try {
            // Tìm món ăn theo ID
            $dishData = $dish->find($id);
            if (!$dishData) {
                return redirect()->back()->with('errorsMsg', 'Món ăn không tồn tại.');
            }

            // Xóa hình ảnh nếu tồn tại
            $imagePath = FCPATH . 'images/dish/' . $dishData['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file hình ảnh
            }

            // Xóa món ăn khỏi database
            $dish->delete($id);
            return redirect()->to('dashboard/dish')->withInput()->with(Result::MESSAGE_CODE_OK, 'Xóa món ăn thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorsMsg', 'Lỗi khi xóa món ăn: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $dish = new DishModel();
        $types = new DishTypeModel();

        // Lấy món ăn cần chỉnh sửa
        $dishData = $dish->find($id);
        if (!$dishData) {
            return redirect()->to('dashboard/dish')->withInput()->with('errorsMsg', 'Món ăn không tồn tại.');
        }

        // Lấy danh sách loại món ăn
        $data = [
            'dish' => $dishData,
            'types' => $types->findAll()
        ];

        return view('admin/dish/edit', $data);
    }
    public function update($id)
    {
        $dish = new DishModel();
        $file = $this->request->getFile('image');
        $imagename = '';

        try {
            // Lấy món ăn cần cập nhật
            $dishData = $dish->find($id);
            if (!$dishData) {
                return redirect()->to('dashboard/dish')->withInput()->with('errorsMsg', 'Món ăn không tồn tại.');
            }

            // Nếu có file mới, lưu file và xóa file cũ
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $imagename = $file->getRandomName();
                $file->move('images/dish', $imagename);

                // Xóa ảnh cũ nếu tồn tại
                $oldImagePath = FCPATH . 'images/dish/' . $dishData['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            } else {
                // Nếu không có ảnh mới, giữ nguyên ảnh cũ
                $imagename = $dishData['image'];
            }

            // Cập nhật dữ liệu
            $data = [
                'id' => $id,
                'name' => $this->request->getPost('name'),
                'dish_type_id' => $this->request->getPost('type'),
                'description' => $this->request->getPost('description'),
                'price' => $this->request->getPost('price'),
                'image' => $imagename,
            ];
            // dd($data);
            if($dish->update($data['id'],$data)){
                $Result =[
                    'status' => Result::STATUS_CODE_OK,
                    'messageCode' => Result::MESSAGE_CODE_OK,
                    'message' => ['thành công' => 'Cập nhật món ăn thành công']
                ];
            };
            
            return redirect()->to('dashboard/dish')->withInput()->with($Result['messageCode'], $Result['message']);
        } catch (\Exception $e) {
            $Result =[
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['thành công' => $e->getMessage()]
            ];
            return redirect()->back()->withInput()->withInput()->with($Result['messageCode'], $Result['message']);
        }
    }

}
