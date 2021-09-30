<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use CodeIgniter\HTTP\Request;

class UsuarioController extends BaseController
{

    private $usuario;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->usuario = new Usuario;
    }

    public function index()
    {
        return view('app/users/index', ['title' => 'Usuários']);
    }

    public function listarUsuarios()
    {
        $usuarios = $this->usuario->orderBy('nome', 'asc')->findAll();
        $json_data = array('data' => $usuarios);
        echo json_encode($json_data);
    }

    public function create() {
        return view('app/users/create', ['title' => 'Cadastro de Usuário']);
    }
}
