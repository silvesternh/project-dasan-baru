<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
  protected $table = 'jenis';
  protected $primaryKey = 'id_jenis';

  protected $allowedFields = ['nama_jenis'];

  public function export()
  {
    $data = $this->jenisModel->findAll();

    // ...
  }
}
