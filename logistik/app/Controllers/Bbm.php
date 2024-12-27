<?php

namespace App\Controllers;

use App\Models\BbmModel;
use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Bbm extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bbmModel = new BbmModel();
        $bbm = $bbmModel->getBbmWithSatker();
        $data = [
            'title' => 'Data bbm',
            'bbm' => $bbmModel->getBbmWithSatker()
        ];

        return view('bbm/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah bbm',
            'validation' => \Config\Services::validation()
        ];

        return view('bbm/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[bbm.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'p1' => [
                'rules' => 'required[bbm.p1]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'd1' => [
                'rules' => 'required[bbm.d1]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'p2' => [
                'rules' => 'required[bbm.p2]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'd2' => [
                'rules' => 'required[bbm.d2]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'p3' => [
                'rules' => 'required[bbm.p3]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'd3' => [
                'rules' => 'required[bbm.d3]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'p4' => [
                'rules' => 'required[bbm.p4]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'd4' => [
                'rules' => 'required[bbm.d4]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tahun' => [
                'rules' => 'required[bbm.tahun]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/bbm/create')->withInput()->with('validation', $validation);
        }

        $bbmModel = new BbmModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'p1' => $this->request->getPost('p1'),
            'd1' => $this->request->getPost('d1'),
            'p2' => $this->request->getPost('p2'),
            'd2' => $this->request->getPost('d2'),
            'p3' => $this->request->getPost('p3'),
            'd3' => $this->request->getPost('d3'),
            'p4' => $this->request->getPost('p4'),
            'd4' => $this->request->getPost('d4'),
            'tahun' => $this->request->getPost('tahun')
        ];

        $bbmModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('bbm/index'));
    }

    public function edit($id_bbm)
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bbmModel = new BbmModel();
        $bbm = $bbmModel->find($id_bbm);

        if (!$bbm) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data bbm tidak ditemukan');
        }

        $data = [
            'title' => 'Edit bbm',
            'bbm' => $bbm
        ];

        return view('bbm/edit', $data);
    }
    public function update($id_bbm)
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bbmModel = new BbmModel();
        $bbm = $bbmModel->find($id_bbm);

        if ($bbm) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
                'p1' => $this->request->getPost('p1'),
                'd1' => $this->request->getPost('d1'),
                'p2' => $this->request->getPost('p2'),
                'd2' => $this->request->getPost('d2'),
                'p3' => $this->request->getPost('p3'),
                'd3' => $this->request->getPost('d3'),
                'p4' => $this->request->getPost('p4'),
                'd4' => $this->request->getPost('d4'),
                'tahun' => $this->request->getPost('tahun')
            ];

            $bbmModel->update($id_bbm, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('bbm/index'));
        } else {
            throw new \Exception('Data bbm tidak ditemukan');
        }
    }

    public function delete($id_bbm)
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bbmModel = new BbmModel();
        $bbm = $bbmModel->find($id_bbm);

        if ($bbm) {
            $bbmModel->delete($id_bbm);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('bbm/index'));
        } else {
            throw new \Exception('Data bbm tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('bekum.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $bbmModel = new \App\Models\BbmModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');
        $tahun = $this->request->getGet('tahun');

        // Start with the base query
        $builder = $bbmModel->builder();

        // Ensure 'nama_satker' is included in the select query
        $builder->select('bbm.*, satker.nama_satker')
            ->join('satker', 'satker.id_satker = bbm.id_satker', 'left');

        // Apply filters if provided
        if ($satker) {
            $builder->where('satker.nama_satker', $satker);
        }
        if ($tahun) {
            $builder->where('bbm.tahun', $tahun);
        }

        // Execute the query and get the filtered data
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'PERTAMAX TW 1');
        $sheet->setCellValue('D1', 'DEXLITE TW 1');
        $sheet->setCellValue('E1', 'PERTAMAX TW 2');
        $sheet->setCellValue('F1', 'DEXLITE TW 2');
        $sheet->setCellValue('G1', 'PERTAMAX TW 3');
        $sheet->setCellValue('H1', 'DEXLITE TW 3');
        $sheet->setCellValue('I1', 'PERTAMAX TW 4');
        $sheet->setCellValue('J1', 'DEXLITE TW 4');
        $sheet->setCellValue('K1', 'TAHUN');

        // Apply styles to the header row
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50'],
            ],
        ];

        $sheet->getStyle('A1:K1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['nama_satker'] ?? ''); // Use the join result for 'nama_satker'
            $sheet->setCellValue('C' . $row, $item['p1']);
            $sheet->setCellValue('D' . $row, $item['d1']);
            $sheet->setCellValue('E' . $row, $item['p2']);
            $sheet->setCellValue('F' . $row, $item['d2']);
            $sheet->setCellValue('G' . $row, $item['p3']);
            $sheet->setCellValue('H' . $row, $item['d3']);
            $sheet->setCellValue('I' . $row, $item['p4']);
            $sheet->setCellValue('J' . $row, $item['d4']);
            $sheet->setCellValue('K' . $row, $item['tahun']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:K1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-bbm-' . date('Y-m-d-H-i-s') . '.xlsx';

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
        $model = new BbmModel();
        $bbm = $model->findAll();
        return view('bbm/tampil', ['bbm' => $bbm]);
    }
}
