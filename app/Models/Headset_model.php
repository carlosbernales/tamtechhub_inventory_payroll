<?php

namespace App\Models;
use CodeIgniter\Model;

class Headset_model extends Model
{
    protected $table = 'headset';
    protected $allowedFields = [
        'id',
        'agent_fk_id',
        'agent',
        'equip_id',
        'status',
        'brand',
        'model',
        'condition',
        'comment',
    ];
    protected $primaryKey = 'id';

}

?>