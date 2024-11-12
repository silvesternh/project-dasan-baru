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
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $kaporModel = new KaporModel();
        $data = [
            'title' => 'Data kapor',
            'kapor' => $kaporModel->findAll()
        ];

        return view('kapor/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah kapor',
            'validation' => \Config\Services::validation()
        ];

        return view('kapor/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $kaporModel = new \App\Models\kaporModel();


        $nama = $this->request->getGet('nama');
        $tahun = $this->request->getGet('tahun');

        // Start with the base query
        $builder = $kaporModel->builder();


        if ($nama) {
            $builder->where('kapor.nama', $nama);
        }
        if ($tahun) {
            $builder->where('kapor.tahun', $tahun);
        }

        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NAMA BARANG');
        $sheet->setCellValue('C1', 'SATUAN');
        $sheet->setCellValue('D1', 'VOLUME');
        $sheet->setCellValue('E1', 'HARGA SATUAN');
        $sheet->setCellValue('F1', 'JUMLAH');
        $sheet->setCellValue('G1', 'TAHUN');

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

        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            // Since we are joining, 'satker' is available in the data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['satuan']);
            $sheet->setCellValue('D' . $row, $item['volume']);
            $sheet->setCellValue('E' . $row, $item['harga']);
            $sheet->setCellValue('F' . $row, $item['jumlah']);
            $sheet->setCellValue('G' . $row, $item['tahun']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:G1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-kapor-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $model = new kaporModel();
        $kapor = $model->findAll();
        return view('kapor/tampil', ['kapor' => $kapor]);
    }
}
