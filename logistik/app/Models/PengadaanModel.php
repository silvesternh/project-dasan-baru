<?php

namespace App\Models;

use CodeIgniter\Model;

class PengadaanModel extends Model
{
  protected $table = 'pengadaan';
  protected $primaryKey = 'id_pengadaan';

  protected $allowedFields = ['satker', 'paket', 'pagu', 'kontrak', 'no_kontrak', 'mulai_kontrak', 'akhir_kontrak', 'penyedia', 'metode'];

  public function export()
  {
    $data = $this->pengadaanModel->findAll();

    // ...
  }

  public function filterpengadaan($postData)
  {
    $builder = $this->table('pengadaan');
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
