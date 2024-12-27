<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotarologModel extends Model
{
  protected $table = 'anggotarolog';
  protected $primaryKey = 'id_anggotarolog';

  protected $allowedFields = ['bag', 'nama', 'pangkat', 'nrp', 'jabatan', 'tanggallahir', 'alamat', 'foto', 'level'];

  public function export()
  {
    $data = $this->AnggotarologModel->findAll();

    // ...
  }
}
