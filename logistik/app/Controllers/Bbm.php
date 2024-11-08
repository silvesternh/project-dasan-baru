<?php

namespace App\Controllers;

class Bbm extends BaseController
{
    public function index() : string
    {
        return view('bbm/index');
    }

    public function tambah() : string
    {
        return view('bbm/tambah');
    }
}
