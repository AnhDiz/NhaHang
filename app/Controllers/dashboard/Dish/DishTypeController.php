<?php

namespace App\Controllers\Dashboard\Dish;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DishTypeModel;
use Exception;
use App\Common\Result;

class DishTypeController extends BaseController
{
    private $types;
    function __construct()
    {
        parent::__construct();
        $this->types = new DishTypeModel();
        $this->types->protect(false);
    }
    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $data =[
            'types' => $this->types->search($search, $perPage, $offset),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $this->types->getCount($search),
        ];
        return view('admin/dishtype/table',$data);
    }
    public function add(){
        return view('admin/dishtype/add');
    }
    public function create(){
        $result = $this->AddDishTypeInfo($this->request);
        return redirect()->to('dashboard/dishtype')->withInput()->with($result['messageCode'],$result['message']);
    }
    public function AddDishTypeInfo($requestData)
    {
        $validate = $this->ValidateAddDishType($requestData);

        if ($validate->getErrors()) {
            return [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => $validate->getErrors()
            ];
        }

        $datasave = $requestData->getPost('types');
        try {
            foreach ($datasave as $data) {
                $this->types->save($data);
            }
            return [
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Tạo thành công']
            ];
        } catch (Exception $th) {
            return [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['thất bại' => $th->getMessage()]
            ];
        }
    }

    private function ValidateAddDishType($requestData)
    {
        $rules = [
            'types.*.type_name' => 'is_unique[dish_type.type_name]',
        ];
        $messages = [
            'types.*.type_name' => [
                'is_unique' => 'Loại món ăn đã tồn tại'
            ],
        ];

        // Set validation rules and run validation
        $this->validation->setRules($rules, $messages);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }

    public function delete($id)
    {
        $result = $this->DeleteDishType($id);
        return redirect()->back()->withInput()->with($result['messageCode'], $result['message']);
    }

    public function DeleteDishType($id)
    {
        try {
            $this->types->delete(['type_id' => $id]);
            return [
                'status' => Result::STATUS_CODE_OK,
                'messageCode' => Result::MESSAGE_CODE_OK,
                'message' => ['thành công' => 'Xoá thành công']
            ];
        } catch (Exception $th) {
            return [
                'status' => Result::STATUS_CODE_ERR,
                'messageCode' => Result::MESSAGE_CODE_ERR,
                'message' => ['Thất bại' => $th->getMessage()]
            ];
        }
    }
}
