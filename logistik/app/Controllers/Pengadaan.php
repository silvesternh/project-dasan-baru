<?php

namespace App\Controllers;

use App\Models\PengadaanModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengadaan extends Controller
{
    public function index()
    {
        $pengadaanModel = new PengadaanModel();
        $data = [
            'title' => 'Data pengadaan',
            'pengadaan' => $pengadaanModel->findAll()
        ];

        return view('pengadaan/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah pengadaan',
            'validation' => \Config\Services::validation()
        ];

        return view('pengadaan/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'satker' => [
                'rules' => 'required[pengadaan.satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'paket' => [
                'rules' => 'required[pengadaan.paket]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pagu' => [
                'rules' => 'required[pengadaan.pagu]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'kontrak' => [
                'rules' => 'required[pengadaan.kontrak]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'no_kontrak' => [
                'rules' => 'required[pengadaan.no_kontrak]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'mulai_kontrak' => [
                'rules' => 'required[pengadaan.mulai_kontrak]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'akhir_kontrak' => [
                'rules' => 'required[pengadaan.akhir_kontrak]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'penyedia' => [
                'rules' => 'required[pengadaan.penyedia]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'metode' => [
                'rules' => 'required[pengadaan.metode]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/pengadaan/create')->withInput()->with('validation', $validation);
        }

        $pengadaanModel = new PengadaanModel();
        $data = [
            'satker' => $this->request->getPost('satker'),
            'paket' => $this->request->getPost('paket'),
            'pagu' => $this->request->getPost('pagu'),
            'kontrak' => $this->request->getPost('kontrak'),
            'no_kontrak' => $this->request->getPost('no_kontrak'),
            'mulai_kontrak' => $this->request->getPost('mulai_kontrak'),
            'akhir_kontrak' => $this->request->getPost('akhir_kontrak'),
            'penyedia' => $this->request->getPost('penyedia'),
            'metode' => $this->request->getPost('metode')
        ];

        $pengadaanModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('pengadaan/index'));
    }

    public function edit($id_pengadaan)
    {
        $pengadaanModel = new PengadaanModel();
        $pengadaan = $pengadaanModel->find($id_pengadaan);

        if (!$pengadaan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengadaan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit pengadaan',
            'pengadaan' => $pengadaan
        ];

        return view('pengadaan/edit', $data);
    }
    public function update($id_pengadaan)
    {
        $pengadaanModel = new PengadaanModel();
        $pengadaan = $pengadaanModel->find($id_pengadaan);

        if ($pengadaan) {
            $data = [
                'satker' => $this->request->getPost('satker'),
                'paket' => $this->request->getPost('paket'),
                'pagu' => $this->request->getPost('pagu'),
                'kontrak' => $this->request->getPost('kontrak'),
                'no_kontrak' => $this->request->getPost('no_kontrak'),
                'mulai_kontrak' => $this->request->getPost('mulai_kontrak'),
                'akhir_kontrak' => $this->request->getPost('akhir_kontrak'),
                'penyedia' => $this->request->getPost('penyedia'),
                'metode' => $this->request->getPost('metode')
            ];

            $pengadaanModel->update($id_pengadaan, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('pengadaan/index'));
        } else {
            throw new \Exception('Data pengadaan tidak ditemukan');
        }
    }

    public function delete($id_pengadaan)
    {
        $pengadaanModel = new PengadaanModel();
        $pengadaan = $pengadaanModel->find($id_pengadaan);

        if ($pengadaan) {
            $pengadaanModel->delete($id_pengadaan);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('pengadaan/index'));
        } else {
            throw new \Exception('Data pengadaan tidak ditemukan');
        }
    }

    public function export()
    {
        // $this->export();
        $pengadaanModel = new \App\Models\PengadaanModel();
        $data = $pengadaanModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $pengadaanModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Satker');
        $sheet->setCellValue('C1', 'Paket');
        $sheet->setCellValue('D1', 'Pagu');
        $sheet->setCellValue('E1', 'Kontrak');
        $sheet->setCellValue('F1', 'Nomor kontrak');
        $sheet->setCellValue('G1', 'Mulai_kontrak');
        $sheet->setCellValue('H1', 'Akhir_kontrak');
        $sheet->setCellValue('I1', 'Penyedia');
        $sheet->setCellValue('J1', 'Metode');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_pengadaan']);
            $sheet->setCellValue('B' . $row, $item['satker']);
            $sheet->setCellValue('C' . $row, $item['paket']);
            $sheet->setCellValue('D' . $row, $item['pagu']);
            $sheet->setCellValue('E' . $row, $item['kontrak']);
            $sheet->setCellValue('F' . $row, $item['no_kontrak']);
            $sheet->setCellValue('G' . $row, $item['mulai_kontrak']);
            $sheet->setCellValue('H' . $row, $item['akhir_kontrak']);
            $sheet->setCellValue('I' . $row, $item['penyedia']);
            $sheet->setCellValue('J' . $row, $item['metode']);
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
        return view('pengadaan/impor');
    }
}
