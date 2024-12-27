<?php

namespace App\Models;

use CodeIgniter\Model;

class StokkaporModel extends Model
{
  protected $table = 'stok_kapor';
  protected $primaryKey = '	id_stokkapor';

  protected $allowedFields = ['uraian', 'satuan', 'jumlah'];

  public function export()
  {
    $data = $this->StokkaporModel->findAll();

    // ...
  }
}
