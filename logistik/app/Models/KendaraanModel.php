<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
  protected $table = 'kendaraan';
  protected $primaryKey = 'id_kendaraan';

  protected $allowedFields = ['id_satker', 'nopol', 'jenis', 'merk', 'tahun', 'mesin', 'rangka', 'kondisi', 'roda', 'pemegang', 'pangkat', 'nrp', 'jabatan'];

  public function export()
  {
    $data = $this->kendaraanModel->findAll();

    // ...
  }

  public function getKendaraanWithSatker()
  {
    return $this->select('kendaraan.*, satker.nama_satker AS nama_satker')
      ->join('satker', 'satker.id_satker = kendaraan.id_satker')
      ->findAll();
  }
}
