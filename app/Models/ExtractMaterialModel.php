<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtractMaterialModel extends Model
{
    protected $table            = 'extract_material';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['material_id','quanity','created_at'];
    public function search($search = '', $perPage = 10, $offset = 0,$type ='',$unit = '')
    {
        if ($search) {
            $this->like('material_id', $search)
            ->orLike('quantity',$search);
        }
        if($type || $unit){
            $this->like('material_id',$type)
                ->orLike('quanity',$unit);
        }
        return $this->findAll($perPage, $offset);
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('material_id', $search);
        }

        return $this->countAllResults();
    }

}
