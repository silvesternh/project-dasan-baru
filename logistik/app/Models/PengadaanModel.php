<?php

namespace App\Models;

use CodeIgniter\Model;

class PengadaanModel extends Model
{
  protected $table = 'pengadaan';
  protected $primaryKey = 'id_pengadaan';

  protected $allowedFields = ['id_satker', 'paket', 'pagu', 'kontrak', 'no_kontrak', 'mulai_kontrak', 'akhir_kontrak', 'penyedia', 'metode', 'tahun'];

  public function export()
  {
    $data = $this->pengadaanModel->findAll();

    // ...
  }

  public function getPengadaanWithSatker()
  {
    return $this->select('pengadaan.*, satker.nama_satker AS nama_satker')
      ->join('satker', 'satker.id_satker = pengadaan.id_satker')
      ->findAll();
  }
}
