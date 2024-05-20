<?php

namespace App\Models;
use CodeIgniter\Model;

class Locker_model extends Model
{
    protected $table = 'locker';
    protected $allowedFields = [
        'id',
        'agent_fk_id',
        'locker_no',
        'locker_agent',
        'locker_tool_id',
        'locker_status',
        'locker_condition',
        'locker_comment',
    ];
    protected $primaryKey = 'id';
}

?>