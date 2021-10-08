<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use CodeIgniter\HTTP\Request;
use Config\App;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;

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
        return view('app/usuarios/index', ['title' => 'Usuários']);
    }

    public function listarUsuarios()
    {
        $usuarios = $this->usuario->orderBy('nome', 'asc')->findAll();
        $json_data = array('data' => $usuarios);
        echo json_encode($json_data);
    }

    public function create()
    {
        return view('app/usuarios/create', ['title' => 'Cadastro de Usuário']);
    }

    public function store()
    {
        //validação dos campos
        if (!$this->validate($this->usuario->validationRules, $this->usuario->validationMessages)) {
            return redirect()->to(base_url() . "/usuarios/create")->withInput()->with('errors', $this->validator->getErrors());
        }

        //inserção do usuário no banco de dados caso os campos digitados estejam dentro dos parâmetros
        $this->usuario->save([
            'id'  => $this->request->getVar('id'),
            'nome' => mb_strtoupper($this->request->getVar('nome')),
            'password' => password_hash($this->request->getVar('id'), PASSWORD_DEFAULT),
            'nivel' => mb_strtoupper($this->request->getVar('nivel')),
        ]);

        return redirect()->to(base_url('/') . '/usuarios/' . $this->request->getVar('id'))->with('msg', 'Usuário cadastrado com sucesso.');
    }

    public function show($id = null)
    {
        $usuario = $this->usuario->find($id);
        if ($usuario) {
            return view('app/usuarios/show', [
                'usuario' => $usuario,
                'title' => 'Visualizar Usuário',
            ]);
        } else {
            return redirect()->to(base_url() . '/usuarios')->with('msg', 'O usuário com RE ' . $this->request->getUri()->getSegments()[1] . ' não foi localizado.');
        }
    }

    public function listarAtividadesUsuario($id = null)
    {

        $id = $_POST['id'];

        $db = db_connect();

        $builder = $db->table('cire_backbone_atividades');
        $builder->select('cire_backbone_atividades.numero_ta, cire_backbone_tipos_atividades.tipo_carimbo, cire_backbone_atividades.data_hora');
        $builder->where('usuario_id', $id);
        $builder->join('cire_backbone_tipos_atividades', 'cire_backbone_atividades.tipo_atividade_id = cire_backbone_tipos_atividades.id');
        $atividades = $builder->get()->getResultArray();

        $result = array();

        if (count($atividades) > 0) {
            foreach ($atividades as $atividade) {
                $result[] = [
                    $atividade['numero_ta'],
                    $atividade['tipo_carimbo'],
                    $atividade['data_hora'],
                ];
            }
        }

        $builder = $db->table('cire_backbone_atualizacoes_telegram');
        $builder->select('numero_ta, data_hora');
        $builder->where('usuario_id', $id);
        $atividades = $builder->get()->getResultArray();

        if (count($atividades) > 0) {
            foreach ($atividades as $atividade) {
                $result[] = [
                    $atividade['numero_ta'],
                    $atividade['tipo_carimbo'] = 'ATUALIZAÇÃO TELEGRAM',
                    $atividade['data_hora'],
                ];
            }
        }

        $json_data = array('data' => $result);
        return $this->response->setJSON($json_data);
    }

    public function edit($id = null)
    {

        $usuario = $this->usuario->find($id);
        if ($usuario) {
            return view('app/usuarios/edit', [
                'usuario' => $usuario,
                'title' => 'Editar Usuário'
            ]);
        } else {
            return redirect()->to(base_url() . '/usuarios')->with('msg', 'O usuário com RE ' . $this->request->getUri()->getSegments()[2] . ' não foi localizado.');
        }
    }

    public function update($id = null)
    {
        $id = $this->request->getVar('id');

        $data = [
            'nome' => mb_strtoupper($this->request->getVar('nome')),
            'nivel' => mb_strtoupper($this->request->getVar('nivel'))
        ];

        $rules = [
            'nome' => 'required',
            'nivel' => 'required',
        ];

        $feedback = [
            'nome' => [
                'required' => 'O campo nome é de preenchimento obrigatório',
            ],
            'nivel' => [
                'required' => 'O campo nível é de preenchimento obrigatório',
            ],
        ];

        if (!$this->validate($rules, $feedback)) {
            return redirect()->to(base_url("/usuarios/edit/" . $id))->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->usuario->update($id, $data);

        return redirect()->to(base_url("/usuarios/edit/" . $id))->with('msg', 'Usuário alterado com sucesso.');
    }

    public function destroy($id = null)
    {
        $this->usuario->delete($id);
        return redirect()->to(base_url('/usuarios'))->with('msg', 'Usuário com RE ' .$id. ' removido com sucesso.');
    }
}
