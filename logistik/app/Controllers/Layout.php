<?php

namespace App\Controllers;

class Layout extends BaseController
{
    public function index(): string
    {
        return view('layout/index');
    }
    public function dashboard(): string
    {
        return view('layout/dashboard');
    }
    public function tampil(): string
    {
        return view('layout/tampil');
    }
}
