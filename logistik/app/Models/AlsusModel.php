<?php

namespace App\Models;

use CodeIgniter\Model;

class AlsusModel extends Model
{
    protected $table = 'alsus';
    protected $primaryKey = 'id_alsus';

    protected $allowedFields = ['id_satker', 'bmn', 'jumlah', 'bb', 'rr', 'rb', 'ket'];

    public function export()
    {
        $data = $this->alsusModel->findAll();

        // ...
    }

    public function getAlsusWithSatker()
    {
        return $this->select('alsus.*, satker.nama_satker AS nama_satker')
            ->join('satker', 'satker.id_satker = alsus.id_satker')
            ->findAll();
    }
}
