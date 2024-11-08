<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\HTTP\ResponseInterface;

class Admins extends BaseController
{
    public function index()
    {
        $users = auth()->getProvider();
        $data = [
            'title' => 'Data Admins',
            'admins' => $users->findAll(),
        ];

        return view('Shield/index', $data);
    }
    public function new()
    {
        $data = [
            'title' => 'Data Admins',
        ];
        helper('form');
        return view('Shield/add_admins', $data);
    }
    public function edit($id)
    {
        $users = auth()->getProvider();
        $data = [
            'title' => 'Data Admins',
            'admins' => $users->find($id),
        ];
        return view('Shield/edit_admins', $data);
    }
    public function create()
    {
        helper('form');
        $data = $this->request->getPost(['nama', 'pangkat', 'nrp', 'jabatan', 'username', 'email', 'password', 'confirm_password']);
        if (
            !$this->validateData($data, 'registration')
        ) {
            // The validation fails, so returns the form.
            return $this->new();
        }
        $post = $this->validator->getValidated();
        $users = auth()->getProvider();
        $user = new User([
            'nama' => $post['nama'],
            'pangkat' => $post['pangkat'],
            'nrp' => $post['nrp'],
            'jabatan' => $post['jabatan'],
            'username' => $post['username'],
            'email' => $post['email'],
            'password' => $post['password'],
        ]);
        $users->addToDefaultGroup($user);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url('admins/index'));
    }
}
