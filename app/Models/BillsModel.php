<?php

namespace App\Models;

use CodeIgniter\Model;

class BillsModel extends Model
{
    protected $table            = 'bills';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['table_id','customer_name','phone_number','total','status','created_at','updated_at'];
    public function search($search = '', $perPage = 10, $offset = 0,$group ='')
    {
        if ($search) {
            $this->like('customer_name', $search) 
                 ->orLike('phone_number', $search)
                 ->orLike('request',$search);
        }
        return $this->findAll($perPage, $offset);
        
    }
    public function getCount($search = '')
    {
        if ($search) {
            $this->like('customer_name', $search)
                 ->orLike('phone_number', $search)
                 ->orLike('request',$search);
        }

        return $this->countAllResults();
    }
}
