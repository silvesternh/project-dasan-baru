<?php

namespace App\Controllers;

use App\Models\KaporModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kapor extends Controller
{
    public function index()
    {
        $kaporModel = new KaporModel();
        $data = [
            'title' => 'Data kapor',
            'kapor' => $kaporModel->findAll()
        ];

        return view('kapor/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah kapor',
            'validation' => \Config\Services::validation()
        ];

        return view('kapor/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => [
                'rules' => 'required[kapor.nama]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'satuan' => [
                'rules' => 'required[kapor.satuan]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'volume' => [
                'rules' => 'required[kapor.volume]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'harga' => [
                'rules' => 'required[kapor.harga]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jumlah' => [
                'rules' => 'required[kapor.jumlah]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tahun' => [
                'rules' => 'required[kapor.tahun]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/kapor/create')->withInput()->with('validation', $validation);
        }

        $kaporModel = new KaporModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'satuan' => $this->request->getPost('satuan'),
            'volume' => $this->request->getPost('volume'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tahun' => $this->request->getPost('tahun')
        ];

        $kaporModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('kapor/index'));
    }

    public function edit($id_kapor)
    {
        $kaporModel = new KaporModel();
        $kapor = $kaporModel->find($id_kapor);

        if (!$kapor) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data kapor tidak ditemukan');
        }

        $data = [
            'title' => 'Edit kapor',
            'kapor' => $kapor
        ];

        return view('kapor/edit', $data);
    }
    public function update($id_kapor)
    {
        $kaporModel = new KaporModel();
        $kapor = $kaporModel->find($id_kapor);

        if ($kapor) {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'satuan' => $this->request->getPost('satuan'),
                'volume' => $this->request->getPost('volume'),
                'harga' => $this->request->getPost('harga'),
                'jumlah' => $this->request->getPost('jumlah'),
                'tahun' => $this->request->getPost('tahun')
            ];

            $kaporModel->update($id_kapor, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('kapor/index'));
        } else {
            throw new \Exception('Data kapor tidak ditemukan');
        }
    }

    public function delete($id_kapor)
    {
        $kaporModel = new KaporModel();
        $kapor = $kaporModel->find($id_kapor);

        if ($kapor) {
            $kaporModel->delete($id_kapor);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('kapor/index'));
        } else {
            throw new \Exception('Data kapor tidak ditemukan');
        }
    }

    public function export()
    {
        // $this->export();
        $kaporModel = new \App\Models\KaporModel();
        $data = $kaporModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $kaporModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Satuan');
        $sheet->setCellValue('D1', 'Volume');
        $sheet->setCellValue('E1', 'Harga');
        $sheet->setCellValue('F1', 'Jumlah');
        $sheet->setCellValue('G1', 'Tahun');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_kapor']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['satuan']);
            $sheet->setCellValue('D' . $row, $item['volume']);
            $sheet->setCellValue('E' . $row, $item['harga']);
            $sheet->setCellValue('F' . $row, $item['jumlah']);
            $sheet->setCellValue('G' . $row, $item['tahun']);
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
        return view('kapor/impor');
    }
}
