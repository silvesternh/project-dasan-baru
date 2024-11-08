<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggota extends Controller
{
    public function index()
    {
        $anggotaModel = new AnggotaModel();
        $data = [
            'title' => 'Data Anggota',
            'anggota' => $anggotaModel->findAll()
        ];

        return view('anggota/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah Anggota',
            'validation' => \Config\Services::validation()
        ];

        return view('anggota/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => [
                'rules' => 'required[anggota.nama]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pangkat' => [
                'rules' => 'required[anggota.pangkat]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nrp' => [
                'rules' => 'required|is_unique[anggota.nrp]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ],
            'jabatan' => [
                'rules' => 'required|is_unique[anggota.jabatan]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/anggota/create')->withInput()->with('validation', $validation);
        }

        $anggotaModel = new AnggotaModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan'),
            'foto' => $this->request->getPost('foto')
        ];

        $anggotaModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('anggota/index'));
    }

    public function edit($id_anggota)
    {
        $anggotaModel = new AnggotaModel();
        $anggota = $anggotaModel->find($id_anggota);

        if (!$anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Anggota',
            'anggota' => $anggota
        ];

        return view('anggota/edit', $data);
    }
    public function update($id_anggota)
    {
        $anggotaModel = new AnggotaModel();
        $anggota = $anggotaModel->find($id_anggota);

        if ($anggota) {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'pangkat' => $this->request->getPost('pangkat'),
                'nrp' => $this->request->getPost('nrp'),
                'jabatan' => $this->request->getPost('jabatan'),
                'foto' => $this->request->getPost('foto')
            ];

            $anggotaModel->update($id_anggota, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('anggota/index'));
        } else {
            throw new \Exception('Data anggota tidak ditemukan');
        }
    }

    public function delete($id_anggota)
    {
        $anggotaModel = new AnggotaModel();
        $anggota = $anggotaModel->find($id_anggota);

        if ($anggota) {
            $anggotaModel->delete($id_anggota);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('anggota/index'));
        } else {
            throw new \Exception('Data anggota tidak ditemukan');
        }
    }

    public function export()
    {
        // $this->export();
        $anggotaModel = new \App\Models\AnggotaModel();
        $data = $anggotaModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $anggotaModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Pangkat');
        $sheet->setCellValue('D1', 'Nrp');
        $sheet->setCellValue('E1', 'Jabatan');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_anggota']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['pangkat']);
            $sheet->setCellValue('D' . $row, $item['nrp']);
            $sheet->setCellValue('E' . $row, $item['jabatan']);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function impor()
    {
        return view('anggota/impor');
    }
}
