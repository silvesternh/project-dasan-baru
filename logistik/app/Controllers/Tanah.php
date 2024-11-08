<?php

namespace App\Controllers;

use App\Models\TanahModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tanah extends Controller
{
    public function index()
    {
        $tanahModel = new TanahModel();
        $data = [
            'title' => 'Data tanah',
            'tanah' => $tanahModel->findAll()
        ];

        return view('tanah/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah tanah',
            'validation' => \Config\Services::validation()
        ];

        return view('tanah/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'satker' => [
                'rules' => 'required[tanah.satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'luas' => [
                'rules' => 'required[tanah.luas]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'bidang' => [
                'rules' => 'required[tanah.bidang]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'status' => [
                'rules' => 'required[tanah.status]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/tanah/create')->withInput()->with('validation', $validation);
        }

        $tanahModel = new TanahModel();
        $data = [
            'satker' => $this->request->getPost('satker'),
            'luas' => $this->request->getPost('luas'),
            'bidang' => $this->request->getPost('bidang'),
            'status' => $this->request->getPost('status')
        ];

        $tanahModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('tanah/index'));
    }

    public function edit($id_tanah)
    {
        $tanahModel = new TanahModel();
        $tanah = $tanahModel->find($id_tanah);

        if (!$tanah) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tanah tidak ditemukan');
        }

        $data = [
            'title' => 'Edit tanah',
            'tanah' => $tanah
        ];

        return view('tanah/edit', $data);
    }
    public function update($id_tanah)
    {
        $tanahModel = new TanahModel();
        $tanah = $tanahModel->find($id_tanah);

        if ($tanah) {
            $data = [
                'satker' => $this->request->getPost('satker'),
                'luas' => $this->request->getPost('luas'),
                'bidang' => $this->request->getPost('bidang'),
                'status' => $this->request->getPost('status')
            ];

            $tanahModel->update($id_tanah, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('tanah/index'));
        } else {
            throw new \Exception('Data tanah tidak ditemukan');
        }
    }

    public function delete($id_tanah)
    {
        $tanahModel = new TanahModel();
        $tanah = $tanahModel->find($id_tanah);

        if ($tanah) {
            $tanahModel->delete($id_tanah);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('tanah/index'));
        } else {
            throw new \Exception('Data tanah tidak ditemukan');
        }
    }

    public function export()
    {
        // $this->export();
        $tanahModel = new \App\Models\TanahModel();
        $data = $tanahModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $tanahModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Satker');
        $sheet->setCellValue('C1', 'Luas');
        $sheet->setCellValue('D1', 'Bidang');
        $sheet->setCellValue('E1', 'Status');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_tanah']);
            $sheet->setCellValue('B' . $row, $item['satker']);
            $sheet->setCellValue('C' . $row, $item['luas']);
            $sheet->setCellValue('D' . $row, $item['bidang']);
            $sheet->setCellValue('E' . $row, $item['status']);
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
        return view('tanah/impor');
    }

    public function tampil(): string
    {
        return view('tanah/tampil');
    }
}
