<?php

namespace App\Controllers;

use App\Models\StokModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stok extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokModel = new StokModel();
        $data = [
            'title' => 'Data stok',
            'stok' => $stokModel->findAll()
        ];

        return view('stok/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah stok',
            'validation' => \Config\Services::validation()
        ];

        return view('stok/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'uraian' => [
                'rules' => 'required[stok.uraian]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'satuan' => [
                'rules' => 'required[stok.satuan]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jumlah' => [
                'rules' => 'required[stok.jumlah]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/stok/create')->withInput()->with('validation', $validation);
        }

        $stokModel = new StokModel();
        $data = [
            'uraian' => $this->request->getPost('uraian'),
            'satuan' => $this->request->getPost('satuan'),
            'jumlah' => $this->request->getPost('jumlah')
        ];

        $stokModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('stok/index'));
    }

    public function edit($id_stok)
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokModel = new StokModel();
        $stok = $stokModel->find($id_stok);

        if (!$stok) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data stok tidak ditemukan');
        }

        $data = [
            'title' => 'Edit stok',
            'stok' => $stok
        ];

        return view('stok/edit', $data);
    }
    public function update($id_stok)
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokModel = new StokModel();
        $stok = $stokModel->find($id_stok);

        if ($stok) {
            $data = [
                'uraian' => $this->request->getPost('uraian'),
                'satuan' => $this->request->getPost('satuan'),
                'jumlah' => $this->request->getPost('jumlah')
            ];

            $stokModel->update($id_stok, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('stok/index'));
        } else {
            throw new \Exception('Data stok tidak ditemukan');
        }
    }

    public function delete($id_stok)
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokModel = new StokModel();
        $stok = $stokModel->find($id_stok);

        if ($stok) {
            $stokModel->delete($id_stok);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('stok/index'));
        } else {
            throw new \Exception('Data stok tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokModel = new \App\Models\StokModel();


        $uraian = $this->request->getGet('uraian');

        // Start with the base query
        $builder = $stokModel->builder();


        if ($uraian) {
            $builder->where('stok.uraian', $uraian);
        }
        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'URAIAN');
        $sheet->setCellValue('C1', 'SATUAN');
        $sheet->setCellValue('D1', 'JUMLAH');

        // Apply styles to the header row
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'], // White text color
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50'], // Green background color
            ],
        ];

        $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            // Since we are joining, 'satker' is available in the data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['uraian']);
            $sheet->setCellValue('C' . $row, $item['satuan']);
            $sheet->setCellValue('D' . $row, $item['jumlah']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:D1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-stok-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $model = new StokModel();
        $stok = $model->findAll();
        return view('stok/tampil', ['stok' => $stok]);
    }
}
