<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data =[
            [
                'url' => 'dashboard',
                'description' => 'Truy cập vào trang quản trị',
                'type' => ''
            ],
            [
                'url' => 'dashboard/user',
                'description' => 'Xem danh sách người dùng',
                'type' => 'nguời dùng'
            ],
            [
                'url' => 'dashboard/user/add',
                'description' => 'Thêm người dùng',
                'type' => 'nguời dùng'
            ],
            [
                'url' => 'dashboard/user/edit',
                'description' => 'chỉnh sửa thông tin người dùng',
                'type' => 'nguời dùng'
            ],
            [
                'url' => 'dashboard/user/delete',
                'description' => 'Xóa người dùng',
                'type' => 'nguời dùng'
            ],
            [
                'url' => 'dashboard/group',
                'description' => 'Xem danh sách chức vụ',
                'type' => 'chức vụ'
            ],
            [
                'url' => 'dashboard/group/add',
                'description' => 'Tạo group mới',
                'type' => 'chức vụ'
            ],
            [
                'url' => 'dashboard/group/edit',
                'description' => 'Sửa thông tin group',
                'type' => 'chức vụ'
            ],
            [
                'url' => 'dashboard/group/delete',
                'description' => 'Xóa group',
                'type' => 'chức vụ'
            ],
            [
                'url' => 'dashboard/role',
                'description' => 'Xem danh sách quyền',
                'type' => 'quyền'
            ],
            [
                'url' => 'dashboard/role/add',
                'description' => 'Tạo role mới',
                'type' => 'quyền'
            ],
            [
                'url' => 'dashboard/role/edit',
                'description' => 'Sửa thông tin role',
                'type' => 'quyền'
            ],
            [
                'url' => 'dashboard/role/delete',
                'description' => 'Xóa role',
                'type' => 'quyền'
            ],
            [
                'url' => 'dashboard/permission',
                'description' => 'phần quyền cho các chức vụ',
                'type' => 'phân quyền'
            ],
            [
                'url' => 'dashboard/material',
                'description' => 'Xem danh sách nguyên liệu',
                'type' => 'nguyên liệu'
            ],
            [
                'url' => 'dashboard/material/add',
                'description' => 'Tạo material mới',
                'type' => 'nguyên liệu'
            ],
            [
                'url' => 'dashboard/material/edit',
                'description' => 'Sửa thông tin material',
                'type' => 'nguyên liệu'
            ],
            [
                'url' => 'dashboard/material/delete',
                'description' => 'Xóa material',
                'type' => 'nguyên liệu'
            ],
            [
                'url' => 'dashboard/materialtype',
                'description' => 'Xem danh sách loại nguyên liệu',
                'type' => 'loại nguyên liệu'
            ],
            [
                'url' => 'dashboard/materialtype/add',
                'description' => 'Tạo loại nguyên liệu mới',
                'type' => 'loại nguyên liệu'
            ],
            [
                'url' => 'dashboard/materialtype/edit',
                'description' => 'Sửa thông tin loại nguyên liệu',
                'type' => 'loại nguyên liệu'
            ],
            [
                'url' => 'dashboard/materialtype/delete',
                'description' => 'Xóa loại nguyên liệu',
                'type' => 'loại nguyên liệu'
            ],
            [
                'url' => 'dashboard/dish',
                'description' => 'Xem danh sách món ăn',
                'type' => 'món ăn'
            ],
            [
                'url' => 'dashboard/dish/add',
                'description' => 'Tạo dish mới',
                'type' => 'món ăn'
            ],
            [
                'url' => 'dashboard/dish/edit',
                'description' => 'Sửa thông tin dish',
                'type' => 'món ăn'
            ],
            [
                'url' => 'dashboard/dish/delete',
                'description' => 'Xóa dish',
                'type' => 'món ăn'
            ],
            [
                'url' => 'dashboard/materialunit',
                'description' => 'Xem danh sách đơn vị đo nguyên liệu',
                'type' => 'dvd nguyên liệu'
            ],
            [
                'url' => 'dashboard/materialunit/add',
                'description' => 'Tạo đơn vị đo nguyên liệu mới',
                'type' => 'dvd nguyên liệu'
            ],
            [
                'url' => 'dashboard/materialunit/edit',
                'description' => 'Sửa thông tin đơn vị đo nguyên liệu',
                'type' => 'dvd nguyên liệu'
            ],
            [
                'url' => 'dashboard/materialunit/delete',
                'description' => 'Xóa đơn vị đo nguyên liệu',
                'type' => 'dvd nguyên liệu'
            ],
        ];
        $this->db->table('role')->insertBatch($data);
    }
}
