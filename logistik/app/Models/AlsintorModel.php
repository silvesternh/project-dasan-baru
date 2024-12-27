<?php

namespace App\Models;

use CodeIgniter\Model;

class AlsintorModel extends Model
{
    protected $table = 'alsintor';
    protected $primaryKey = 'id_alsintor';

    protected $allowedFields = ['id_satker', 'bmn', 'jumlah', 'bb', 'rr', 'rb', 'ket'];

    public function export()
    {
        $data = $this->alsintorModel->findAll();

        // ...
    }

    public function getAlsintorWithSatker()
    {
        return $this->select('alsintor.*, satker.nama_satker AS nama_satker')
            ->join('satker', 'satker.id_satker = alsintor.id_satker')
            ->findAll();
    }
}
