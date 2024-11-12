<?php

namespace App\Controllers;

use App\Models\PengadaanModel;
use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengadaan extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pengadaanModel = new PengadaanModel();
        $pengadaan = $pengadaanModel->getPengadaanWithSatker();
        $data = [
            'title' => 'Data pengadaan',
            'pengadaan' => $pengadaanModel->getPengadaanWithSatker()
        ];

        return view('pengadaan/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah pengadaan',
            'validation' => \Config\Services::validation()
        ];

        return view('pengadaan/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[pengadaan.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'paket' => [
                'rules' => 'required[pengadaan.paket]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pagu' => [
                'rules' => 'required[pengadaan.pagu]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'kontrak' => [
                'rules' => 'required[pengadaan.kontrak]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'no_kontrak' => [
                'rules' => 'required[pengadaan.no_kontrak]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'mulai_kontrak' => [
                'rules' => 'required[pengadaan.mulai_kontrak]',
                'errors' => [
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ],
            'akhir_kontrak' => [
                'rules' => 'required[pengadaan.akhir_kontrak]',
                'errors' => [
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ],
            'penyedia' => [
                'rules' => 'required[pengadaan.penyedia]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'metode' => [
                'rules' => 'required[pengadaan.metode]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tahun' => [
                'rules' => 'required[pengadaan.tahun]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/pengadaan/create')->withInput()->with('validation', $validation);
        }

        $pengadaanModel = new PengadaanModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'paket' => $this->request->getPost('paket'),
            'pagu' => $this->request->getPost('pagu'),
            'kontrak' => $this->request->getPost('kontrak'),
            'no_kontrak' => $this->request->getPost('no_kontrak'),
            'mulai_kontrak' => $this->request->getPost('mulai_kontrak'),
            'akhir_kontrak' => $this->request->getPost('akhir_kontrak'),
            'penyedia' => $this->request->getPost('penyedia'),
            'metode' => $this->request->getPost('metode'),
            'tahun' => $this->request->getPost('tahun')
        ];

        $pengadaanModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('pengadaan/index'));
    }

    public function edit($id_pengadaan)
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pengadaanModel = new PengadaanModel();
        $pengadaan = $pengadaanModel->find($id_pengadaan);

        if (!$pengadaan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengadaan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit pengadaan',
            'pengadaan' => $pengadaan
        ];

        return view('pengadaan/edit', $data);
    }
    public function update($id_pengadaan)
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pengadaanModel = new PengadaanModel();
        $pengadaan = $pengadaanModel->find($id_pengadaan);

        if ($pengadaan) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
                'paket' => $this->request->getPost('paket'),
                'pagu' => $this->request->getPost('pagu'),
                'kontrak' => $this->request->getPost('kontrak'),
                'no_kontrak' => $this->request->getPost('no_kontrak'),
                'mulai_kontrak' => $this->request->getPost('mulai_kontrak'),
                'akhir_kontrak' => $this->request->getPost('akhir_kontrak'),
                'penyedia' => $this->request->getPost('penyedia'),
                'metode' => $this->request->getPost('metode'),
                'tahun' => $this->request->getPost('tahun')
            ];

            $pengadaanModel->update($id_pengadaan, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('pengadaan/index'));
        } else {
            throw new \Exception('Data pengadaan tidak ditemukan');
        }
    }

    public function delete($id_pengadaan)
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pengadaanModel = new PengadaanModel();
        $pengadaan = $pengadaanModel->find($id_pengadaan);

        if ($pengadaan) {
            $pengadaanModel->delete($id_pengadaan);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('pengadaan/index'));
        } else {
            throw new \Exception('Data pengadaan tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pengadaanModel = new \App\Models\PengadaanModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');
        $paket = $this->request->getGet('paket');
        $penyedia = $this->request->getGet('penyedia');

        // Start with the base query
        $builder = $pengadaanModel->builder();

        // If filters are applied, add the necessary conditions
        if ($satker) {
            // Use a join to filter by 'nama_satker' from the 'satker' table
            $builder->join('satker', 'satker.id_satker = pengadaan.id_satker')
                ->where('satker.nama_satker', $satker);
        }

        if ($paket) {
            $builder->where('pengadaan.paket', $paket);
        }

        if ($penyedia) {
            $builder->where('pengadaan.penyedia', $penyedia);
        }

        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'JENIS PAKET');
        $sheet->setCellValue('D1', 'NILAI PAGU');
        $sheet->setCellValue('E1', 'NILAI KONTRAK');
        $sheet->setCellValue('F1', 'NOMOR KONTRAK');
        $sheet->setCellValue('G1', 'TANGGAL MULAI KONTRAK');
        $sheet->setCellValue('H1', 'TANGGAL AKHIR KONTRAK');
        $sheet->setCellValue('I1', 'PENYEDIA');
        $sheet->setCellValue('J1', 'METODE PENGADAAN');
        $sheet->setCellValue('K1', 'TAHUN');

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

        $sheet->getStyle('A1:K1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            // Since we are joining, 'satker' is available in the data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, isset($item['nama_satker']) ? $item['nama_satker'] : ''); // Check if the satker name exists
            $sheet->setCellValue('C' . $row, $item['paket']);
            $sheet->setCellValue('D' . $row, $item['pagu']);
            $sheet->setCellValue('E' . $row, $item['kontrak']);
            $sheet->setCellValue('F' . $row, $item['no_kontrak']);
            $sheet->setCellValue('G' . $row, $item['mulai_kontrak']);
            $sheet->setCellValue('H' . $row, $item['akhir_kontrak']);
            $sheet->setCellValue('I' . $row, $item['penyedia']);
            $sheet->setCellValue('J' . $row, $item['metode']);
            $sheet->setCellValue('K' . $row, $item['tahun']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:K1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-pengadaan-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $model = new PengadaanModel();
        $pengadaan = $model->findAll();
        return view('pengadaan/tampil', ['pengadaan' => $pengadaan]);
    }
}
