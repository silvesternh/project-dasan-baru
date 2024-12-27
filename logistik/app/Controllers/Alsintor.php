<?php

namespace App\Controllers;

use App\Models\AlsintorModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Alsintor extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsintorModel = new AlsintorModel();
        $alsintor = $alsintorModel->getAlsintorWithSatker();

        $data = [
            'title' => 'Data alsintor',
            'alsintor' => $alsintor
        ];

        return view('alsintor/index', $data);
    }
    
    public function data()
    {
        if (!auth()->user()->can('pal.access') && !auth()->user()->can('bekum.access')) {
            // If user doesn't have either permission, redirect with an error message
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsintorModel = new AlsintorModel();
        $alsintor = $alsintorModel->getAlsintorWithSatker();

        $data = [
            'title' => 'Data alsintor',
            'alsintor' => $alsintor
        ];

        return view('alsintor/data', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $data = [
            'title' => 'Tambah alsintor',
            'validation' => \Config\Services::validation()
        ];

        return view('alsintor/create', $data);
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
            'rb' => 'required|integer',
            'ket' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/alsintor/create')->withInput()->with('validation', \Config\Services::validation());
        }

        $alsintorModel = new AlsintorModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'bmn' => $this->request->getPost('bmn'),
            'jumlah' => $this->request->getPost('jumlah'),
            'bb' => $this->request->getPost('bb'),
            'rr' => $this->request->getPost('rr'),
            'rb' => $this->request->getPost('rb'),
            'ket' => $this->request->getPost('ket')
        ];

        $alsintorModel->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('alsintor/index'));
    }

    public function edit($id_alsintor)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsintorModel = new AlsintorModel();
        $alsintor = $alsintorModel->find($id_alsintor);

        if (!$alsintor) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data alsintor tidak ditemukan');
        }

        $data = [
            'title' => 'Edit alsintor',
            'alsintor' => $alsintor
        ];

        return view('alsintor/edit', $data);
    }

    public function update($id_alsintor)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsintorModel = new AlsintorModel();
        $data = [
            'id_satker' => $this->request->getPost('id_satker'),
            'bmn' => $this->request->getPost('bmn'),
            'jumlah' => $this->request->getPost('jumlah'),
            'bb' => $this->request->getPost('bb'),
            'rr' => $this->request->getPost('rr'),
            'rb' => $this->request->getPost('rb'),
            'ket' => $this->request->getPost('ket')
        ];

        $alsintorModel->update($id_alsintor, $data);
        session()->setFlashdata('pesan', 'Data berhasil diupdate');

        return redirect()->to(base_url('alsintor/index'));
    }

    public function delete($id_alsintor)
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsintorModel = new AlsintorModel();

        if ($alsintorModel->find($id_alsintor)) {
            $alsintorModel->delete($id_alsintor);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
        } else {
            throw new \Exception('Data alsintor tidak ditemukan');
        }

        return redirect()->to(base_url('alsintor/index'));
    }

    public function export()
    {
        if (!auth()->user()->can('pal.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }

        $alsintorModel = new AlsintorModel();
        $satker = $this->request->getGet('nama_satker');
        $bmn = $this->request->getGet('bmn');

        $builder = $alsintorModel->builder();
        $builder->select('alsintor.*, satker.nama_satker')
            ->join('satker', 'satker.id_satker = alsintor.id_satker', 'left');

        if ($satker) {
            $builder->where('satker.nama_satker', $satker);
        }
        if ($bmn) {
            $builder->where('alsintor.bmn', $bmn);
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
        $filename = 'data-alsintor-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function tampil()
    {
        if (!auth()->user()->can('pal.access') && !auth()->user()->can('bekum.access')) {
            // If user doesn't have either permission, redirect with an error message
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak! Anda tidak diizinkan mengakses halaman ini.');
        }
        $model = new AlsintorModel();
        $alsintor = $model->findAll();
        return view('alsintor/tampil', ['alsintor' => $alsintor]);
    }
}
