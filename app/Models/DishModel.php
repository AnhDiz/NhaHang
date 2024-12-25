<?php

namespace App\Models;

use CodeIgniter\Model;

class DishModel extends Model
{
    protected $table            = 'dishs';
    protected $primaryKey       = 'dish_id';
    protected $allowedFields = ['name','dish_type_id','description','price','image','created_at','updated_at'];
    public function search($search = '', $perPage = 10, $offset = 0,$group ='')
    {
        if ($search) {
            $this->like('name', $search)
                 ->orLike('description', $search);
        }
        if($group){
            $this->like('dish_type_id',$group);
        }
        return $this->findAll($perPage, $offset);
        
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('name', $search)
                 ->orLike('description', $search);
        }

        return $this->countAllResults();
    }
}
