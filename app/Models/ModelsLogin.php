<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelsLogin extends Model
{
    protected $table = 'tb_students';
    protected $allowedFields = ['username', 'password'];
    protected $beforeInsert = ['hashPassword'];


    public function getUser($username,$password)
    {
        return $this->where('StudentCode', $username)->where('StudentIDNumber',$password)->first();
    }
    
}
