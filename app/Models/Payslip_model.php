<?php

namespace App\Models;
use CodeIgniter\Model;

class Payslip_model extends Model
{
    protected $table = 'payslip';
    protected $allowedFields = [
        'id',
        'image_name',
        'user_email',
        'agent_name',
        'payslip_no',
        'status',
        'end_date',
        'startDate',
        'created_at'
    ];
    protected $primaryKey = 'id';

    public function updatePayslipStatus($payslipNo)
    {
        $payslip = $this->where('payslip_no', $payslipNo)->first();
        
        if ($payslip) {
            $this->update($payslip['id'], ['status' => 'send']); // Change 'send' to 'sent' or whichever status you prefer
        } else {
            // You can throw an exception or handle it according to your application logic
        }
    }

    public function getPayslipsWithFormattedDate()
    {
        $query = $this->query('SELECT *, DATE_FORMAT(created_at, "%M %d, %Y") as formatted_date FROM payslip WHERE status = ?', ['send']);
        $payslips = $query->getResultArray();

        return $payslips;
    }
    

}

?>