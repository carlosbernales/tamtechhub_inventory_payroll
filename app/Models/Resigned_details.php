<?php

namespace App\Models;
use CodeIgniter\Model;

class Resigned_details extends Model
{
    protected $table = 'resigned_details';
    protected $allowedFields = [
        'id',
        'agent_id',
        'comment',
        'status',
        'date'
    ];
    protected $primaryKey = 'id';

}

?>