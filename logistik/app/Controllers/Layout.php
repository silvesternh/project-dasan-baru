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
    public function drenmin(): string
    {
        return view('layout/drenmin');
    }
    public function dfaskon(): string
    {
        return view('layout/dfaskon');
    }
    public function dpal(): string
    {
        return view('layout/dpal');
    }
    public function dada(): string
    {
        return view('layout/dada');
    }
    public function dinfo(): string
    {
        return view('layout/dinfo');
    }
    public function dbekum(): string
    {
        return view('layout/dbekum');
    }
    public function dgudang(): string
    {
        return view('layout/dgudang');
    }
    
     public function index1(): string
    {
        return view('layout/index1');
    }
    public function dashboard1(): string
    {
        return view('layout/dashboard1');
    }
}
