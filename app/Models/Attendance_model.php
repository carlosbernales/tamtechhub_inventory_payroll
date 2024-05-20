<?php

namespace App\Models;
use CodeIgniter\Model;

class Attendance_model extends Model
{
    protected $table = 'attendance';
    protected $allowedFields = [
        'id',
        'agent_name',
        'daily_salary',
        'agent_id',
        'date',
        'time_in',
        'time_out',
        'late_count',
        'early_out',
        'night_diff',
        'ovetime',
        'nd_overtime',
        'actual_work',
        'required_work',
        'status',
        'day_status'
    ];
    protected $primaryKey = 'id';

}

?>