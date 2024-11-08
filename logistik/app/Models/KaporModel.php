<?php

namespace App\Models;

use CodeIgniter\Model;

class KaporModel extends Model
{
  protected $table = 'kapor';
  protected $primaryKey = 'id_kapor';

  protected $allowedFields = ['nama', 'satuan', 'volume', 'harga', 'jumlah', 'tahun'];

  public function export()
  {
    $data = $this->kaporModel->findAll();

    // ...
  }

  public function filterKapor($postData)
  {
    $builder = $this->table('kapor');
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
