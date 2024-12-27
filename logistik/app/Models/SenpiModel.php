<?php

namespace App\Models;

use CodeIgniter\Model;

class SenpiModel extends Model
{
  protected $table = 'senpi';
  protected $primaryKey = 'id_senpi';

  protected $allowedFields = ['id_satker', 'id_jenis', 'id_merk', 'jumlah', 'baik', 'rr', 'rb', 'polres', 'polsek', 'gudang', 'ket'];

  public function export()
  {
    $data = $this->senpiModel->findAll();

    // ...
  }

  public function getSenpiWithDetails()
  {
    return $this->select('senpi.*, satker.nama_satker, jenis.nama_jenis, merk.nama_merk')
      ->join('satker', 'satker.id_satker = senpi.id_satker', 'left')
      ->join('jenis', 'jenis.id_jenis = senpi.id_jenis', 'left')
      ->join('merk', 'merk.id_merk = senpi.id_merk', 'left')
      ->findAll();
  }
}
