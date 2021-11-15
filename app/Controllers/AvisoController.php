<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Aviso;

class AvisoController extends BaseController
{

    public function __construct()
    {
        $this->aviso = new Aviso();
    }

    public function index()
    {
        $lista_avisos = $this->aviso->orderBy('created_at', 'DESC')->findAll();

        foreach ($lista_avisos as $key => $value) {

            $lista_avisos[$key]['created_at'] = date('d/m/y H:i:s', strtotime($value['created_at']));

            $lista_avisos[$key]['updated_at'] = date('d/m/y H:i:s', strtotime($value['updated_at']));

            if ($value['prioridade'] == 'Alta') {
                $lista_avisos[$key]['class'] = 'danger';
            } elseif ($value['prioridade'] == 'Media') {
                $lista_avisos[$key]['class'] = 'warning';
            } elseif ($value['prioridade'] == 'Baixa') {
                $lista_avisos[$key]['class'] = 'success';
            }
        }

        $json_data = array(
            'lista_avisos' => $lista_avisos,
            'nivel_usuario' => session()->get('nivel')
        );
        return $this->response->setJSON($json_data);
    }

    public function store()
    {
        $fixado = '';

        if ($this->request->getVar('fixado') == 'on') {
            $fixado = true;
        } else {
            $fixado = null;
        }

        $data = [
            'nome_usuario_criacao' => session()->get('nome'),
            'descricao' => $this->request->getVar('descricao'),
            'prioridade' => $this->request->getVar('prioridade'),
            'fixado' => $fixado,
        ];

        $this->aviso->save($data);
        return redirect()->to(base_url('/'))->with('msg', 'Aviso cadastrado com sucesso.');
    }

    public function update($id = null)
    {
        $id = $this->request->getVar('id');

        $fixado = '';

        if ($this->request->getVar('fixado') == 'on') {
            $fixado = true;
        } else {
            $fixado = null;
        }

        $data = [
            'nome_usuario_edicao' => session()->get('nome'),
            'descricao' => $this->request->getVar('descricao'),
            'prioridade' => $this->request->getVar('prioridade'),
            'fixado' => $fixado
        ];

        $this->aviso->update($id, $data);
        return redirect()->to(base_url('/'))->with('msg', 'Aviso alterado com sucesso.');
    }

    public function destroy($id = null)
    {
        $this->aviso->delete($id);
        return redirect()->to(base_url('/'))->with('msg', 'Aviso removido com sucesso.');
    }
}
