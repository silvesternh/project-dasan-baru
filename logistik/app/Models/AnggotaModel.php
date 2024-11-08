<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
  protected $table = 'anggota';
  protected $primaryKey = 'id_anggota';

  protected $allowedFields = ['nama', 'pangkat', 'nrp', 'jabatan', 'foto'];

  public function export()
  {
    $data = $this->anggotaModel->findAll();

    // ...
  }

  public function filterAnggota($postData)
  {
    $builder = $this->table('anggota');
    $builder->select('*');

    if ($postData['nama']) {
      $builder->like('nama', $postData['nama']);
    }

    if ($postData['pangkat']) {
      $builder->where('id_pangkat', $postData['pangkat']);
    }

    if ($postData['jabatan']) {
      $builder->where('id_jabatan', $postData['jabatan']);
    }

    $query = $builder->get();
    return $query->getResult();
  }
}
