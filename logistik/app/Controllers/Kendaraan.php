<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kendaraan extends Controller
{
    public function index()
    {
        $kendaraanModel = new KendaraanModel();
        $data = [
            'title' => 'Data kendaraan',
            'kendaraan' => $kendaraanModel->findAll()
        ];

        return view('kendaraan/index', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah kendaraan',
            'validation' => \Config\Services::validation()
        ];

        return view('kendaraan/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'satker' => [
                'rules' => 'required[kendaraan.satker]',
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
            'satker' => $this->request->getPost('satker'),
            'nopol' => $this->request->getPost('nopol'),
            'jenis' => $this->request->getPost('jenis'),
            'merk' => $this->request->getPost('merk'),
            'tahun' => $this->request->getPost('tahun'),
            'mesin' => $this->request->getPost('mesin'),
            'rangka' => $this->request->getPost('rangka'),
            'kondisi' => $this->request->getPost('kondisi'),
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
        $kendaraanModel = new KendaraanModel();
        $kendaraan = $kendaraanModel->find($id_kendaraan);

        if ($kendaraan) {
            $data = [
                'satker' => $this->request->getPost('satker'),
                'nopol' => $this->request->getPost('nopol'),
                'jenis' => $this->request->getPost('jenis'),
                'merk' => $this->request->getPost('merk'),
                'tahun' => $this->request->getPost('tahun'),
                'mesin' => $this->request->getPost('mesin'),
                'rangka' => $this->request->getPost('rangka'),
                'kondisi' => $this->request->getPost('kondisi'),
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
        // $this->export();
        $kendaraanModel = new \App\Models\KendaraanModel();
        $data = $kendaraanModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $kendaraanModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'satker');
        $sheet->setCellValue('C1', 'nopol');
        $sheet->setCellValue('D1', 'jenis');
        $sheet->setCellValue('E1', 'merk');
        $sheet->setCellValue('F1', 'tahun');
        $sheet->setCellValue('G1', 'mesin');
        $sheet->setCellValue('H1', 'rangka');
        $sheet->setCellValue('I1', 'kondisi');
        $sheet->setCellValue('J1', 'pemegang');
        $sheet->setCellValue('K1', 'pangkat');
        $sheet->setCellValue('L1', 'nrp');
        $sheet->setCellValue('M1', 'jabatan');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_kendaraan']);
            $sheet->setCellValue('B' . $row, $item['satker']);
            $sheet->setCellValue('C' . $row, $item['nopol']);
            $sheet->setCellValue('D' . $row, $item['jenis']);
            $sheet->setCellValue('E' . $row, $item['merk']);
            $sheet->setCellValue('F' . $row, $item['tahun']);
            $sheet->setCellValue('G' . $row, $item['mesin']);
            $sheet->setCellValue('H' . $row, $item['rangka']);
            $sheet->setCellValue('I' . $row, $item['kondisi']);
            $sheet->setCellValue('J' . $row, $item['pemegang']);
            $sheet->setCellValue('K' . $row, $item['pangkat']);
            $sheet->setCellValue('L' . $row, $item['nrp']);
            $sheet->setCellValue('M' . $row, $item['jabatan']);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function impor()
    {
        return view('kendaraan/impor');
    }
}
