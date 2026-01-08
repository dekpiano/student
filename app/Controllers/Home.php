<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('UserId')) {
            return redirect()->to('Dashboard');
        }
        return view('index');
    }
}
