<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialUnit extends Model
{
    protected $table            = 'material_unit';
    protected $primaryKey       = 'material_unit_id';
    protected $allowedFields = ['unit','type_name','created_at','updated_at'];
    public function search($search = '', $perPage = 10, $offset = 0,$unit ='')
    {
        if ($search) {
            $this->like('type_name', $search)
            ->orLike('unit',$search);
        }
        if($unit){
            $this->like('material_unit_id',$unit);
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
