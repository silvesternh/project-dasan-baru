<?php

namespace App\Controllers;

use App\Models\MerkModel;
use CodeIgniter\Controller;

class Merk extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $merkModel = new MerkModel();
        $data = [
            'title' => 'Data merk',
            'merk' => $merkModel->findAll()
        ];

        return view('merk/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah merk',
            'validation' => \Config\Services::validation()
        ];

        return view('merk/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'nama_merk' => [
                'rules' => 'required|is_unique[merk.nama_merk]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/merk/create')->withInput()->with('validation', $validation);
        }

        $merkModel = new MerkModel();
        $data = [
            'nama_merk' => $this->request->getPost('nama_merk')
        ];

        $merkModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('merk/index'));
    }

    public function edit($id_merk)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $merkModel = new MerkModel();
        $merk = $merkModel->find($id_merk);

        if (!$merk) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data merk tidak ditemukan');
        }

        $data = [
            'title' => 'Edit merk',
            'merk' => $merk
        ];

        return view('merk/edit', $data);
    }
    public function update($id_merk)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $merkModel = new MerkModel();
        $merk = $merkModel->find($id_merk);

        if ($merk) {
            $data = [
                'nama_merk' => $this->request->getPost('nama_merk')
            ];

            $merkModel->update($id_merk, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('merk/index'));
        } else {
            throw new \Exception('Data merk tidak ditemukan');
        }
    }

    public function delete($id_merk)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $merkModel = new MerkModel();

        // Check if the merk entry exists
        $merk = $merkModel->find($id_merk);

        if (!$merk) {
            // If the merk is not found, show a custom error message
            session()->setFlashdata('error', 'Data merk tidak ditemukan');
            return redirect()->to(base_url('merk/index'));
        }

        // Attempt to delete the merk entry with a where clause
        try {
            $merkModel->where('id_merk', $id_merk)->delete();
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Capture any exception, possibly due to foreign key constraints
            session()->setFlashdata('error', 'Gagal menghapus data merk. Pastikan tidak ada data yang terkait.');
        }

        // Redirect back to the merk index page
        return redirect()->to(base_url('merk/index'));
    }
}
