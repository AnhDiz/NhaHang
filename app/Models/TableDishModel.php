<?php

namespace App\Models;

use CodeIgniter\Model;

class TableDishModel extends Model
{
    protected $table            = 'table_dish';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['table_id', 'dish_id', 'quanity','price','status'];
    
}
