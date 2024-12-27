<?php

namespace App\Controllers;

use App\Models\AlsusModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Alsus extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsusModel = new AlsusModel();
        $alsus = $alsusModel->getAlsusWithSatker();

        $data = [
            'title' => 'Data Alsus',
            'alsus' => $alsus
        ];

        return view('alsus/index', $data);
    }
    
    public function data()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsusModel = new AlsusModel();
        $alsus = $alsusModel->getAlsusWithSatker();

        $data = [
            'title' => 'Data Alsus',
            'alsus' => $alsus
        ];

        return view('alsus/data', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $data = [
            'title' => 'Tambah Alsus',
            'validation' => \Config\Services::validation()
        ];

        return view('alsus/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $rules = [
            'id_satker' => 'required',
            'bmn' => 'required',
            'jumlah' => 'required|integer',
            'bb' => 'required|integer',
            'rr' => 'required|integer',
            'rb' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/alsus/create')->withInput()->with('validation', \Config\Services::validation());
        }

        $alsusModel = new AlsusModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'bmn' => $this->request->getPost('bmn'),
            'jumlah' => $this->request->getPost('jumlah'),
            'bb' => $this->request->getPost('bb'),
            'rr' => $this->request->getPost('rr'),
            'rb' => $this->request->getPost('rb'),
            'ket' => $this->request->getPost('ket')
        ];

        $alsusModel->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('alsus/index'));
    }

    public function edit($id_alsus)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsusModel = new AlsusModel();
        $alsus = $alsusModel->find($id_alsus);

        if (!$alsus) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data alsus tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Alsus',
            'alsus' => $alsus
        ];

        return view('alsus/edit', $data);
    }

    public function update($id_alsus)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsusModel = new AlsusModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'bmn' => $this->request->getPost('bmn'),
            'jumlah' => $this->request->getPost('jumlah'),
            'bb' => $this->request->getPost('bb'),
            'rr' => $this->request->getPost('rr'),
            'rb' => $this->request->getPost('rb'),
            'ket' => $this->request->getPost('ket')
        ];

        $alsusModel->update($id_alsus, $data);
        session()->setFlashdata('pesan', 'Data berhasil diupdate');

        return redirect()->to(base_url('alsus/index'));
    }

    public function delete($id_alsus)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsusModel = new AlsusModel();

        if ($alsusModel->find($id_alsus)) {
            $alsusModel->delete($id_alsus);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
        } else {
            throw new \Exception('Data alsus tidak ditemukan');
        }

        return redirect()->to(base_url('alsus/index'));
    }

    public function export()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsusModel = new AlsusModel();
        $satker = $this->request->getGet('nama_satker');
        $bmn = $this->request->getGet('bmn');

        $builder = $alsusModel->builder();
        $builder->select('alsus.*, satker.nama_satker')
            ->join('satker', 'satker.id_satker = alsus.id_satker', 'left');

        if ($satker) {
            $builder->where('satker.nama_satker', $satker);
        }
        if ($bmn) {
            $builder->where('alsus.bmn', $bmn);
        }

        $data = $builder->get()->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SATKER/SATWIL');
        $sheet->setCellValue('C1', 'JENIS BMN');
        $sheet->setCellValue('D1', 'JUMLAH');
        $sheet->setCellValue('E1', 'BAIK');
        $sheet->setCellValue('F1', 'RUSAK RINGAN');
        $sheet->setCellValue('G1', 'RUSAK BERAT');
        $sheet->setCellValue('H1', 'KETERANGAN');

        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['nama_satker'] ?? '');
            $sheet->setCellValue('C' . $row, $item['bmn']);
            $sheet->setCellValue('D' . $row, $item['jumlah']);
            $sheet->setCellValue('E' . $row, $item['bb']);
            $sheet->setCellValue('F' . $row, $item['rr']);
            $sheet->setCellValue('G' . $row, $item['rb']);
            $sheet->setCellValue('H' . $row, $item['ket']);

            $no++;
            $row++;
        }

        $sheet->setAutoFilter('A1:H1');

        $writer = new Xlsx($spreadsheet);
        $filename = 'data-alsus-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function tampil()
    {
       if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }
        $model = new AlsusModel();
        $alsus = $model->findAll();
        return view('alsus/tampil', ['alsus' => $alsus]);
    }
}
