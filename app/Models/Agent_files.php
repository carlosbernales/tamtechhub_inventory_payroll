<?php

namespace App\Models;
use CodeIgniter\Model;

class Agent_files extends Model
{
    protected $table = 'agent_documents';
    protected $allowedFields = [
        'id',
        'agent_fk_id',
        'upload_files',
    ];
    protected $primaryKey = 'id';
    public function deleteFileById($fileId)
    {
        return $this->delete($fileId);
    }
}

?>