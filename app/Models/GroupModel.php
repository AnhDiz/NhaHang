<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table            = 'group';
    protected $primaryKey       = 'group_id';
    protected $allowedFields = ['groupName','description'];
    public function search($search = '', $perPage = 10, $offset = 0,$group ='')
    {
        if ($search) {
            $this->like('groupName', $search)
                 ->orLike('description', $search);
        }
        return $this->findAll($perPage, $offset);
    }

    public function getCount($search = '')
    {
        if ($search) {
            $this->like('groupName', $search)
                 ->orLike('description', $search);
        }

        return $this->countAllResults();
    }
}
