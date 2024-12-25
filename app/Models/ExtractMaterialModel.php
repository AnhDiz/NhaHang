<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtractMaterialModel extends Model
{
    protected $table            = 'extract_material';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['material_id','quanity'];
}
