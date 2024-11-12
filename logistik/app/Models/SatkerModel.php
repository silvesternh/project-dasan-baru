<?php

namespace App\Models;

use CodeIgniter\Model;

class SatkerModel extends Model
{
  protected $table = 'satker';
  protected $primaryKey = 'id_satker';

  protected $allowedFields = ['nama_satker'];

  public function export()
  {
    $data = $this->satkerModel->findAll();

    // ...
  }
}
