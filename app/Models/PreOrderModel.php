<?php

namespace App\Models;

use CodeIgniter\Model;

class PreOrderModel extends Model
{
    protected $table            = 'pre_oder_price';
    protected $primaryKey       = 'capacity';
    protected $allowedFields = ['pre_oder_price','created_at','updated_at'];
    
}
