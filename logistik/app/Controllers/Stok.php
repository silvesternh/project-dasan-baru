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
            'kode' => [
                'rules' => 'required[stok.kode]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'uraian' => [
                'rules' => 'required[stok.uraian]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jumlah' => [
                'rules' => 'required[stok.jumlah]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'keluar' => [
                'rules' => 'required[stok.keluar]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'masuk' => [
                'rules' => 'required[stok.masuk]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'sisa' => [
                'rules' => 'required[stok.sisa]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'ket' => [
                'rules' => 'required[stok.ket]',
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
            'kode' => $this->request->getPost('kode'),
            'uraian' => $this->request->getPost('uraian'),
            'jumlah' => $this->request->getPost('jumlah'),
            'keluar' => $this->request->getPost('keluar'),
            'masuk' => $this->request->getPost('masuk'),
            'sisa' => $this->request->getPost('sisa'),
            'ket' => $this->request->getPost('ket')
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
                'kode' => $this->request->getPost('kode'),
                'uraian' => $this->request->getPost('uraian'),
                'jumlah' => $this->request->getPost('jumlah'),
                'keluar' => $this->request->getPost('keluar'),
                'masuk' => $this->request->getPost('masuk'),
                'sisa' => $this->request->getPost('sisa'),
                'ket' => $this->request->getPost('ket')
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


        $kode = $this->request->getGet('kode');

        // Start with the base query
        $builder = $stokModel->builder();


        if ($kode) {
            $builder->where('stok.kode', $kode);
        }
        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'KODE BARANG');
        $sheet->setCellValue('C1', 'URAIAN');
        $sheet->setCellValue('D1', 'JUMLAH');
        $sheet->setCellValue('E1', 'KELUAR');
        $sheet->setCellValue('F1', 'MASUK');
        $sheet->setCellValue('G1', 'SISA');
        $sheet->setCellValue('H1', 'KETERANGAN');

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

        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            // Since we are joining, 'satker' is available in the data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['kode']);
            $sheet->setCellValue('C' . $row, $item['uraian']);
            $sheet->setCellValue('D' . $row, $item['jumlah']);
            $sheet->setCellValue('E' . $row, $item['keluar']);
            $sheet->setCellValue('F' . $row, $item['masuk']);
            $sheet->setCellValue('G' . $row, $item['sisa']);
            $sheet->setCellValue('H' . $row, $item['ket']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:H1');

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
