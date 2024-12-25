<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table            = 'group_role';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['group_id','role_id'];
    public function search($search = '', $perPage = 10, $offset = 0,$group ='')
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
