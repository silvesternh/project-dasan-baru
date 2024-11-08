<?php

namespace App\Controllers;

use App\Models\SertifikasiModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sertifikasi extends Controller
{
    public function index()
    {
        $sertifikasiModel = new SertifikasiModel();
        $data = [
            'title' => 'Data sertifikasi',
            'sertifikasi' => $sertifikasiModel->findAll()
        ];

        return view('sertifikasi/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah sertifikasi',
            'validation' => \Config\Services::validation()
        ];

        return view('sertifikasi/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'satker' => [
                'rules' => 'required[sertifikasi.satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required[sertifikasi.nama]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pangkat' => [
                'rules' => 'required[sertifikasi.pangkat]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nrp' => [
                'rules' => 'required[sertifikasi.nrp]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jabatan' => [
                'rules' => 'required[sertifikasi.jabatan]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nomor' => [
                'rules' => 'required[sertifikasi.nomor]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'hp' => [
                'rules' => 'required[sertifikasi.hp]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/sertifikasi/create')->withInput()->with('validation', $validation);
        }

        $sertifikasiModel = new SertifikasiModel();
        $data = [
            'satker' => $this->request->getPost('satker'),
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan'),
            'nomor' => $this->request->getPost('nomor'),
            'hp' => $this->request->getPost('hp')
        ];

        $sertifikasiModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('sertifikasi/index'));
    }

    public function edit($id_sertifikasi)
    {
        $sertifikasiModel = new SertifikasiModel();
        $sertifikasi = $sertifikasiModel->find($id_sertifikasi);

        if (!$sertifikasi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data sertifikasi tidak ditemukan');
        }

        $data = [
            'title' => 'Edit sertifikasi',
            'sertifikasi' => $sertifikasi
        ];

        return view('sertifikasi/edit', $data);
    }
    public function update($id_sertifikasi)
    {
        $sertifikasiModel = new SertifikasiModel();
        $sertifikasi = $sertifikasiModel->find($id_sertifikasi);

        if ($sertifikasi) {
            $data = [
                'satker' => $this->request->getPost('satker'),
                'nama' => $this->request->getPost('nama'),
                'pangkat' => $this->request->getPost('pangkat'),
                'nrp' => $this->request->getPost('nrp'),
                'jabatan' => $this->request->getPost('jabatan'),
                'nomor' => $this->request->getPost('nomor'),
                'hp' => $this->request->getPost('hp')
            ];

            $sertifikasiModel->update($id_sertifikasi, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('sertifikasi/index'));
        } else {
            throw new \Exception('Data sertifikasi tidak ditemukan');
        }
    }

    public function delete($id_sertifikasi)
    {
        $sertifikasiModel = new SertifikasiModel();
        $sertifikasi = $sertifikasiModel->find($id_sertifikasi);

        if ($sertifikasi) {
            $sertifikasiModel->delete($id_sertifikasi);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('sertifikasi/index'));
        } else {
            throw new \Exception('Data sertifikasi tidak ditemukan');
        }
    }

    public function export()
    {
        // $this->export();
        $sertifikasiModel = new \App\Models\SertifikasiModel();
        $data = $sertifikasiModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $sertifikasiModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Satker');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Pangkat');
        $sheet->setCellValue('E1', 'NRP/NIP');
        $sheet->setCellValue('F1', 'jabatan');
        $sheet->setCellValue('G1', 'Nomor Sertifikat');
        $sheet->setCellValue('H1', 'Nomor Hp');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_sertifikasi']);
            $sheet->setCellValue('B' . $row, $item['satker']);
            $sheet->setCellValue('C' . $row, $item['nama']);
            $sheet->setCellValue('D' . $row, $item['pangkat']);
            $sheet->setCellValue('E' . $row, $item['nrp']);
            $sheet->setCellValue('F' . $row, $item['jabatan']);
            $sheet->setCellValue('G' . $row, $item['nomor']);
            $sheet->setCellValue('H' . $row, $item['hp']);
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
        return view('sertifikasi/impor');
    }
}
