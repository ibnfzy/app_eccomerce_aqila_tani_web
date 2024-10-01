<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('web/home');
    }

    public function katalog()
    {
        return view('web/katalog');
    }

    public function tentang()
    {
        return view('web/tentang');
    }
}
