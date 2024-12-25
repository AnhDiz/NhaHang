<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table            = 'materials';
    protected $primaryKey       = 'material_id';
    protected $allowedFields = ['name','number_start','number_now','material_type_id','unit','price_per_unit','time','created_at','updated_at'];
    public function search($search = '', $perPage = 10, $offset = 0,$type ='',$unit = '')
    {
        if ($search) {
            $this->like('name', $search);
        }
        if($type || $unit){
            $this->like('material_type_id',$type)
                ->orLike('unit',$unit);
        }
        return $this->findAll($perPage, $offset);
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('name', $search);
        }

        return $this->countAllResults();
    }
    public function getMaterialsByType($typeId) {
        return $this->select('material_id,name,number_now')->where('material_type_id', $typeId)->findAll();
    }
}
