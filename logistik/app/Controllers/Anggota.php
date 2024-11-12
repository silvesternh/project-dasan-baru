<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Shield\Validation\ValidationRules;
use CodeIgniter\Shield\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggota extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $users = auth()->getProvider();
        $data = [
            'title' => 'Data Anggota',
            'admins' => $users->findAll()
        ];

        return view('anggota/index', $data);
    }

    public function create()
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $data = [
            'title' => 'Tambah Anggota',
            'validation' => \Config\Services::validation()
        ];

        return view('anggota/create', $data);
    }

    public function store()
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = service('validation');
        $users = auth()->getProvider();
        $rules = $this->getValidationRules();

        $userData = [
            'nama' => $this->request->getPost('nama'),
            'pangkat' => $this->request->getPost('pangkat'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan'),
            'foto' => $this->request->getPost('foto'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'password_confirm' => $this->request->getPost('password_confirm'),
        ];
        if (!$this->validateData($userData, $rules)) {
            $validation->listErrors();
            return redirect()->to('/anggota/create')->withInput()->with('validation', $validation);
        }
        $userData = new User($userData);
        $users->save($userData);
        $newUser = $users->findById($users->getInsertID());
        $newUser->addGroup($userData->jabatan);
        $newUser->activate();
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('anggota/index'));
    }

    public function edit($id_anggota)
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $users = auth()->getProvider();
        $anggota = $users->findById($id_anggota);

        if (!$anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Anggota',
            'anggota' => $anggota,
            'validation' => \Config\Services::validation()
        ];

        return view('anggota/edit', $data);
    }
    public function update($id_anggota)
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $validation = service('validation');
        $users = auth()->getProvider();
        $anggota = $users->findById($id_anggota);
        $rules = [
            'username' => [
                'label' => 'Auth.username',
                'rules' => [
                    'required',
                    'max_length[30]',
                    'min_length[3]',
                    'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                    'is_unique[users.username, id,' . $id_anggota . ']',
                ],
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => [
                    'required',
                    'max_length[200]',
                    'min_length[3]',
                    'alpha_space',
                    'is_unique[users.nama, id,' . $id_anggota . ']',
                ],
            ],
            'pangkat' => [
                'label' => 'Pangkat',
                'rules' => [
                    'required',
                    'max_length[100]',
                    'alpha_space',
                ],
            ],
            'nrp' => [
                'label' => 'NRP',
                'rules' => [
                    'required',
                    'max_length[16]',
                    'alpha_numeric_punct',
                    'is_unique[users.nrp, id,' . $id_anggota . ']',
                ],
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => [
                    'required',
                    'max_length[150]',
                    'alpha_space',
                ],
            ],
            'email' => [
                'label' => 'Auth.email',
                'rules' => [
                    'required',
                    'max_length[254]',
                    'valid_email',
                    'is_unique[auth_identities.secret, id,' . $id_anggota . ']',
                ],
            ],
            'password' => [
                'label' => 'Auth.password',
                'rules' => [
                    'permit_empty',
                    'max_byte[72]',
                    'strong_password[]',
                ],
                'errors' => [
                    'max_byte' => 'Auth.errorPasswordTooLongBytes',
                ]
            ],
            'password_confirm' => [
                'label' => 'Auth.passwordConfirm',
                'rules' => 'matches[password]|required_with[password]',
            ],
        ];
        if (!empty($anggota)) {
            $userData = [
                'id' => $id_anggota,
                'nama' => $this->request->getPost('nama'),
                'pangkat' => $this->request->getPost('pangkat'),
                'nrp' => $this->request->getPost('nrp'),
                'jabatan' => $this->request->getPost('jabatan'),
                'foto' => $this->request->getPost('foto'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'password_confirm' => $this->request->getPost('password_confirm'),
            ];

            if (!$this->validateData($userData, $rules)) {
                $validation->listErrors();
                return redirect()->to('/anggota/edit/' . $id_anggota)->withInput()->with('validation', $validation);
            }
            $userData = new User($userData);
            $users->update($id_anggota, $userData);
            $newUser = $users->findById($id_anggota);
            $newUser->syncGroups($userData->jabatan);
            $newUser->activate();
            session()->setFlashdata('pesan', 'Data berhasil diupdate');
            return redirect()->to(base_url('anggota/index'));
        } else {
            throw new \Exception('Data anggota tidak ditemukan');
        }
    }

    public function delete($id_anggota)
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        $users = auth()->getProvider();
        $anggota = $users->findById($id_anggota);
        if ($anggota) {
            $users->delete($anggota->id, true);

            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to(base_url('anggota/index'));
        } else {
            throw new \Exception('Data anggota tidak ditemukan');
        }
    }

    public function export()
    {
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        // $this->export();
        $anggotaModel = new \App\Models\AnggotaModel();
        $data = $anggotaModel->findAll();

        // Tambahkan filter disini
        $filter = $this->request->getPost('filter');
        if ($filter) {
            $data = $anggotaModel->where($filter)->findAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Pangkat');
        $sheet->setCellValue('D1', 'Nrp');
        $sheet->setCellValue('E1', 'Jabatan');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_anggota']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['pangkat']);
            $sheet->setCellValue('D' . $row, $item['nrp']);
            $sheet->setCellValue('E' . $row, $item['jabatan']);
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
        if (!auth()->user()->can('admin.access')) {
            return redirect()->to('layout/dashboard')->with('error', 'Akses Ditolak !!! Anda tidak diizinkan untuk mengkases halaman tersebut');
        }
        return view('anggota/impor');
    }
    public function getValidationRules()
    {
        $rules = new ValidationRules();

        return $rules->getRegistrationRules();

    }
}
