<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusTableModel extends Model
{
    protected $table            = 'statustable';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['description'];
}
