<?php

namespace App\Models;

use CodeIgniter\Model;

class TableModel extends Model
{
    protected $table            = 'tables';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['table_num', 'capacity', 'status','created_at','floor','position','row','col'];
    public function searchtables($search = '', $perPage = 10, $offset = 0,$capacity ='',$status ='')
    {
        if ($search) {
            $this->like('table_num', $search)
                 ->orLike('capacity', $search);
        }
        if($capacity){
            $this->like('capacity',$capacity);
        }
        if($status){
            $this->like('status',$capacity);
        }
        return $this->orderBy('id', 'DESC')
                    ->findAll($perPage, $offset);
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('table_num', $search)
                 ->orLike('capacity', $search);
        }

        return $this->countAllResults();
    }
    public function getByfloor($floor) {
        return $this->select('table_num,status,row,col,capacity')->where('floor', $floor)->findAll();
    }
}
