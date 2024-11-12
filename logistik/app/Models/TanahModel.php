<?php

namespace App\Models;

use CodeIgniter\Model;

class TanahModel extends Model
{
  protected $table = 'tanah';
  protected $primaryKey = 'id_tanah';

  protected $allowedFields = ['id_satker', 'luas', 'bidang', 'status'];

  public function export()
  {
    $data = $this->tanahModel->findAll();

    // ...
  }

  public function getTanahWithSatker()
  {
    return $this->select('tanah.*, satker.nama_satker AS nama_satker')
      ->join('satker', 'satker.id_satker = tanah.id_satker')
      ->findAll();
  }
}
