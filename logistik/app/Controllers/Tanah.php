<?php

namespace App\Controllers;

use App\Models\TanahModel;
use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tanah extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $tanahModel = new TanahModel();
        $tanah = $tanahModel->getTanahWithSatker();
        $data = [
            'title' => 'Data tanah',
            'tanah' => $tanahModel->getTanahWithSatker()
        ];

        return view('tanah/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah tanah',
            'validation' => \Config\Services::validation()
        ];

        return view('tanah/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[tanah.id_satker]',
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
            'id_satker' => $this->request->getPost('id_satker'),
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $tanahModel = new TanahModel();
        $tanah = $tanahModel->find($id_tanah);

        if ($tanah) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
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
        if (!auth()->user()->can('faskon.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $tanahModel = new \App\Models\TanahModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');
        $status = $this->request->getGet('status');

        // Start with the base query
        $builder = $tanahModel->builder();

        // If filters are applied, add the necessary conditions
        if ($satker) {
            // Use a join to filter by 'nama_satker' from the 'satker' table
            $builder->join('satker', 'satker.id_satker = tanah.id_satker')
                ->where('satker.nama_satker', $satker);
        }

        if ($status) {
            $builder->where('tanah.status', $status);
        }

        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'LUAS TANAH');
        $sheet->setCellValue('D1', 'BUDANG');
        $sheet->setCellValue('E1', 'STATUS');

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

        $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            // Since we are joining, 'satker' is available in the data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, isset($item['nama_satker']) ? $item['nama_satker'] : ''); // Check if the satker name exists
            $sheet->setCellValue('C' . $row, $item['luas']);
            $sheet->setCellValue('D' . $row, $item['bidang']);
            $sheet->setCellValue('E' . $row, $item['status']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:E1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-tanah-' . date('Y-m-d-H-i-s') . '.xlsx';

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
        $model = new TanahModel();
        $tanah = $model->findAll();
        return view('tanah/tampil', ['tanah' => $tanah]);
    }
}
