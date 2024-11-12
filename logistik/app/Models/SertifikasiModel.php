<?php

namespace App\Models;

use CodeIgniter\Model;

class SertifikasiModel extends Model
{
  protected $table = 'sertifikasi';
  protected $primaryKey = 'id_sertifikasi';

  protected $allowedFields = ['id_satker', 'nama', 'pangkat', 'nrp', 'jabatan', 'nomor', 'hp'];

  public function export()
  {
    $data = $this->sertifikasiModel->findAll();

    // ...
  }

  public function getSertifikasiWithSatker()
  {
    return $this->select('sertifikasi.*, satker.nama_satker AS nama_satker')
      ->join('satker', 'satker.id_satker = sertifikasi.id_satker')
      ->findAll();
  }
}
