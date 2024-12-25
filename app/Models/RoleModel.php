<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'role';
    protected $primaryKey       = 'role_id';
    protected $allowedFields = ['url', 'description'];
    public function search($search = '', $perPage = 10, $offset = 0,$group ='')
    {
        if ($search) {
            $this->like('url', $search)
                 ->orLike('description', $search)
                 ->orLike('type', $search);
        }
        if($group){
            $this->like('type',$group);
        }
        return $this->orderBy('role_id', 'ASC')
                    ->findAll($perPage, $offset);
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('url', $search)
                 ->orLike('description', $search);
        }

        return $this->countAllResults();
    }
}
