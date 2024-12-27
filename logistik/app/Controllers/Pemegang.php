<?php

namespace App\Controllers;

use App\Models\PemegangModel;
use App\Models\SatkerModel;
use App\Models\JenisModel;
use App\Models\MerkModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pemegang extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pemegangModel = new PemegangModel();
        $pemegang = $pemegangModel->getPemegangWithDetails();

        $data = [
            'title' => 'Data pemegang',
            'pemegang' => $pemegang
        ];

        return view('pemegang/index', $data);
    }

    public function data()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pemegangModel = new PemegangModel();
        $pemegang = $pemegangModel->getPemegangWithDetails();

        $data = [
            'title' => 'Data pemegang',
            'pemegang' => $pemegang
        ];

        return view('pemegang/data', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah pemegang',
            'validation' => \Config\Services::validation()
        ];

        return view('pemegang/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[pemegang.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required[pemegang.nama]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'pangkat' => [
                'rules' => 'required[pemegang.pangkat]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nrp' => [
                'rules' => 'required[pemegang.nrp]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'no_senpi' => [
                'rules' => 'required[pemegang.no_senpi]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'id_merk' => [
                'rules' => 'required[pemegang.id_merk]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'id_jenis' => [
                'rules' => 'required[pemegang.id_jenis]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'amu' => [
                'rules' => 'required[pemegang.amu]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'berlaku' => [
                'rules' => 'required[pemegang.berlaku]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/pemegang/create')->withInput()->with('validation', $validation);
        }

        $pemegangModel = new PemegangModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'jumlah' => $this->request->getPost('jumlah'),
            'no_senpi' => $this->request->getPost('no_senpi'),
            'id_merk' => $this->request->getPost('id_merk'),
            'id_jenis' => $this->request->getPost('id_jenis'),
            'amu' => $this->request->getPost('amu'),
            'berlaku' => $this->request->getPost('berlaku')
        ];

        $pemegangModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('pemegang/index'));
    }

    public function edit($id_pemegang)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pemegangModel = new PemegangModel();
        $pemegang = $pemegangModel->find($id_pemegang);

        if (!$pemegang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pemegang tidak ditemukan');
        }

        $data = [
            'title' => 'Edit pemegang',
            'pemegang' => $pemegang
        ];

        return view('pemegang/edit', $data);
    }
    public function update($id_pemegang)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pemegangModel = new PemegangModel();
        $pemegang = $pemegangModel->find($id_pemegang);

        if ($pemegang) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
                'nama' => $this->request->getPost('nama'),
                'pangkat' => $this->request->getPost('pangkat'),
                'nrp' => $this->request->getPost('nrp'),
                'jumlah' => $this->request->getPost('jumlah'),
                'no_senpi' => $this->request->getPost('no_senpi'),
                'id_merk' => $this->request->getPost('id_merk'),
                'id_jenis' => $this->request->getPost('id_jenis'),
                'amu' => $this->request->getPost('amu'),
                'berlaku' => $this->request->getPost('berlaku')
            ];

            $pemegangModel->update($id_pemegang, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('pemegang/index'));
        } else {
            throw new \Exception('Data pemegang tidak ditemukan');
        }
    }

    public function delete($id_pemegang)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pemegangModel = new PemegangModel();
        $pemegang = $pemegangModel->find($id_pemegang);

        if ($pemegang) {
            $pemegangModel->delete($id_pemegang);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('pemegang/index'));
        } else {
            throw new \Exception('Data pemegang tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pemegangModel = new \App\Models\PemegangModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');
        $jenis = $this->request->getGet('nama_jenis');
        $merk = $this->request->getGet('nama_merk');

        // Start with the base query and join all related tables
        $builder = $pemegangModel->builder();
        $builder->select('pemegang.*, satker.nama_satker, jenis.nama_jenis, merk.nama_merk')
            ->join('satker', 'satker.id_satker = pemegang.id_satker', 'left')
            ->join('jenis', 'jenis.id_jenis = pemegang.id_jenis', 'left')
            ->join('merk', 'merk.id_merk = pemegang.id_merk', 'left');

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
        $sheet->setCellValue('C1', 'NAMA');
        $sheet->setCellValue('D1', 'PANGKAT');
        $sheet->setCellValue('E1', 'NRP');
        $sheet->setCellValue('F1', 'NOMOR');
        $sheet->setCellValue('G1', 'MERK');
        $sheet->setCellValue('H1', 'JENIS');
        $sheet->setCellValue('I1', 'AMU');
        $sheet->setCellValue('J1', 'MASA BERLAKU');

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
            $sheet->setCellValue('F' . $row, $item['no_senpi']);
            $sheet->setCellValue('G' . $row, $item['nama_merk'] ?? '');
            $sheet->setCellValue('H' . $row, $item['nama_jenis'] ?? '');
            $sheet->setCellValue('I' . $row, $item['amu']);
            $sheet->setCellValue('J' . $row, $item['berlaku']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:J1');

        // Output the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-pemegang-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {

        $model = new PemegangModel();
        $pemegang = $model->findAll();
        return view('pemegang/tampil', ['pemegang' => $pemegang]);
    }
}
