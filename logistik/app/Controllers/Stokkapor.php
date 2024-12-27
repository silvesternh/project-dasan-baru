<?php

namespace App\Controllers;

use App\Models\StokkaporModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stokkapor extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokkaporModel = new StokkaporModel();
        $data = [
            'title' => 'Data stokkapor',
            'stokkapor' => $stokkaporModel->findAll()
        ];

        return view('stokkapor/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah stokkapor',
            'validation' => \Config\Services::validation()
        ];

        return view('stokkapor/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'uraian' => [
                'rules' => 'required[stokkapor.uraian]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'satuan' => [
                'rules' => 'required[stokkapor.satuan]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jumlah' => [
                'rules' => 'required[stokkapor.jumlah]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/stokkapor/create')->withInput()->with('validation', $validation);
        }

        $stokkaporModel = new StokkaporModel();
        $data = [
            'uraian' => $this->request->getPost('uraian'),
            'satuan' => $this->request->getPost('satuan'),
            'jumlah' => $this->request->getPost('jumlah')
        ];

        $stokkaporModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('stokkapor/index'));
    }

    public function edit($id_stokkapor)
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokkaporModel = new StokkaporModel();
        $stokkapor = $stokkaporModel->find($id_stokkapor);

        if (!$stokkapor) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data stokkapor tidak ditemukan');
        }

        $data = [
            'title' => 'Edit stokkapor',
            'stokkapor' => $stokkapor
        ];

        return view('stokkapor/edit', $data);
    }
    public function update($id_stokkapor)
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokkaporModel = new StokkaporModel();
        $stokkapor = $stokkaporModel->find($id_stokkapor);

        if ($stokkapor) {
            $data = [
                'uraian' => $this->request->getPost('uraian'),
                'satuan' => $this->request->getPost('satuan'),
                'jumlah' => $this->request->getPost('jumlah')
            ];

            $stokkaporModel->update($id_stokkapor, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('stokkapor/index'));
        } else {
            throw new \Exception('Data stokkapor tidak ditemukan');
        }
    }

    public function delete($id_stokkapor)
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokkaporModel = new StokkaporModel();
        $stokkapor = $stokkaporModel->find($id_stokkapor);

        if ($stokkapor) {
            $stokkaporModel->delete($id_stokkapor);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('stokkapor/index'));
        } else {
            throw new \Exception('Data stokkapor tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('gudang.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $stokkaporModel = new \App\Models\StokkaporModel();


        $uraian = $this->request->getGet('uraian');

        // Start with the base query
        $builder = $stokkaporModel->builder();


        if ($uraian) {
            $builder->where('stokkapor.uraian', $uraian);
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
        $filename = 'data-stokkapor-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {

        $model = new StokkaporModel();
        $stokkapor = $model->findAll();
        return view('stokkapor/tampil', ['stokkapor' => $stokkapor]);
    }
}
