<?php

namespace App\Models;
use CodeIgniter\Model;

class Machine_model extends Model
{
    protected $table = 'machine';
    protected $allowedFields = [
        'id',
        'agent_fk_id',
        'station_no',
        'static_ip',
        'agent',
        'equip_id',
        'status',
        'brand',
        'model',
        'ram_size',
        'processor',
        'storage_type',
        'conditions',
        'comment',
    ];
    protected $primaryKey = 'id';

}

?>