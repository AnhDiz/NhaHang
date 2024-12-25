<?php

namespace App\Models;

use CodeIgniter\Model;

class DishTypeModel extends Model
{
    protected $table            = 'dish_type';
    protected $primaryKey       = 'type_id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['type_name','created_at','updated_at'];
    public function search($search = '', $perPage = 10, $offset = 0)
    {
        if ($search) {
            $this->like('type_name', $search);
        }
        return $this->findAll($perPage, $offset);
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('type_name', $search);
        }

        return $this->countAllResults();
    }
}
