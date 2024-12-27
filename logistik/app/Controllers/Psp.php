<?php

namespace App\Controllers;

use App\Models\PspModel;
use App\Models\SatkerModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Psp extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pspModel = new PspModel();
        $psp = $pspModel->getPspWithSatker();
        $data = [
            'title' => 'Data psp',
            'psp' => $pspModel->getPspWithSatker()
        ];

        return view('psp/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // session();
        $data = [
            'title' => 'Tambah psp',
            'validation' => \Config\Services::validation()
        ];

        return view('psp/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'id_satker' => [
                'rules' => 'required[psp.id_satker]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'psp_s' => [
                'rules' => 'required[psp.psp_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'psp_b' => [
                'rules' => 'required[psp.psp_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'psp_t' => [
                'rules' => 'required[psp.psp_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tanah_s' => [
                'rules' => 'required[psp.tanah_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tanah_b' => [
                'rules' => 'required[psp.tanah_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tanah_t' => [
                'rules' => 'required[psp.tanah_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'angkut_s' => [
                'rules' => 'required[psp.angkut_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'angkut_b' => [
                'rules' => 'required[psp.angkut_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'angkut_t' => [
                'rules' => 'required[psp.angkut_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nontik_s' => [
                'rules' => 'required[psp.nontik_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nontik_b' => [
                'rules' => 'required[psp.nontik_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'nontik_t' => [
                'rules' => 'required[psp.nontik_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tik_s' => [
                'rules' => 'required[psp.tik_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tik_b' => [
                'rules' => 'required[psp.tik_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'tik_t' => [
                'rules' => 'required[psp.tik_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'besar_s' => [
                'rules' => 'required[psp.besar_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'besar_b' => [
                'rules' => 'required[psp.besar_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'besar_t' => [
                'rules' => 'required[psp.besar_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'senjata_s' => [
                'rules' => 'required[psp.senjata_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'senjata_b' => [
                'rules' => 'required[psp.senjata_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'senjata_t' => [
                'rules' => 'required[psp.senjata_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'gedung_s' => [
                'rules' => 'required[psp.gedung_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'gedung_b' => [
                'rules' => 'required[psp.gedung_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'gedung_t' => [
                'rules' => 'required[psp.gedung_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'rumah_s' => [
                'rules' => 'required[psp.rumah_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'rumah_b' => [
                'rules' => 'required[psp.rumah_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'rumah_t' => [
                'rules' => 'required[psp.rumah_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jalan_s' => [
                'rules' => 'required[psp.jalan_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jalan_b' => [
                'rules' => 'required[psp.jalan_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jalan_t' => [
                'rules' => 'required[psp.jalan_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jaringan_s' => [
                'rules' => 'required[psp.jaringan_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jaringan_b' => [
                'rules' => 'required[psp.jaringan_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'jaringan_t' => [
                'rules' => 'required[psp.jaringan_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'atl_s' => [
                'rules' => 'required[psp.atl_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'atl_b' => [
                'rules' => 'required[psp.atl_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'atl_t' => [
                'rules' => 'required[psp.atl_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'atb_s' => [
                'rules' => 'required[psp.atb_s]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'atb_b' => [
                'rules' => 'required[psp.atb_b]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ],
            'atb_t' => [
                'rules' => 'required[psp.atb_t]',
                'errors' => [
                    'required' => '{field}  harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation->listErrors();
            return redirect()->to('/psp/create')->withInput()->with('validation', $validation);
        }

        $pspModel = new PspModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'psp_s' => $this->request->getPost('psp_s'),
            'psp_b' => $this->request->getPost('psp_b'),
            'psp_t' => $this->request->getPost('psp_t'),
            'tanah_s' => $this->request->getPost('tanah_s'),
            'tanah_b' => $this->request->getPost('tanah_b'),
            'tanah_t' => $this->request->getPost('tanah_t'),
            'angkut_s' => $this->request->getPost('angkut_s'),
            'angkut_b' => $this->request->getPost('angkut_b'),
            'angkut_t' => $this->request->getPost('angkut_t'),
            'nontik_s' => $this->request->getPost('nontik_s'),
            'nontik_b' => $this->request->getPost('nontik_b'),
            'nontik_t' => $this->request->getPost('nontik_t'),
            'tik_s' => $this->request->getPost('tik_s'),
            'tik_b' => $this->request->getPost('tik_b'),
            'tik_t' => $this->request->getPost('tik_t'),
            'besar_s' => $this->request->getPost('besar_s'),
            'besar_b' => $this->request->getPost('besar_b'),
            'besar_t' => $this->request->getPost('besar_t'),
            'senjata_s' => $this->request->getPost('senjata_s'),
            'senjata_b' => $this->request->getPost('senjata_b'),
            'senjata_t' => $this->request->getPost('senjata_t'),
            'gedung_s' => $this->request->getPost('gedung_s'),
            'gedung_b' => $this->request->getPost('gedung_b'),
            'gedung_t' => $this->request->getPost('gedung_t'),
            'rumah_s' => $this->request->getPost('rumah_s'),
            'rumah_b' => $this->request->getPost('rumah_b'),
            'rumah_t' => $this->request->getPost('rumah_t'),
            'jalan_s' => $this->request->getPost('jalan_s'),
            'jalan_b' => $this->request->getPost('jalan_b'),
            'jalan_t' => $this->request->getPost('jalan_t'),
            'jaringan_s' => $this->request->getPost('jaringan_s'),
            'jaringan_b' => $this->request->getPost('jaringan_b'),
            'jaringan_t' => $this->request->getPost('jaringan_t'),
            'atl_s' => $this->request->getPost('atl_s'),
            'atl_b' => $this->request->getPost('atl_b'),
            'atl_t' => $this->request->getPost('atl_t'),
            'atb_s' => $this->request->getPost('atb_s'),
            'atb_b' => $this->request->getPost('atb_b'),
            'atb_t' => $this->request->getPost('atb_t')
        ];

        $pspModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('psp/index'));
    }

    public function edit($id_psp)
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pspModel = new PspModel();
        $psp = $pspModel->find($id_psp);

        if (!$psp) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data psp tidak ditemukan');
        }

        $data = [
            'title' => 'Edit psp',
            'psp' => $psp
        ];

        return view('psp/edit', $data);
    }
    public function update($id_psp)
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pspModel = new PspModel();
        $psp = $pspModel->find($id_psp);

        if ($psp) {
            $data = [
                'id_satker' => $this->request->getPost('id_satker'),
                'psp_s' => $this->request->getPost('psp_s'),
                'psp_b' => $this->request->getPost('psp_b'),
                'psp_t' => $this->request->getPost('psp_t'),
                'tanah_s' => $this->request->getPost('tanah_s'),
                'tanah_b' => $this->request->getPost('tanah_b'),
                'tanah_t' => $this->request->getPost('tanah_t'),
                'angkut_s' => $this->request->getPost('angkut_s'),
                'angkut_b' => $this->request->getPost('angkut_b'),
                'angkut_t' => $this->request->getPost('angkut_t'),
                'nontik_s' => $this->request->getPost('nontik_s'),
                'nontik_b' => $this->request->getPost('nontik_b'),
                'nontik_t' => $this->request->getPost('nontik_t'),
                'tik_s' => $this->request->getPost('tik_s'),
                'tik_b' => $this->request->getPost('tik_b'),
                'tik_t' => $this->request->getPost('tik_t'),
                'besar_s' => $this->request->getPost('besar_s'),
                'besar_b' => $this->request->getPost('besar_b'),
                'besar_t' => $this->request->getPost('besar_t'),
                'senjata_s' => $this->request->getPost('senjata_s'),
                'senjata_b' => $this->request->getPost('senjata_b'),
                'senjata_t' => $this->request->getPost('senjata_t'),
                'gedung_s' => $this->request->getPost('gedung_s'),
                'gedung_b' => $this->request->getPost('gedung_b'),
                'gedung_t' => $this->request->getPost('gedung_t'),
                'rumah_s' => $this->request->getPost('rumah_s'),
                'rumah_b' => $this->request->getPost('rumah_b'),
                'rumah_t' => $this->request->getPost('rumah_t'),
                'jalan_s' => $this->request->getPost('jalan_s'),
                'jalan_b' => $this->request->getPost('jalan_b'),
                'jalan_t' => $this->request->getPost('jalan_t'),
                'jaringan_s' => $this->request->getPost('jaringan_s'),
                'jaringan_b' => $this->request->getPost('jaringan_b'),
                'jaringan_t' => $this->request->getPost('jaringan_t'),
                'atl_s' => $this->request->getPost('atl_s'),
                'atl_b' => $this->request->getPost('atl_b'),
                'atl_t' => $this->request->getPost('atl_t'),
                'atb_s' => $this->request->getPost('atb_s'),
                'atb_b' => $this->request->getPost('atb_b'),
                'atb_t' => $this->request->getPost('atb_t')
            ];

            $pspModel->update($id_psp, $data);

            session()->setFlashdata('pesan', 'Data berhasil diupdate');

            return redirect()->to(base_url('psp/index'));
        } else {
            throw new \Exception('Data psp tidak ditemukan');
        }
    }

    public function delete($id_psp)
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pspModel = new PspModel();
        $psp = $pspModel->find($id_psp);

        if ($psp) {
            $pspModel->delete($id_psp);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('psp/index'));
        } else {
            throw new \Exception('Data psp tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $pspModel = new \App\Models\PspModel();

        // Retrieve filters from the query parameters
        $satker = $this->request->getGet('nama_satker');

        // Start with the base query
        $builder = $pspModel->builder()
            ->select('psp.*, satker.nama_satker') // Pastikan nama_satker disertakan
            ->join('satker', 'satker.id_satker = psp.id_satker', 'left');

        // If filters are applied, add the necessary conditions
        if ($satker) {
            $builder->where('satker.nama_satker', $satker);
        }

        // Get the data
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set merged cells for headers
        $sheet->mergeCells('C1:E1')->setCellValue('C1', 'PSP');
        $sheet->mergeCells('F1:H1')->setCellValue('F1', 'TANAH');
        $sheet->mergeCells('I1:K1')->setCellValue('I1', 'ANGKUT');
        $sheet->mergeCells('L1:N1')->setCellValue('L1', 'NONTIK');
        $sheet->mergeCells('O1:Q1')->setCellValue('O1', 'TIK');
        $sheet->mergeCells('R1:T1')->setCellValue('R1', 'BESAR');
        $sheet->mergeCells('U1:W1')->setCellValue('U1', 'SENJATA');
        $sheet->mergeCells('X1:Z1')->setCellValue('X1', 'GEDUNG');
        $sheet->mergeCells('AA1:AC1')->setCellValue('AA1', 'RUMAH');
        $sheet->mergeCells('AD1:AF1')->setCellValue('AD1', 'JALAN');
        $sheet->mergeCells('AG1:AI1')->setCellValue('AG1', 'JARINGAN');
        $sheet->mergeCells('AJ1:AL1')->setCellValue('AJ1', 'ATL');
        $sheet->mergeCells('AM1:AO1')->setCellValue('AM1', 'ATB');

        // Apply styles to merged cells
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
        $sheet->getStyle('A1:AO2')->applyFromArray($headerStyle);

        // Set the header row for sub-columns
        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'SATKER/SATWIL');
        $sheet->setCellValue('C2', 'SUDAH');
        $sheet->setCellValue('D2', 'BELUM');
        $sheet->setCellValue('E2', 'TOTAL');
        $sheet->setCellValue('F2', 'SUDAH');
        $sheet->setCellValue('G2', 'BELUM');
        $sheet->setCellValue('H2', 'TOTAL');
        $sheet->setCellValue('I2', 'SUDAH');
        $sheet->setCellValue('J2', 'BELUM');
        $sheet->setCellValue('K2', 'TOTAL');
        $sheet->setCellValue('L2', 'SUDAH');
        $sheet->setCellValue('M2', 'BELUM');
        $sheet->setCellValue('N2', 'TOTAL');
        $sheet->setCellValue('O2', 'SUDAH');
        $sheet->setCellValue('P2', 'BELUM');
        $sheet->setCellValue('Q2', 'TOTAL');
        $sheet->setCellValue('R2', 'SUDAH');
        $sheet->setCellValue('S2', 'BELUM');
        $sheet->setCellValue('T2', 'TOTAL');
        $sheet->setCellValue('U2', 'SUDAH');
        $sheet->setCellValue('V2', 'BELUM');
        $sheet->setCellValue('W2', 'TOTAL');
        $sheet->setCellValue('X2', 'SUDAH');
        $sheet->setCellValue('Y2', 'BELUM');
        $sheet->setCellValue('Z2', 'TOTAL');
        $sheet->setCellValue('AA2', 'SUDAH');
        $sheet->setCellValue('AB2', 'BELUM');
        $sheet->setCellValue('AC2', 'TOTAL');
        $sheet->setCellValue('AD2', 'SUDAH');
        $sheet->setCellValue('AE2', 'BELUM');
        $sheet->setCellValue('AF2', 'TOTAL');
        $sheet->setCellValue('AG2', 'SUDAH');
        $sheet->setCellValue('AH2', 'BELUM');
        $sheet->setCellValue('AI2', 'TOTAL');
        $sheet->setCellValue('AJ2', 'SUDAH');
        $sheet->setCellValue('AK2', 'BELUM');
        $sheet->setCellValue('AL2', 'TOTAL');
        $sheet->setCellValue('AM2', 'SUDAH');
        $sheet->setCellValue('AN2', 'BELUM');
        $sheet->setCellValue('AO2', 'TOTAL');

        // Write data to the sheet
        $row = 3; // Start data from row 3
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, isset($item['nama_satker']) ? $item['nama_satker'] : '');
            $sheet->setCellValue('C' . $row, $item['psp_s']);
            $sheet->setCellValue('D' . $row, $item['psp_b']);
            $sheet->setCellValue('E' . $row, $item['psp_t']);
            $sheet->setCellValue('F' . $row, $item['tanah_s']);
            $sheet->setCellValue('G' . $row, $item['tanah_b']);
            $sheet->setCellValue('H' . $row, $item['tanah_t']);
            $sheet->setCellValue('I' . $row, $item['angkut_s']);
            $sheet->setCellValue('J' . $row, $item['angkut_b']);
            $sheet->setCellValue('K' . $row, $item['angkut_t']);
            $sheet->setCellValue('L' . $row, $item['nontik_s']);
            $sheet->setCellValue('M' . $row, $item['nontik_b']);
            $sheet->setCellValue('N' . $row, $item['nontik_t']);
            $sheet->setCellValue('O' . $row, $item['tik_s']);
            $sheet->setCellValue('P' . $row, $item['tik_b']);
            $sheet->setCellValue('Q' . $row, $item['tik_t']);
            $sheet->setCellValue('R' . $row, $item['besar_s']);
            $sheet->setCellValue('S' . $row, $item['besar_b']);
            $sheet->setCellValue('T' . $row, $item['besar_t']);
            $sheet->setCellValue('U' . $row, $item['senjata_s']);
            $sheet->setCellValue('V' . $row, $item['senjata_b']);
            $sheet->setCellValue('W' . $row, $item['senjata_t']);
            $sheet->setCellValue('X' . $row, $item['gedung_s']);
            $sheet->setCellValue('Y' . $row, $item['gedung_b']);
            $sheet->setCellValue('Z' . $row, $item['gedung_t']);
            $sheet->setCellValue('AA' . $row, $item['rumah_s']);
            $sheet->setCellValue('AB' . $row, $item['rumah_b']);
            $sheet->setCellValue('AC' . $row, $item['rumah_t']);
            $sheet->setCellValue('AD' . $row, $item['jalan_s']);
            $sheet->setCellValue('AE' . $row, $item['jalan_b']);
            $sheet->setCellValue('AF' . $row, $item['jalan_t']);
            $sheet->setCellValue('AG' . $row, $item['jaringan_s']);
            $sheet->setCellValue('AH' . $row, $item['jaringan_b']);
            $sheet->setCellValue('AI' . $row, $item['jaringan_t']);
            $sheet->setCellValue('AJ' . $row, $item['atl_s']);
            $sheet->setCellValue('AK' . $row, $item['atl_b']);
            $sheet->setCellValue('AL' . $row, $item['atl_t']);
            $sheet->setCellValue('AM' . $row, $item['atb_s']);
            $sheet->setCellValue('AN' . $row, $item['atb_b']);
            $sheet->setCellValue('AO' . $row, $item['atb_t']);
            $row++;
            $no++;
        }

        // Output the file as a download
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan_PSP.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }



    public function tampil()
    {
        if (!auth()->user()->can('infolog.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $model = new PspModel();
        $psp = $model->findAll();
        return view('psp/tampil', ['psp' => $psp]);
    }
}
