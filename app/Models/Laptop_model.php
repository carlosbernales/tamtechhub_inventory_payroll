<?php

namespace App\Models;
use CodeIgniter\Model;

class Laptop_model extends Model
{
    protected $table = 'laptop';
    protected $allowedFields = [
        'id',
        'laptop_agent',
        'agent_fk_id',
        'laptop_equip_id',
        'laptop_status',
        'laptop_model',
        'laptop_brand',
        'laptop_ram',
        'laptop_processor',
        'laptop_storage',
        'laptop_condition',
        'laptop_comment',
    ];
    protected $primaryKey = 'id';

    
}

?>