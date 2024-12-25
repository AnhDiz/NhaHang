<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialType extends Model
{
    protected $table            = 'material_type';
    protected $primaryKey       = 'material_type_id';
    protected $allowedFields = ['type_name','created_at','updated_at'];
    public function search($search = '', $perPage = 10, $offset = 0,$type ='')
    {
        if ($search) {
            $this->like('type_name', $search);
        }
        if($type){
            $this->like('material_type_id',$type);
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
