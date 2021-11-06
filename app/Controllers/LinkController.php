<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Link;

class LinkController extends BaseController
{

    public function __construct()
    {
        $this->link = new Link();
    }

    public function index()
    {
        $links = $this->link->orderBy('titulo', 'asc')->findAll();
        return view('app/links', [
            'title' => 'Links',
            'links' => $links
        ]);
    }

    public function store()
    {
        $data = [
            'titulo' => $this->request->getVar('titulo'),
            'link' => $this->request->getVar('link')
        ];

        if (!$this->validate($this->link->validationRules, $this->link->validationMessages)) {
            return redirect()->to(base_url("/links/"))->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->link->save($data);

        return redirect()->to(base_url("/links/"))->with('msg', 'Link salvo com sucesso.');
    }

    public function update($id = null)
    {
        $id = $this->request->getVar('id');

        $data = [
            'titulo' => $this->request->getVar('titulo'),
            'link' => $this->request->getVar('link')
        ];

        $rules = [
            'titulo' => 'required',
            'link' => 'required',
        ];

        $feedback = [
            'titulo' => [
                'required' => 'O campo título é de preenchimento obrigatório',
            ],
            'link' => [
                'required' => 'O campo link é de preenchimento obrigatório',
            ],
        ];

        if (!$this->validate($rules, $feedback)) {
            //return redirect()->to(base_url("/links/"))->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->link->update($id, $data);

        return redirect()->to(base_url("/links/"))->with('msg', 'Alterado com sucesso.');
    }

    public function destroy($id = null)
    {
        if ($this->link->delete($id)) {
            $msg = 'Link removido com sucesso.';
        } else {
            $msg = 'Ocorreu um erro na remoção do link. Por favor, tente novamente.';
        }

        return redirect()->to(base_url('/links'))->with('msg', $msg);
    }
}
