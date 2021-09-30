<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use CodeIgniter\HTTP\Request;

class UsuarioController extends BaseController
{
    public function index()
    {
        return view('app/users/index', ['title' => 'Usuários']);
    }
}
