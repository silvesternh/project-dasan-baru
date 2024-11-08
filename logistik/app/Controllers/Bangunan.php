<?php

namespace App\Controllers;

use App\Models\BangunanModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Bangunan extends Controller
{
    public function index()
    {
        $bangunanModel = new BangunanModel();
        $data = [
            'title' => 'Data bangunan',
            'bangunan' => $bangunanModel->findAll()
        ];

        return view('bangunan/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah bangunan',
            'validation' => \Config\Services::validation()
        ];

        return view('bangunan/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'gedung' => [
                'rules' => 'required[bangunan.gedung]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'unit' => [
                'rules' => 'required[bangunan.unit]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'penghuni' => [
                'rules' => 'required[bangunan.penghuni]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'kondisi' => [
                'rules' => 'required[bangunan.kondisi]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'ket' => [
                'rules' => 'required[bangunan.ket]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/bangunan/create')->withInput()->with('validation', $validation);
        }

        $bangunanModel = new BangunanModel();
        $data = [
            'gedung' => $this->request->getPost('gedung'),
            'unit' => $this->request->getPost('unit'),
            'penghuni' => $this->request->getPost('penghuni'),
            'kondisi' => $this->request->getPost('kondisi'),
            'ket' => $this->request->getPost('ket')
        ];

        $bangunanModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('bangunan/index'));
    }

    public function edit($id_bangunan)
    {
        $bangunanModel = new BangunanModel();
        $bangunan = $bangunanModel->find($id_bangunan);

        if (!$bangunan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data bangunan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit bangunan',
            'bangunan' => $bangunan
        ];

        return view('bangunan/edit', $data);
    }
    public function update($id_bangunan)
    {
        $bangunanModel = new BangunanModel();
        $bangunan = $bangunanModel->find($id_bangunan);

        if ($bangunan) {
            $data = [
                'gedung' => $this->request->getPost('gedung'),
                'unit' => $this->request->getPost('unit'),
                'penghuni' => $this->request->getPost('penghuni'),
                'kondisi' => $this->request->getPost('kondisi'),
                'ket' => $this->request->getPost('ket')
            ];

            $bangunanModel->update($id_bangunan, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('bangunan/index'));
        } else {
            throw new \Exception('Data bangunan tidak ditemukan');
        }
    }

    public function delete($id_bangunan)
    {
        $bangunanModel = new BangunanModel();
        $bangunan = $bangunanModel->find($id_bangunan);

        if ($bangunan) {
            $bangunanModel->delete($id_bangunan);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('bangunan/index'));
        } else {
            throw new \Exception('Data bangunan tidak ditemukan');
        }
    }

    public function export()
    {
        // $this->export();
        $bangunanModel = new \App\Models\BangunanModel();
        $data = $bangunanModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $bangunanModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'gedung');
        $sheet->setCellValue('C1', 'unit');
        $sheet->setCellValue('D1', 'penghuni');
        $sheet->setCellValue('E1', 'kondisi');
        $sheet->setCellValue('F1', 'ket');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_bangunan']);
            $sheet->setCellValue('B' . $row, $item['gedung']);
            $sheet->setCellValue('C' . $row, $item['unit']);
            $sheet->setCellValue('D' . $row, $item['penghuni']);
            $sheet->setCellValue('E' . $row, $item['kondisi']);
            $sheet->setCellValue('F' . $row, $item['ket']);
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
        return view('bangunan/impor');
    }
}
