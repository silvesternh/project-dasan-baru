<?php

namespace App\Models;

use CodeIgniter\Model;

class BangunanModel extends Model
{
  protected $table = 'bangunan';
  protected $primaryKey = 'id_bangunan';

  protected $allowedFields = ['id_satker', 'gedung', 'unit', 'penghuni', 'kondisi', 'ket'];

  public function export()
  {
    $data = $this->bangunanModel->findAll();

    // ...
  }

  public function getBangunanWithSatker()
  {
    return $this->select('bangunan.*, satker.nama_satker AS nama_satker')
      ->join('satker', 'satker.id_satker = bangunan.id_satker')
      ->findAll();
  }
}
