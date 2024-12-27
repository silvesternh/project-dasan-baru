<?php

namespace App\Controllers;

use App\Models\AnggotarologModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggotarolog extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('renmin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $anggotarologModel = new AnggotarologModel();
        $data = [
            'title' => 'Data anggotarolog',
            'anggotarolog' => $anggotarologModel->findAll()
        ];

        return view('anggotarolog/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('renmin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        // session();
        $data = [
            'title' => 'Tambah anggotarolog',
            'validation' => \Config\Services::validation()
        ];

        return view('anggotarolog/create', $data);
    }

    // Method untuk menyimpan data baru (termasuk upload foto)
    public function store()
    {
        if (!auth()->user()->can('renmin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        // Validasi form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama'    => 'required|min_length[3]',
            'pangkat' => 'required',
            'foto'    => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        // Proses Upload Foto
        $foto = $this->request->getFile('foto');

        if ($foto->isValid() && !$foto->hasMoved()) {
            // Mengatur nama file baru untuk foto
            $newName = $foto->getRandomName();

            // Menyimpan file ke public/uploads
            $foto->move(ROOTPATH . 'public/uploads', $newName);

            // Menyimpan data anggota ke database
            $anggotarologModel = new AnggotarologModel();
            $anggotarologModel->save([
                'bag'        => $this->request->getPost('bag'),
                'nama'        => $this->request->getPost('nama'),
                'pangkat'     => $this->request->getPost('pangkat'),
                'nrp'         => $this->request->getPost('nrp'),
                'jabatan'     => $this->request->getPost('jabatan'),
                'tanggallahir' => $this->request->getPost('tanggallahir'),
                'alamat'      => $this->request->getPost('alamat'),
                'level'      => $this->request->getPost('level'),
                'foto'        => $newName // Simpan nama file foto di database
            ]);
        }

        return redirect()->to('/anggotarolog/index')->with('success', 'Data anggotarolog berhasil ditambahkan');
    }
    public function edit($id)
    {
        if (!auth()->user()->can('renmin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $model = new AnggotarologModel();
        $anggotarolog = $model->find($id);

        if (!$anggotarolog) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Anggota dengan ID $id tidak ditemukan.");
        }

        $data = [
            'title' => 'Edit Anggotarolog',
            'anggotarolog' => $anggotarolog,
            'validation' => \Config\Services::validation()
        ];

        return view('anggotarolog/edit', $data);
    }

    public function update($id_anggotarolog)
    {
        if (!auth()->user()->can('renmin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }

        $anggotarologModel = new AnggotarologModel();
        $anggotarolog = $anggotarologModel->find($id_anggotarolog);

        if (!$anggotarolog) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggotarolog tidak ditemukan');
        }

        // Get the new file
        $fileFoto = $this->request->getFile('foto');
        $newFilePath = $anggotarolog['foto']; // Keep existing file path in case no new file is uploaded

        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // If there's a new file, move it and update the path
            $newName = $fileFoto->getRandomName();
            $fileFoto->move(ROOTPATH . 'public/uploads', $newName);
            $newFilePath = 'uploads/' . $newName;

            // Optionally delete the old photo file
            if ($anggotarolog['foto'] && file_exists(ROOTPATH . 'public/' . $anggotarolog['foto'])) {
                unlink(ROOTPATH . 'public/' . $anggotarolog['foto']);
            }
        }

        $data = [
            'bag' => $this->request->getPost('bag'),
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan'),
            'tanggallahir' => $this->request->getPost('tanggallahir'),
            'alamat' => $this->request->getPost('alamat'),
            'level' => $this->request->getPost('level'),
            'foto' => $newFilePath // Save the new or existing file path
        ];

        $anggotarologModel->update($id_anggotarolog, $data);

        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('anggotarolog/index'));
    }

    public function delete($id_anggotarolog)
    {
        if (!auth()->user()->can('renmin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $anggotarologModel = new AnggotarologModel();
        $anggotarolog = $anggotarologModel->find($id_anggotarolog);

        if ($anggotarolog) {
            $anggotarologModel->delete($id_anggotarolog);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to(base_url('anggotarolog/index'));
        } else {
            throw new \Exception('Data anggotarolog tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('renmin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $anggotarologModel = new \App\Models\AnggotarologModel();


        $uraian = $this->request->getGet('uraian');

        // Start with the base query
        $builder = $anggotarologModel->builder();


        if ($uraian) {
            $builder->where('anggotarolog.uraian', $uraian);
        }
        // Get the data (this will apply the filters or return all data if no filters are set)
        $data = $builder->get()->getResultArray();

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'BAG');
        $sheet->setCellValue('C1', 'NAMA');
        $sheet->setCellValue('D1', 'PANGKAT');
        $sheet->setCellValue('E1', 'NRP');
        $sheet->setCellValue('F1', 'JABATAN');
        $sheet->setCellValue('G1', 'TANGGALLAHIR');
        $sheet->setCellValue('H1', 'ALAMAT');
        $sheet->setCellValue('I1', 'FOTO');

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

        $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

        // Write data to the sheet
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            // Since we are joining, 'satker' is available in the data
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['bag']);
            $sheet->setCellValue('C' . $row, $item['nama']);
            $sheet->setCellValue('D' . $row, $item['pangkat']);
            $sheet->setCellValue('E' . $row, $item['nrp']);
            $sheet->setCellValue('F' . $row, $item['jabatan']);
            $sheet->setCellValue('G' . $row, $item['tanggallahir']);
            $sheet->setCellValue('H' . $row, $item['alamat']);
            $sheet->setCellValue('I' . $row, $item['foto']);

            $no++;
            $row++;
        }

        // Apply AutoFilter to the header row
        $sheet->setAutoFilter('A1:H1');

        // Write the file to the browser
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data-anggotarolog-' . date('Y-m-d-H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function tampil()
    {

        $model = new AnggotarologModel();
        $anggotarolog = $model->findAll();
        return view('anggotarolog/tampil', ['anggotarolog' => $anggotarolog]);
    }
}
