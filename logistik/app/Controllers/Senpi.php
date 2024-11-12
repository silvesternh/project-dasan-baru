<?php

namespace App\Controllers;

use App\Models\SenpiModel;
use App\Models\SatkerModel;
use App\Models\JenisModel;
use App\Models\MerkModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Senpi extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $senpiModel = new SenpiModel();
        $senpi = $senpiModel->getSenpiWithDetails();

        $data = [
            'title' => 'Data senpi',
            'senpi' => $senpi
        ];

        return view('senpi/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah senpi',
            'validation' => \Config\Services::validation()
        ];

        return view('senpi/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[senpi.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required[senpi.nama]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pangkat' => [
                'rules' => 'required[senpi.pangkat]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nrp' => [
                'rules' => 'required[senpi.nrp]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'id_jenis' => [
                'rules' => 'required[senpi.id_jenis]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'id_merk' => [
                'rules' => 'required[senpi.id_merk]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'no_senpi' => [
                'rules' => 'required|is_unique[senpi.no_senpi]',
                'errors' => [
                    'required' => '{field}  harus diisi.',
                    'is_unique' => '{field}  tidak boleh sama'
                ]
            ],
            'kondisi' => [
                'rules' => 'required[senpi.kondisi]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'kode' => [
                'rules' => 'required[senpi.kode]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/senpi/create')->withInput()->with('validation', $validation);
        }

        $senpiModel = new SenpiModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'id_jenis' => $this->request->getPost('id_jenis'),
            'id_merk' => $this->request->getPost('id_merk'),
            'no_senpi' => $this->request->getPost('no_senpi'),
            'kondisi' => $this->request->getPost('kondisi'),
            'kode' => $this->request->getPost('kode')
        ];

        $senpiModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('senpi/index'));
    }

    public function edit($id_senpi)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $senpiModel = new SenpiModel();
        $senpi = $senpiModel->find($id_senpi);

        if (!$senpi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data senpi tidak ditemukan');
        }

        $data = [
            'title' => 'Edit senpi',
            'senpi' => $senpi
        ];

        return view('senpi/edit', $data);
    }
    public function update($id_senpi)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $senpiModel = new SenpiModel();
        $senpi = $senpiModel->find($id_senpi);

        if ($senpi) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
                'nama' => $this->request->getPost('nama'),
                'pangkat' => $this->request->getPost('pangkat'),
                'nrp' => $this->request->getPost('nrp'),
                'id_jenis' => $this->request->getPost('id_jenis'),
                'id_merk' => $this->request->getPost('id_merk'),
                'no_senpi' => $this->request->getPost('no_senpi'),
                'kondisi' => $this->request->getPost('kondisi'),
                'kode' => $this->request->getPost('kode')
            ];

            $senpiModel->update($id_senpi, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('senpi/index'));
        } else {
            throw new \Exception('Data senpi tidak ditemukan');
        }
    }

    public function delete($id_senpi)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $senpiModel = new SenpiModel();
        $senpi = $senpiModel->find($id_senpi);

        if ($senpi) {
            $senpiModel->delete($id_senpi);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('senpi/index'));
        } else {
            throw new \Exception('Data senpi tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $senpiModel = new \App\Models\SenpiModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');
        $jenis = $this->request->getGet('nama_jenis');
        $merk = $this->request->getGet('nama_merk');

        // Start with the base query and join all related tables
        $builder = $senpiModel->builder();
        $builder->select('senpi.*, satker.nama_satker, jenis.nama_jenis, merk.nama_merk')
            ->join('satker', 'satker.id_satker = senpi.id_satker', 'left')
            ->join('jenis', 'jenis.id_jenis = senpi.id_jenis', 'left')
            ->join('merk', 'merk.id_merk = senpi.id_merk', 'left');

        // Apply filters if present
        if ($satker) {
            $builder->where('satker.nama_satker', $satker);
        }
        if ($jenis) {
            $builder->where('jenis.nama_jenis', $jenis);
        }
        if ($merk) {
            $builder->where('merk.nama_merk', $merk);
        }

        // Get the data with applied filters
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'PENANGGUNG JAWAB');
        $sheet->setCellValue('D1', 'PANGKAT');
        $sheet->setCellValue('E1', 'NRP');
        $sheet->setCellValue('F1', 'JENIS SENPI');
        $sheet->setCellValue('G1', 'MERK SENPI');
        $sheet->setCellValue('H1', 'NOMOR SENPI');
        $sheet->setCellValue('I1', 'KONDISI');
        $sheet->setCellValue('J1', 'KODE');

        // Apply header styling if needed

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['nama_satker'] ?? '');
            $sheet->setCellValue('C' . $row, $item['nama']);
            $sheet->setCellValue('D' . $row, $item['pangkat']);
            $sheet->setCellValue('E' . $row, $item['nrp']);
            $sheet->setCellValue('F' . $row, $item['nama_jenis'] ?? '');
            $sheet->setCellValue('G' . $row, $item['nama_merk'] ?? '');
            $sheet->setCellValue('H' . $row, $item['no_senpi']);
            $sheet->setCellValue('I' . $row, $item['kondisi']);
            $sheet->setCellValue('J' . $row, $item['kode']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:J1');

        // Output the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-senpi-' . date('Y-m-d-H-i-s') . '.xlsx';

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
        $model = new SenpiModel();
        $senpi = $model->findAll();
        return view('senpi/tampil', ['senpi' => $senpi]);
    }
}
