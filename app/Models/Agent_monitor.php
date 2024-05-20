<?php

namespace App\Models;
use CodeIgniter\Model;

class Agent_monitor extends Model
{
    protected $table = 'agent_monitor';
    protected $allowedFields = [
        'id',
        'agent_fk_id',
        'agent',
        'monitor_one',
        'monitor_one_fk',
        'monitor_two',
        'monitor_two_fk',
    ];
    protected $primaryKey = 'id';

}

?>