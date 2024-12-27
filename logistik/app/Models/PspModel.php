<?php

namespace App\Models;

use CodeIgniter\Model;

class PspModel extends Model
{
  protected $table = 'psp';
  protected $primaryKey = 'id_psp';

  protected $allowedFields = ['id_satker', 'psp_s', 'psp_b', 'psp_t', 'tanah_s', 'tanah_b', 'tanah_t', 'angkut_s', 'angkut_b', 'angkut_t', 'nontik_s', 'nontik_b', 'nontik_t', 'tik_s', 'tik_b', 'tik_t', 'besar_s', 'besar_b', 'besar_t', 'senjata_s', 'senjata_b', 'senjata_t', 'gedung_s', 'gedung_b', 'gedung_t', 'rumah_s', 'rumah_b', 'rumah_t', 'jalan_s', 'jalan_b', 'jalan_t', 'jaringan_s', 'jaringan_b', 'jaringan_t', 'atl_s', 'atl_b', 'atl_t', 'atb_s', 'atb_b', 'atb_t'];

  public function export()
  {
    $data = $this->pspModel->findAll();

    // ...
  }

  public function getPspWithSatker()
  {
    return $this->select('psp.*, satker.nama_satker AS nama_satker')
      ->join('satker', 'satker.id_satker = psp.id_satker')
      ->findAll();
  }
}
