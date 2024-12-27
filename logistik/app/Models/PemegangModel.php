<?php

namespace App\Models;

use CodeIgniter\Model;

class PemegangModel extends Model
{
  protected $table = 'pemegang';
  protected $primaryKey = 'id_pemegang';

  protected $allowedFields = ['id_satker', 'id_jenis', 'id_merk', 'nama', 'pangkat', 'nrp', 'no_senpi', 'amu', 'berlaku'];

  public function export()
  {
    $data = $this->pemegangModel->findAll();

    // ...
  }

  public function getPemegangWithDetails()
  {
    return $this->select('pemegang.*, satker.nama_satker, jenis.nama_jenis, merk.nama_merk')
      ->join('satker', 'satker.id_satker = pemegang.id_satker', 'left')
      ->join('jenis', 'jenis.id_jenis = pemegang.id_jenis', 'left')
      ->join('merk', 'merk.id_merk = pemegang.id_merk', 'left')
      ->findAll();
  }
}
