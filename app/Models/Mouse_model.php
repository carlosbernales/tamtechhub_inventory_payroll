<?php

namespace App\Models;
use CodeIgniter\Model;

class Mouse_model extends Model
{
    protected $table = 'mouse';
    protected $allowedFields = [
        'id',
        'agent_fk_id',
        'agent',
        'equip_id',
        'status',
        'brand',
        'model',
        'mouse_condition',
        'comment',
    ];
    protected $primaryKey = 'id';

}

?>