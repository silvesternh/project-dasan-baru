<?php

namespace App\Controllers;

use App\Models\SertifikasiModel;
use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sertifikasi extends Controller
{
    public function index(): string
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $sertifikasiModel = new SertifikasiModel();
        $sertifikasi = $sertifikasiModel->getSertifikasiWithSatker();
        $data = [
            'title' => 'Data sertifikasi',
            'sertifikasi' => $sertifikasiModel->getSertifikasiWithSatker()
        ];

        return view('sertifikasi/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah sertifikasi',
            'validation' => \Config\Services::validation()
        ];

        return view('sertifikasi/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[sertifikasi.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required[sertifikasi.nama]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pangkat' => [
                'rules' => 'required[sertifikasi.pangkat]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nrp' => [
                'rules' => 'required[sertifikasi.nrp]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jabatan' => [
                'rules' => 'required[sertifikasi.jabatan]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nomor' => [
                'rules' => 'required[sertifikasi.nomor]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'hp' => [
                'rules' => 'required[sertifikasi.hp]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/sertifikasi/create')->withInput()->with('validation', $validation);
        }

        $sertifikasiModel = new SertifikasiModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan'),
            'nomor' => $this->request->getPost('nomor'),
            'hp' => $this->request->getPost('hp')
        ];

        $sertifikasiModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('sertifikasi/index'));
    }

    public function edit($id_sertifikasi)
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $sertifikasiModel = new SertifikasiModel();
        $sertifikasi = $sertifikasiModel->find($id_sertifikasi);

        if (!$sertifikasi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data sertifikasi tidak ditemukan');
        }

        $data = [
            'title' => 'Edit sertifikasi',
            'sertifikasi' => $sertifikasi
        ];

        return view('sertifikasi/edit', $data);
    }
    public function update($id_sertifikasi)
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $sertifikasiModel = new SertifikasiModel();
        $sertifikasi = $sertifikasiModel->find($id_sertifikasi);

        if ($sertifikasi) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
                'nama' => $this->request->getPost('nama'),
                'pangkat' => $this->request->getPost('pangkat'),
                'nrp' => $this->request->getPost('nrp'),
                'jabatan' => $this->request->getPost('jabatan'),
                'nomor' => $this->request->getPost('nomor'),
                'hp' => $this->request->getPost('hp')
            ];

            $sertifikasiModel->update($id_sertifikasi, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('sertifikasi/index'));
        } else {
            throw new \Exception('Data sertifikasi tidak ditemukan');
        }
    }

    public function delete($id_sertifikasi)
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $sertifikasiModel = new SertifikasiModel();
        $sertifikasi = $sertifikasiModel->find($id_sertifikasi);

        if ($sertifikasi) {
            $sertifikasiModel->delete($id_sertifikasi);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('sertifikasi/index'));
        } else {
            throw new \Exception('Data sertifikasi tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('ada.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $sertifikasiModel = new \App\Models\SertifikasiModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');

        // Start with the base query
        $builder = $sertifikasiModel->builder();

        // If filters are applied, add the necessary conditions
        if ($satker) {
            // Use a join to filter by 'nama_satker' from the 'satker' table
            $builder->join('satker', 'satker.id_satker = sertifikasi.id_satker')
                ->where('satker.nama_satker', $satker);
        }

        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'NAMA PERSONIL');
        $sheet->setCellValue('D1', 'PANGKAT');
        $sheet->setCellValue('E1', 'NRP');
        $sheet->setCellValue('F1', 'JABATAN');
        $sheet->setCellValue('G1', 'NOMOR SERTIFIKASI');
        $sheet->setCellValue('H1', 'NOMOR HP');

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
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, isset($item['nama_satker']) ? $item['nama_satker'] : ''); // Check if the satker name exists
            $sheet->setCellValue('C' . $row, $item['nama']);
            $sheet->setCellValue('D' . $row, $item['pangkat']);
            $sheet->setCellValue('E' . $row, $item['nrp']);
            $sheet->setCellValue('F' . $row, $item['jabatan']);
            $sheet->setCellValue('G' . $row, $item['nomor']);

            // Set 'NOMOR HP' column as text
            $sheet->setCellValueExplicit('H' . $row, $item['hp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:H1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-sertifikasi-' . date('Y-m-d-H-i-s') . '.xlsx';

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
        $model = new SertifikasiModel();
        $sertifikasi = $model->findAll();
        return view('sertifikasi/tampil', ['sertifikasi' => $sertifikasi]);
    }
}
