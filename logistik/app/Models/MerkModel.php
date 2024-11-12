<?php

namespace App\Models;

use CodeIgniter\Model;

class MerkModel extends Model
{
  protected $table = 'merk';
  protected $primaryKey = 'id_merk';

  protected $allowedFields = ['nama_merk'];

  public function export()
  {
    $data = $this->merkModel->findAll();

    // ...
  }
}
