<?php

namespace App\Models;
use CodeIgniter\Model;

class FiveGsimcard_model extends Model
{
    protected $table = 'sgsimcard';
    protected $allowedFields = [
        'id',
        'number',
        'serial_no',
        'agent',
        'agent_fk_id',
        'used_in',
        'remarks',
        'phone_serial_no',
        'phone_fk_id',
        'load_expired'

    ];
    protected $primaryKey = 'id';

    
}

?>