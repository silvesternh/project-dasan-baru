<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kendaraan extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->getKendaraanWithSatker();
        $data = [
            'title' => 'Data kendaraan',
            'kendaraan' => $kendaraanModel->getKendaraanWithSatker()
        ];

        return view('kendaraan/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah kendaraan',
            'validation' => \Config\Services::validation()
        ];

        return view('kendaraan/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[kendaraan.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nopol' => [
                'rules' => 'required[kendaraan.nopol]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jenis' => [
                'rules' => 'required[kendaraan.jenis]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'merk' => [
                'rules' => 'required[kendaraan.merk]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tahun' => [
                'rules' => 'required[kendaraan.tahun]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'mesin' => [
                'rules' => 'required|is_unique[kendaraan.mesin]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ],
            'rangka' => [
                'rules' => 'required|is_unique[kendaraan.rangka]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ],
            'kondisi' => [
                'rules' => 'required[kendaraan.kondisi]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'roda' => [
                'rules' => 'required[kendaraan.roda]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pemegang' => [
                'rules' => 'required[kendaraan.pemegang]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pangkat' => [
                'rules' => 'required[kendaraan.pangkat]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nrp' => [
                'rules' => 'required|is_unique[kendaraan.nrp]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ],
            'jabatan' => [
                'rules' => 'required[kendaraan.jabatan]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/kendaraan/create')->withInput()->with('validation', $validation);
        }

        $kendaraanModel = new KendaraanModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'nopol' => $this->request->getPost('nopol'),
            'jenis' => $this->request->getPost('jenis'),
            'merk' => $this->request->getPost('merk'),
            'tahun' => $this->request->getPost('tahun'),
            'mesin' => $this->request->getPost('mesin'),
            'rangka' => $this->request->getPost('rangka'),
            'kondisi' => $this->request->getPost('kondisi'),
            'roda' => $this->request->getPost('roda'),
            'pemegang' => $this->request->getPost('pemegang'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan')
        ];

        $kendaraanModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('kendaraan/index'));
    }

    public function edit($id_kendaraan)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->find($id_kendaraan);

        if (!$kendaraan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data kendaraan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit kendaraan',
            'kendaraan' => $kendaraan
        ];

        return view('kendaraan/edit', $data);
    }
    public function update($id_kendaraan)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->find($id_kendaraan);

        if ($kendaraan) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
                'nopol' => $this->request->getPost('nopol'),
                'jenis' => $this->request->getPost('jenis'),
                'merk' => $this->request->getPost('merk'),
                'tahun' => $this->request->getPost('tahun'),
                'mesin' => $this->request->getPost('mesin'),
                'rangka' => $this->request->getPost('rangka'),
                'kondisi' => $this->request->getPost('kondisi'),
                'roda' => $this->request->getPost('roda'),
                'pemegang' => $this->request->getPost('pemegang'),
                'pangkat' => $this->request->getPost('pangkat'),
                'nrp' => $this->request->getPost('nrp'),
                'jabatan' => $this->request->getPost('jabatan')
            ];

            $kendaraanModel->update($id_kendaraan, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('kendaraan/index'));
        } else {
            throw new \Exception('Data kendaraan tidak ditemukan');
        }
    }

    public function delete($id_kendaraan)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->find($id_kendaraan);

        if ($kendaraan) {
            $kendaraanModel->delete($id_kendaraan);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('kendaraan/index'));
        } else {
            throw new \Exception('Data kendaraan tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $kendaraanModel = new \App\Models\KendaraanModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');
        $roda = $this->request->getGet('roda');
        $kondisi = $this->request->getGet('kondisi');

        // Start with the base query
        $builder = $kendaraanModel->builder();

        // If filters are applied, add the necessary conditions
        if ($satker) {
            // Use a join to filter by 'nama_satker' from the 'satker' table
            $builder->join('satker', 'satker.id_satker = kendaraan.id_satker')
                ->where('satker.nama_satker', $satker);
        }

        if ($roda) {
            $builder->where('kendaraan.roda', $roda);
        }

        if ($kondisi) {
            $builder->where('kendaraan.kondisi', $kondisi);
        }

        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'NOPOL');
        $sheet->setCellValue('D1', 'JENIS KENDARAAN');
        $sheet->setCellValue('E1', 'TYPE/MERK');
        $sheet->setCellValue('F1', 'TAHUN PEMBUATAN');
        $sheet->setCellValue('G1', 'NOMOR MESIN');
        $sheet->setCellValue('H1', 'NOMOR RANGKA');
        $sheet->setCellValue('I1', 'KONDISI');
        $sheet->setCellValue('J1', 'RODA');
        $sheet->setCellValue('K1', 'NAMA PEMEGANG');
        $sheet->setCellValue('L1', 'PANGKAT');
        $sheet->setCellValue('M1', 'NRP');
        $sheet->setCellValue('N1', 'JABATAN');

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

        $sheet->getStyle('A1:N1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            // Since we are joining, 'satker' is available in the data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, isset($item['nama_satker']) ? $item['nama_satker'] : ''); // Check if the satker name exists
            $sheet->setCellValue('C' . $row, $item['nopol']);
            $sheet->setCellValue('D' . $row, $item['jenis']);
            $sheet->setCellValue('E' . $row, $item['merk']);
            $sheet->setCellValue('F' . $row, $item['tahun']);
            $sheet->setCellValue('G' . $row, $item['mesin']);
            $sheet->setCellValue('H' . $row, $item['rangka']);
            $sheet->setCellValue('I' . $row, $item['kondisi']);
            $sheet->setCellValue('J' . $row, $item['roda']);
            $sheet->setCellValue('K' . $row, $item['pemegang']);
            $sheet->setCellValue('L' . $row, $item['pangkat']);
            $sheet->setCellValue('M' . $row, $item['nrp']);
            $sheet->setCellValue('N' . $row, $item['jabatan']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:N1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-kendaraan-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $model = new KendaraanModel();
        $kendaraan = $model->findAll();
        return view('kendaraan/tampil', ['kendaraan' => $kendaraan]);
    }
}
