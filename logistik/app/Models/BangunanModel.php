<?php

namespace App\Models;

use CodeIgniter\Model;

class BangunanModel extends Model
{
  protected $table = 'bangunan';
  protected $primaryKey = 'id_bangunan';

  protected $allowedFields = ['gedung', 'unit', 'penghuni', 'kondisi', 'ket'];

  public function export()
  {
    $data = $this->bangunanModel->findAll();

    // ...
  }
}
