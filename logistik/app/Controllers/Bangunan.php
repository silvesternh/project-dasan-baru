<?php

namespace App\Controllers;

use App\Models\BangunanModel;
use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Bangunan extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bangunanModel = new BangunanModel();
        $bangunan = $bangunanModel->getBangunanWithSatker();
        $data = [
            'title' => 'Data bangunan',
            'bangunan' => $bangunanModel->getBangunanWithSatker()
        ];

        return view('bangunan/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah bangunan',
            'validation' => \Config\Services::validation()
        ];

        return view('bangunan/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[bangunan.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
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
            'id_satker' => $this->request->getPost('id_satker'),
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bangunanModel = new BangunanModel();
        $bangunan = $bangunanModel->find($id_bangunan);

        if ($bangunan) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bangunanModel = new \App\Models\BangunanModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');
        $kondisi = $this->request->getGet('kondisi');

        // Start with the base query
        $builder = $bangunanModel->builder();

        // If filters are applied, add the necessary conditions
        if ($satker) {
            // Use a join to filter by 'nama_satker' from the 'satker' table
            $builder->join('satker', 'satker.id_satker = bangunan.id_satker')
                ->where('satker.nama_satker', $satker);
        }

        if ($kondisi) {
            $builder->where('bangunan.kondisi', $kondisi);
        }

        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'JENIS GEDUNG');
        $sheet->setCellValue('D1', 'JUMLAH UNIT');
        $sheet->setCellValue('E1', 'NAMA PENGHUNI');
        $sheet->setCellValue('F1', 'KONDISI');
        $sheet->setCellValue('G1', 'KETERANGAN');

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
            $sheet->setCellValue('B' . $row, isset($item['nama_satker']) ? $item['nama_satker'] : ''); // Check if the satker name exists
            $sheet->setCellValue('C' . $row, $item['gedung']);
            $sheet->setCellValue('D' . $row, $item['unit']);
            $sheet->setCellValue('E' . $row, $item['penghuni']);
            $sheet->setCellValue('F' . $row, $item['kondisi']);
            $sheet->setCellValue('G' . $row, $item['ket']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:G1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-bangunan-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $model = new BangunanModel();
        $bangunan = $model->findAll();
        return view('bangunan/tampil', ['bangunan' => $bangunan]);
    }
}
