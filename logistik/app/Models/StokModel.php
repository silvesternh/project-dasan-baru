<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
  protected $table = 'stok';
  protected $primaryKey = 'id_stok';

  protected $allowedFields = ['kode', 'uraian', 'jumlah', 'keluar', 'masuk', 'sisa', 'ket'];

  public function export()
  {
    $data = $this->stokModel->findAll();

    // ...
  }
}
