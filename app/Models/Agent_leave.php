<?php

namespace App\Models;
use CodeIgniter\Model;

class Agent_leave extends Model
{
    protected $table = 'agent_leave';
    protected $allowedFields = [
        'id',
        'agent_fk_id',
        'comment',
        'status',
        'date_of_leave',
        'start_date',
        'end_date',
        'agent_id',
        'required_work',
        'daily_salary',
    ];
    protected $primaryKey = 'id';

    public function getLeaveData($agentId, $startDate, $endDate)
    {
        return $this->where('agent_id', $agentId)
                    ->where('date_of_leave >=', $startDate)
                    ->where('date_of_leave <=', $endDate)
                    ->where('status', 'Used')
                    ->findAll();
    }
}

?>