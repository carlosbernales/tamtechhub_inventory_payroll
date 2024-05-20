<?php

namespace App\Models;
use CodeIgniter\Model;

class Phone_model extends Model
{
    protected $table = 'phone';
    protected $allowedFields = [
        'id',
        'phone_agent_name',
        'agent_fk_id',
        'phone_equip_id',
        'phone_status',
        'phone_brand',
        'phone_model',
        'phone_condition',
        'phone_comment',
        'phone_number_one',
        'whatsapp_acc_one',
        'whatsapp_acc_one_cond',
        'phone_number_two',
        'whatsapp_acc_two',
        'whatsapp_acc_two_cond',
        'phone_number_three',
        'whatsapp_acc_three',
        'whatsapp_acc_three_cond',
        
    ];
    protected $primaryKey = 'id';

}

?>