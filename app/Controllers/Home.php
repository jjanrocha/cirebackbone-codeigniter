<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('logado')) {
            return view('home');
        } else {
            return view('login');
        }
    }
}
