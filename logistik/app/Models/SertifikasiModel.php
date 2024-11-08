<?php

namespace App\Models;

use CodeIgniter\Model;

class SertifikasiModel extends Model
{
  protected $table = 'sertifikasi';
  protected $primaryKey = 'id_sertifikasi';

  protected $allowedFields = ['satker', 'nama', 'pangkat', 'nrp', 'jabatan', 'nomor', 'hp'];

  public function export()
  {
    $data = $this->sertifikasiModel->findAll();

    // ...
  }

  public function filtersertifikasi($postData)
  {
    $builder = $this->table('sertifikasi');
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
