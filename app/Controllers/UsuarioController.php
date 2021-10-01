<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use CodeIgniter\HTTP\Request;
use Config\App;
use CodeIgniter\RESTful\ResourceController;


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

    public function create()
    {
        return view('app/users/create', ['title' => 'Cadastro de Usuário']);
    }

    public function store()
    {
        //validação dos campos
        if (!$this->validate($this->usuario->validationRules, $this->usuario->validationMessages)) {
            return redirect()->to(base_url() . "/usuarios/create")->withInput()->with('errors', $this->validator->getErrors());
        }
    }

}
