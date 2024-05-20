<?php

namespace App\Models;
use CodeIgniter\Model;

class Keyboard_model extends Model
{
    protected $table = 'keyboard';
    protected $allowedFields = [
        'id',
        'agent',
        'agent_fk_id',
        'keyboard_equip_id',
        'keyboard_status',
        'keyboard_brand',
        'keyboard_model',
        'keyboard_condition',
        'keyboard_comment',
    ];
    protected $primaryKey = 'id';

}

?>