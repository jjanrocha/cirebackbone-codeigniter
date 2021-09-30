<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('logado')) {
            return view('home', 
                ['nome_usuario' => session()->get('nome'),
                ['id_usuario' => session()->get('id')],
                ['nivel_usuario' => session()->get('nivel')],
        ]);
        
        } else {
            return view('login');
        }
    }
}
