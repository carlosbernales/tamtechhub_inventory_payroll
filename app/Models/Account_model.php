<?php

namespace App\Models;
use CodeIgniter\Model;

class Account_model extends Model
{
    protected $table = 'account';
    protected $allowedFields = [
        'id',
        'firstname',
        'lastname',
        'profile_image',
        'username',
        'email',
        'password',
        'role',
        'token',
        'approve_token',
        'verify_otp'
    ];
    protected $primaryKey = 'id';

    
}

?>