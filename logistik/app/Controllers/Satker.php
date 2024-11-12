<?php

namespace App\Controllers;

use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Satker extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $satkerModel = new SatkerModel();
        $data = [
            'title' => 'Data satker',
            'satker' => $satkerModel->findAll()
        ];

        return view('satker/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah satker',
            'validation' => \Config\Services::validation()
        ];

        return view('satker/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'nama_satker' => [
                'rules' => 'required|is_unique[satker.nama_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/satker/create')->withInput()->with('validation', $validation);
        }

        $satkerModel = new SatkerModel();
        $data = [
            'nama_satker' => $this->request->getPost('nama_satker')
        ];

        $satkerModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('satker/index'));
    }

    public function edit($id_satker)
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $satkerModel = new SatkerModel();
        $satker = $satkerModel->find($id_satker);

        if (!$satker) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data satker tidak ditemukan');
        }

        $data = [
            'title' => 'Edit satker',
            'satker' => $satker
        ];

        return view('satker/edit', $data);
    }
    public function update($id_satker)
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $satkerModel = new SatkerModel();
        $satker = $satkerModel->find($id_satker);

        if ($satker) {
            $data = [
                'nama_satker' => $this->request->getPost('nama_satker')
            ];

            $satkerModel->update($id_satker, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('satker/index'));
        } else {
            throw new \Exception('Data satker tidak ditemukan');
        }
    }

    public function delete($id_satker)
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $satkerModel = new SatkerModel();
        $satker = $satkerModel->find($id_satker);

        if ($satker) {
            $satkerModel->delete($id_satker);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('satker/index'));
        } else {
            throw new \Exception('Data satker tidak ditemukan');
        }
    }
}
