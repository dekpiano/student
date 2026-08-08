<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelsLogin extends Model
{
    protected $table = 'tb_students';
    protected $primaryKey = 'StudentID';
    protected $allowedFields = ['username', 'password', 'StudentPassword', 'StudentCode', 'StudentIDNumber', 'StudentEmail', 'StudentEmailPassword', 'StudentEmailResetCount', 'StudentEmailResetAt'];
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
}
