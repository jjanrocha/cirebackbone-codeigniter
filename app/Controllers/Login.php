<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use App\Models\Usuario;

class Login extends BaseController
{
    public function logar()
    {
        $session = session();

        $usuario = new Usuario();

        $id = $this->request->getVar('id');

        $data = $usuario->where('id', $id)->first();

        if ($data) {
            $session_data = [
                'id' => $data['id'],
                'nome' => $data['nome'],
                'nivel' => $data['nivel'],
                'logado' => TRUE
            ];
            $session->set($session_data);
            return redirect()->to(base_url('/'));
        } else {
            $session->setFlashdata('msg', 'Usuário não localizado.');
            return redirect()->to(base_url('/'))->withInput();
        }
    }

    public function logout() {

        $session = session();

        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
