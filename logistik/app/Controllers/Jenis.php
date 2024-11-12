<?php

namespace App\Controllers;

use App\Models\JenisModel;
use CodeIgniter\Controller;

class Jenis extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $jenisModel = new JenisModel();
        $data = [
            'title' => 'Data jenis',
            'jenis' => $jenisModel->findAll()
        ];

        return view('jenis/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah jenis',
            'validation' => \Config\Services::validation()
        ];

        return view('jenis/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'nama_jenis' => [
                'rules' => 'required|is_unique[jenis.nama_jenis]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/jenis/create')->withInput()->with('validation', $validation);
        }

        $jenisModel = new JenisModel();
        $data = [
            'nama_jenis' => $this->request->getPost('nama_jenis')
        ];

        $jenisModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('jenis/index'));
    }

    public function edit($id_jenis)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $jenisModel = new JenisModel();
        $jenis = $jenisModel->find($id_jenis);

        if (!$jenis) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data jenis tidak ditemukan');
        }

        $data = [
            'title' => 'Edit jenis',
            'jenis' => $jenis
        ];

        return view('jenis/edit', $data);
    }
    public function update($id_jenis)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $jenisModel = new JenisModel();
        $jenis = $jenisModel->find($id_jenis);

        if ($jenis) {
            $data = [
                'nama_jenis' => $this->request->getPost('nama_jenis')
            ];

            $jenisModel->update($id_jenis, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('jenis/index'));
        } else {
            throw new \Exception('Data jenis tidak ditemukan');
        }
    }

    public function delete($id_jenis)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $jenisModel = new JenisModel();
        $jenis = $jenisModel->find($id_jenis);

        if ($jenis) {
            $jenisModel->delete($id_jenis);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('jenis/index'));
        } else {
            throw new \Exception('Data jenis tidak ditemukan');
        }
    }
}
