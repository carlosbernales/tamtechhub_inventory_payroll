<?php

namespace App\Models;
use CodeIgniter\Model;

class Agent_payslips extends Model
{
    protected $table = 'agent_payslips';
    protected $allowedFields = [
        'id',
        'attendance_bonus',
        'spiff_incentive',
        'overtime_pay',
        'nd_pay',
        'ndOt_pay',
        'other_add',
        'gross_pay',
        'late_deduction',
        'undertime_deduction',
        'sss_deduction',
        'pag_ibig_deduction',
        'philhealth_deduction',
        'sss_loan',
        'pag_ibig_loan',
        'house_rent',
        'other_deduction',
        'total_deduction',
        'total_net_pay',
        'agent_name',
        'startDate',
        'end_date',
        'payslip_no',
        'base_pay',
        'others_add_comment',
        'others_deduc_comment',
        'cash_advance',
        'camp_allowance',
        'other_addPay_one',
        'otherAddComment_one',
        'Otherdeduc_one',
        'DeducComment_one'
    ];
    protected $primaryKey = 'id';
}

?>