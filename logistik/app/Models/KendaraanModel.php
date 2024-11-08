<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
  protected $table = 'kendaraan';
  protected $primaryKey = 'id_kendaraan';

  protected $allowedFields = ['satker', 'nopol', 'jenis', 'merk', 'tahun', 'mesin', 'rangka', 'kondisi', 'pemegang', 'pangkat', 'nrp', 'jabatan'];

  public function export()
  {
    $data = $this->kendaraanModel->findAll();

    // ...
  }
}
