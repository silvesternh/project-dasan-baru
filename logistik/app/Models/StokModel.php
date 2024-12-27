<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
  protected $table = 'stok';
  protected $primaryKey = 'id_stok';

  protected $allowedFields = ['uraian', 'satuan', 'jumlah'];

  public function export()
  {
    $data = $this->stokModel->findAll();

    // ...
  }
}
