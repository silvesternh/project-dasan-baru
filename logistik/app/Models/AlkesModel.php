<?php

namespace App\Models;

use CodeIgniter\Model;

class AlkesModel extends Model
{
    protected $table = 'alkes';
    protected $primaryKey = 'id_alkes';

    protected $allowedFields = ['id_satker', 'bmn', 'jumlah', 'bb', 'rr', 'rb', 'ket'];

    public function export()
    {
        $data = $this->alkesModel->findAll();

        // ...
    }

    public function getAlkesWithSatker()
    {
        return $this->select('alkes.*, satker.nama_satker AS nama_satker')
            ->join('satker', 'satker.id_satker = alkes.id_satker')
            ->findAll();
    }
}
