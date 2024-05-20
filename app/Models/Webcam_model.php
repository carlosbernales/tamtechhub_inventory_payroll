<?php

namespace App\Models;
use CodeIgniter\Model;

class Webcam_model extends Model
{
    protected $table = 'webcam';
    protected $allowedFields = [
        'id',
        'webcam_agent',
        'agent_fk_id',
        'webcam_equip_id',
        'webcam_status',
        'webcam_brand',
        'webcam_model',
        'webcam_condition',
        'webcam_comment',
    ];
    protected $primaryKey = 'id';

}

?>