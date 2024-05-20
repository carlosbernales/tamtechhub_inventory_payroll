<?php

namespace App\Models;
use CodeIgniter\Model;

class Agent_model extends Model
{
    protected $table = 'agent_list';
    protected $allowedFields = [
        'id',
        'agent_name',
        'agent_id',
        'campaign',
        'start_date',
        'status',
        'daily_salary',
        'SSS',
        'pag_ibig',
        'philhealth',
        'required_work',
        'house_rent',
        'user_email',
        'comment',
    ];
    protected $primaryKey = 'id';
}

?>