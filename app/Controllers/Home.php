<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('logado')) {
            return view('app/home', ['title' => 'Home']);
        
        } else {
            return view('login', ['title' => 'Login']);
        }
    }
}
