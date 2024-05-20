<?php

namespace App\Models;
use CodeIgniter\Model;

class Monitor_model extends Model
{
    protected $table = 'monitor';
    protected $allowedFields = [
        'id',
        'monitor_equip_id',
        'agent_fk_id',
        'monitor_status',
        'monitor_brand',
        'monitor_model',
        'monitor_condition',
        'monitor_comment',
    ];
    protected $primaryKey = 'id';
    

}

?>