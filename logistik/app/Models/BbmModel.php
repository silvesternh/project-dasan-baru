<?php

namespace App\Models;

use CodeIgniter\Model;

class BbmModel extends Model
{
  protected $table = 'bbm';
  protected $primaryKey = 'id_bbm';

  protected $allowedFields = ['id_satker', 'p1', 'd1', 'p2', 'd2', 'p3', 'd3', 'p4', 'd4', 'tahun'];

  public function export()
  {
    $data = $this->bbmModel->findAll();

    // ...
  }

  public function getBbmWithSatker()
  {
    return $this->select('bbm.*, satker.nama_satker AS nama_satker')
      ->join('satker', 'satker.id_satker = bbm.id_satker')
      ->findAll();
  }
}
