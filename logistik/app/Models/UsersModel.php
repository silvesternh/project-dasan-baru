<?php
// app/Models/PenggunaModel.php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'username', 'password', 'level'];

    public function getPengguna($username)
    {
        return $this->where('username', $username)->first();
    }
}
