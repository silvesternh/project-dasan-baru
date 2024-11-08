<?php

namespace App\Models;

use CodeIgniter\Model;

class TanahModel extends Model
{
  protected $table = 'tanah';
  protected $primaryKey = 'id_tanah';

  protected $allowedFields = ['satker', 'luas', 'bidang', 'status'];

  public function export()
  {
    $data = $this->tanahModel->findAll();

    // ...
  }
}
