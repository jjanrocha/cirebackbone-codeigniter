<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use App\Models\Atividade;
use App\Models\Contratada;
use App\Models\Equipamento;
use App\Models\Operadora;
use App\Models\TipoAtividade;

class ControleController extends BaseController
{

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->validation =  \Config\Services::validation();

        $this->session = \Config\Services::session();

        $this->atividade = new Atividade;
    }

    public function index()
    {
        return view('app/carimbos/controle', [
            'title' => 'Controle'
        ]);
    }

    public function carregarFormCrise()
    {
        $contratada = new Contratada();
        $lista_contratadas = $contratada->orderBy('nome', 'asc')->findAll();
        return view('app/carimbos/forms/controle/escalonamento_crise', [
            'contratadas' => $lista_contratadas
        ]);
    }

    public function carregarFormUrgente()
    {
        $contratada = new Contratada();
        $lista_contratadas = $contratada->orderBy('nome', 'asc')->findAll();
        return view('app/carimbos/forms/controle/escalonamento_urgente', [
            'contratadas' => $lista_contratadas
        ]);
    }

    public function carregarFormAtualizacaoTelegram()
    {
        $equipamento = new Equipamento();
        $equipamentos = $equipamento->orderBy('fabricante', 'asc')->findAll();

        $operadora = new Operadora();
        $operadoras = $operadora->orderBy('nome', 'asc')->findAll();

        return view('app/carimbos/forms/controle/atualizacao_telegram', [
            'equipamentos' => $equipamentos,
            'operadoras' => $operadoras
        ]);
    }

    public function insertCarimboCrise()
    {
        $nome_usuario = session()->get('nome');

        $this->validation->setRules(
            [
                'numero_ta' => 'required|integer',
                'nome_eps' => 'required',
                'tipo_carimbo' => 'required',
                'nome_control_desk_um_cire_atento' => 'required',
                'forma_contato_control_desk_um_cire_atento' => 'required',
                //'nome_control_desk_dois_cire_atento' => 'required',
                //'forma_contato_control_desk_dois_cire_atento' => 'required',
                'nome_supervisao_cire_atento' => 'required',
                'forma_contato_supervisao_cire_atento' => 'required',
                'nome_coordenacao_cire_atento' => 'required',
                'forma_contato_coordenacao_cire_atento' => 'required',
                'nome_gestao_cire_atento' => 'required',
                'forma_contato_gestao_cire_atento' => 'required',
                'forma_contato_gestao_cire_atento' => 'required',
                'nome_coordenacao_eps' => 'required',
                'horario_contato_coordenacao_eps' => 'required',
                'forma_contato_coordenacao_eps' => 'required',
                'nome_gerente_eps' => 'required',
                'horario_contato_gerente_eps' => 'required',
                'forma_contato_gerente_eps' => 'required',
                'nome_coordenacao_rede_externa' => 'required',
                'horario_contato_coordenacao_rede_externa' => 'required',
                'forma_contato_coordenacao_rede_externa' => 'required',
                'nome_gerente_secao_rede_externa' => 'required',
                'horario_contato_gerente_secao_rede_externa' => 'required',
                'forma_contato_gerente_secao_rede_externa' => 'required',
                'nome_gerente_divisao_rede_externa' => 'required',
                'horario_contato_gerente_divisao_rede_externa' => 'required',
                'forma_contato_gerente_divisao_rede_externa' => 'required',
                'nome_direcao_rede_externa' => 'required',
                'horario_contato_direcao_rede_externa' => 'required',
                'forma_contato_direcao_rede_externa' => 'required',
                'nome_gestao_cire_vivo' => 'required',
                'horario_contato_gestao_cire_vivo' => 'required',
                'forma_contato_gestao_cire_vivo' => 'required',
                'nome_coordenacao_cire_vivo' => 'required',
                'horario_contato_coordenacao_cire_vivo' => 'required',
                'forma_contato_coordenacao_cire_vivo' => 'required',
                'nome_gerente_cire_vivo' => 'required',
                'horario_contato_gerente_cire_vivo' => 'required',
                'forma_contato_gerente_cire_vivo' => 'required',
                'nome_gerente_divisao_cire_vivo' => 'required',
                'horario_contato_gerente_divisao_cire_vivo' => 'required',
                'forma_contato_gerente_divisao_cire_vivo' => 'required'
            ],
            [
                'numero_ta' => [
                    'required' => 'Informar o TA.',
                    'integer' => 'O TA deve possuir apenas números.',
                ],
                'nome_eps' => [
                    'required' => 'Informar a EPS.',
                ],
                'tipo_carimbo' => [
                    'required' => 'Informar o tipo de carimbo',
                ],
                'nome_control_desk_um_cire_atento' => [
                    'required' => 'Informar control desk (Atento)',
                ],
                'forma_contato_control_desk_um_cire_atento' => [
                    'required' => 'Informar a forma de contato com control desk (Atento)',
                ],
                'nome_supervisao_cire_atento' => [
                    'required' => 'Informar o/a supervisor(a) (Atento)',
                ],
                'forma_contato_supervisao_cire_atento' => [
                    'required' => 'Informar a forma de contato com a supervisão (Atento)',
                ],
                'nome_coordenacao_cire_atento' => [
                    'required' => 'Informar o/a coordenador(a) (Atento)',
                ],
                'forma_contato_coordenacao_cire_atento' => [
                    'required' => 'Informar a forma de contato com a coordenação (Atento)',
                ],
                'nome_gestao_cire_atento' => [
                    'required' => 'Informar o/a gestor(a) (Atento)',
                ],
                'forma_contato_gestao_cire_atento' => [
                    'required' => 'Informar a forma de contato com a gestão (Atento)',
                ],
                'nome_coordenacao_eps' => [
                    'required' => 'Informar o/a coordenador(a) (EPS)',
                ],
                'horario_contato_coordenacao_eps' => [
                    'required' => 'Informar o horário do contato com a coordenação (EPS)',
                ],
                'forma_contato_coordenacao_eps' => [
                    'required' => 'Informar a forma de contato com a coordenação (EPS)',
                ],
                'nome_gerente_eps' => [
                    'required' => 'Informar gerente (EPS)',
                ],
                'horario_contato_gerente_eps' => [
                    'required' => 'Informar o horário de contato com a gerência (EPS)',
                ],
                'forma_contato_gerente_eps' => [
                    'required' => 'Informar a forma de contato com a gerência (EPS)',
                ],
                'nome_coordenacao_rede_externa' => [
                    'required' => 'Informar o/a coordenador(a) (Rede Externa)',
                ],
                'horario_contato_coordenacao_rede_externa' => [
                    'required' => 'Informar o horário de contato com a coordenação (Rede Externa)',
                ],
                'forma_contato_coordenacao_rede_externa' => [
                    'required' => 'Informar a forma de contato com a coordenação (Rede Externa)',
                ],
                'nome_gerente_secao_rede_externa' => [
                    'required' => 'Informar gerente seção (Rede Externa)',
                ],
                'horario_contato_gerente_secao_rede_externa' => [
                    'required' => 'Informar o horário de contato com gerente seção (Rede Externa)',
                ],
                'forma_contato_gerente_secao_rede_externa' => [
                    'required' => 'Informar a forma de contato com gerente seção (Rede Externa)',
                ],
                'nome_gerente_divisao_rede_externa' => [
                    'required' => 'Informar gerente divisão (Rede Externa)',
                ],
                'horario_contato_gerente_divisao_rede_externa' => [
                    'required' => 'Informar o horário de contato com gerente divisão (Rede Externa)',
                ],
                'forma_contato_gerente_divisao_rede_externa' => [
                    'required' => 'Informar a forma de contato com gerente divisão (Rede Externa)',
                ],
                'nome_direcao_rede_externa' => [
                    'required' => 'Informar gerente divisão (Rede Externa)',
                ],
                'horario_contato_direcao_rede_externa' => [
                    'required' => 'Informar o horário de contato com gerente divisão (Rede Externa)',
                ],
                'forma_contato_direcao_rede_externa' => [
                    'required' => 'Informar a forma de contato com gerente divisão (Rede Externa)',
                ],
                'nome_gestao_cire_vivo' => [
                    'required' => 'Informar gestor(a) (CIRE Vivo)',
                ],
                'horario_contato_gestao_cire_vivo' => [
                    'required' => 'Informar o horário de contato com a gestão (CIRE Vivo)',
                ],
                'forma_contato_gestao_cire_vivo' => [
                    'required' => 'Informar a forma de contato com a gestão (CIRE Vivo)',
                ],
                'nome_coordenacao_cire_vivo' => [
                    'required' => 'Informar coordenador(a) (CIRE Vivo)',
                ],
                'horario_contato_coordenacao_cire_vivo' => [
                    'required' => 'Informar o horário de contato com a coordenação (CIRE Vivo)',
                ],
                'forma_contato_coordenacao_cire_vivo' => [
                    'required' => 'Informar a forma de contato com a coordenação (CIRE Vivo)',
                ],
                'nome_gerente_cire_vivo' => [
                    'required' => 'Informar gerente (CIRE Vivo)',
                ],
                'horario_contato_gerente_cire_vivo' => [
                    'required' => 'Informar o horário de contato com a gerência (CIRE Vivo)',
                ],
                'forma_contato_gerente_cire_vivo' => [
                    'required' => 'Informar a forma de contato com a gerência (CIRE Vivo)',
                ],
                'nome_gerente_divisao_cire_vivo' => [
                    'required' => 'Informar gerente divisão (CIRE Vivo)',
                ],
                'horario_contato_gerente_divisao_cire_vivo' => [
                    'required' => 'Informar o horário de contato com a gerência divisão (CIRE Vivo)',
                ],
                'forma_contato_gerente_divisao_cire_vivo' => [
                    'required' => 'Informar a forma de contato com a gerência divisão (CIRE Vivo)',
                ],
            ]
        );

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['error' => $this->validation->getErrors()]);
        }

        //Criação do carimbo para insert no banco e retorno ao usuário.
        $response['carimbo'] = "xxxxxxxxxxxxxxx Escalonamento CRISE " . $this->request->getVar('tipo_carimbo') . " " . "xxxxxxxxxxxxxx\n----------------------------------------------------\nCIRE ATENTO\nControl Desk: " . $this->request->getVar('nome_control_desk_um_cire_atento') . " " . $this->request->getVar('forma_contato_control_desk_um_cire_atento') . "\nSupervisor(a): " . $this->request->getVar('nome_supervisao_cire_atento') . " " . $this->request->getVar('forma_contato_supervisao_cire_atento') . "\nCoordenador(a): " . $this->request->getVar('nome_coordenacao_cire_atento') . " " . $this->request->getVar('forma_contato_coordenacao_cire_atento') . "\nGestor(a): " . $this->request->getVar('nome_gestao_cire_atento') . " " . $this->request->getVar('forma_contato_gestao_cire_atento') . "\n----------------------------------------------------\nEPS (" . $this->request->getVar('nome_eps') . ")\nCoordenador(a): " . $this->request->getVar('nome_coordenacao_eps') . " " . $this->request->getVar('horario_contato_coordenacao_eps') . " " . $this->request->getVar('forma_contato_coordenacao_eps') . "\nGerente: " . $this->request->getVar('nome_gerente_eps') . " " . $this->request->getVar('horario_contato_gerente_eps')  . " " . $this->request->getVar('forma_contato_gerente_eps') . "\n----------------------------------------------------\nREDE EXTERNA\nCoordenador(a): " . $this->request->getVar('nome_coordenacao_rede_externa') . " " . $this->request->getVar('horario_contato_coordenacao_rede_externa') . " " . $this->request->getVar('forma_contato_coordenacao_rede_externa') . "\nGerente Seção: " . $this->request->getVar('nome_gerente_secao_rede_externa') . " " . $this->request->getVar('horario_contato_gerente_secao_rede_externa') . " " . $this->request->getVar('forma_contato_gerente_secao_rede_externa') . "\nGerente Divisão: " . $this->request->getVar('nome_gerente_divisao_rede_externa') . " " . $this->request->getVar('horario_contato_gerente_divisao_rede_externa') . " " . $this->request->getVar('forma_contato_gerente_divisao_rede_externa') . "\nDiretora(a): " . $this->request->getVar('nome_direcao_rede_externa') . " " . $this->request->getVar('horario_contato_direcao_rede_externa') . " " . $this->request->getVar('forma_contato_direcao_rede_externa') . "\n----------------------------------------------------\nCIRE VIVO\nGestor(a): " . $this->request->getVar('nome_gestao_cire_vivo') . " " . $this->request->getVar('horario_contato_gestao_cire_vivo') . " " . $this->request->getVar('forma_contato_gestao_cire_vivo') . "\nCoordenador(a): " . $this->request->getVar('nome_coordenacao_cire_vivo') . " " . $this->request->getVar('horario_contato_coordenacao_cire_vivo') . " " . $this->request->getVar('forma_contato_coordenacao_cire_vivo') . "\nGerente: " . $this->request->getVar('nome_gerente_cire_vivo') . " " . $this->request->getVar('horario_contato_gerente_cire_vivo') . " " . $this->request->getVar('forma_contato_gerente_cire_vivo') . "\nGerente Divisão: " . $this->request->getVar('nome_gerente_divisao_cire_vivo') . " " . $this->request->getVar('horario_contato_gerente_divisao_cire_vivo') . " " . $this->request->getVar('forma_contato_gerente_divisao_cire_vivo') . "\n----------------------------------------------------\nAnalista Cire: " . $nome_usuario . "\nxxxxxxxxxxxxxxx Escalonamento CRISE " . $this->request->getVar('tipo_carimbo') . " " . "xxxxxxxxxxxxxx";

        //Atribuindo os valores
        $this->atividade->save([
            "usuario_id" => session()->get('id'),
            "data_hora" => date("Y-m-d H:i:s"),
            "numero_ta" => $this->request->getVar('numero_ta'),
            "tipo_atividade_id" => 1,
            "carimbo" => $response['carimbo']
        ]);

        return $this->response->setJSON($response);
    }

    public function insertCarimboUrgente()
    {
        $nome_usuario = session()->get('nome');

        $this->validation->setRules(
            [
                'numero_ta' => 'required|integer',
                'nome_eps' => 'required',
                'escalonamento_horas' => 'required',
                'n1_vivo_rede' => 'required',
                'horario_contato_n1_vivo_rede' => 'required',
                'forma_contato_n1_vivo_rede' => 'required',
                'n2_vivo_rede' => 'required',
                'horario_contato_n2_vivo_rede' => 'required',
                'forma_contato_n2_vivo_rede' => 'required',
                'n3_vivo_rede' => 'required',
                'horario_contato_n3_vivo_rede' => 'required',
                'forma_contato_n3_vivo_rede' => 'required',
                'n4_vivo_rede' => 'required',
                'horario_contato_n4_vivo_rede' => 'required',
                'forma_contato_n4_vivo_rede' => 'required',
                'n1_vivo_cire' => 'required',
                'horario_contato_n1_vivo_cire' => 'required',
                'forma_contato_n1_vivo_cire' => 'required',
                'n2_vivo_cire' => 'required',
                'horario_contato_n2_vivo_cire' => 'required',
                'forma_contato_n2_vivo_cire' => 'required',
                'n3_vivo_cire' => 'required',
                'horario_contato_n3_vivo_cire' => 'required',
                'forma_contato_n3_vivo_cire' => 'required',
                'n4_vivo_cire' => 'required',
                'horario_contato_n4_vivo_cire' => 'required',
                'forma_contato_n4_vivo_cire' => 'required',
                'n1_eps' => 'required',
                'horario_contato_n1_eps' => 'required',
                'forma_contato_n1_eps' => 'required',
                'n2_eps' => 'required',
                'horario_contato_n2_eps' => 'required',
                'forma_contato_n2_eps' => 'required',
            ],
            [   // Errors
                'numero_ta' => [
                    'required' => 'Informar o TA.',
                    'integer' => 'O TA deve possuir apenas números.',
                ],
                'nome_eps' => [
                    'required' => 'Informar a EPS.',
                ],
                'escalonamento_horas' => [
                    'required' => 'Informar as horas do escalonamento',
                ],
                'n1_vivo_rede' => [
                    'required' => 'Informar o N1 Vivo Rede.',
                ],
                'horario_contato_n1_vivo_rede' => [
                    'required' => 'Informar o horário de contato com N1 Vivo Rede.',
                ],
                'forma_contato_n1_vivo_rede' => [
                    'required' => 'Informar a forma de contato com N1 Vivo Rede.',
                ],
                'n2_vivo_rede' => [
                    'required' => 'Informar o N2 Vivo Rede.',
                ],
                'horario_contato_n2_vivo_rede' => [
                    'required' => 'Informar o horário de contato com N2 Vivo Rede.',
                ],
                'forma_contato_n2_vivo_rede' => [
                    'required' => 'Informar a forma de contato com N2 Vivo Rede.',
                ],
                'n3_vivo_rede' => [
                    'required' => 'Informar o N3 Vivo Rede.',
                ],
                'horario_contato_n3_vivo_rede' => [
                    'required' => 'Informar o horário de contato com N3 Vivo Rede.',
                ],
                'forma_contato_n3_vivo_rede' => [
                    'required' => 'Informar a forma de contato com N3 Vivo Rede.',
                ],
                'n4_vivo_rede' => [
                    'required' => 'Informar o N4 Vivo Rede.',
                ],
                'horario_contato_n4_vivo_rede' => [
                    'required' => 'Informar o horário de contato com N4 Vivo Rede.',
                ],
                'forma_contato_n4_vivo_rede' => [
                    'required' => 'Informar a forma de contato com N4 Vivo Rede.',
                ],
                'n1_vivo_cire' => [
                    'required' => 'Informar o N1 Vivo CIRE.',
                ],
                'horario_contato_n1_vivo_cire' => [
                    'required' => 'Informar o horário de contato com N1 Vivo CIRE.',
                ],
                'forma_contato_n1_vivo_cire' => [
                    'required' => 'Informar a forma de contato com N1 Vivo CIRE.',
                ],
                'n2_vivo_cire' => [
                    'required' => 'Informar o N2 Vivo CIRE.',
                ],
                'horario_contato_n2_vivo_cire' => [
                    'required' => 'Informar o horário de contato com N2 Vivo CIRE.',
                ],
                'forma_contato_n2_vivo_cire' => [
                    'required' => 'Informar a forma de contato com N2 Vivo CIRE.',
                ],
                'n3_vivo_cire' => [
                    'required' => 'Informar o N3 Vivo CIRE.',
                ],
                'horario_contato_n3_vivo_cire' => [
                    'required' => 'Informar o horário de contato com N3 Vivo CIRE.',
                ],
                'forma_contato_n3_vivo_cire' => [
                    'required' => 'Informar a forma de contato com N3 Vivo CIRE.',
                ],
                'n4_vivo_cire' => [
                    'required' => 'Informar o N4 Vivo CIRE.',
                ],
                'horario_contato_n4_vivo_cire' => [
                    'required' => 'Informar o horário de contato com N4 Vivo CIRE.',
                ],
                'forma_contato_n4_vivo_cire' => [
                    'required' => 'Informar a forma de contato com N4 Vivo CIRE.',
                ],
                'n1_eps' => [
                    'required' => 'Informar o N1 Vivo EPS.',
                ],
                'horario_contato_n1_eps' => [
                    'required' => 'Informar o horário de contato com N1 EPS.',
                ],
                'forma_contato_n1_eps' => [
                    'required' => 'Informar a forma de contato com N1 EPS.',
                ],
                'n2_eps' => [
                    'required' => 'Informar o N2 EPS.',
                ],
                'horario_contato_n2_eps' => [
                    'required' => 'Informar o horário de contato com N2 EPS.',
                ],
                'forma_contato_n2_eps' => [
                    'required' => 'Informar a forma de contato com N2 EPS.',
                ],
            ]
        );

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['error' => $this->validation->getErrors()]);
        }

        $response['carimbo'] = "xxxxxxxxxxxxxxx Escalonamento " . $this->request->getVar('escalonamento_horas') . " horas xxxxxxxxxxxxxx\n----------------------------------------------------\nVIVO REDE\nN1: " . $this->request->getVar('n1_vivo_rede') . " " . $this->request->getVar('horario_contato_n1_vivo_rede') . " " . $this->request->getVar('forma_contato_n1_vivo_rede') . "\nN2: " . $this->request->getVar('n2_vivo_rede') . " " . $this->request->getVar('horario_contato_n2_vivo_rede') . " " . $this->request->getVar('forma_contato_n2_vivo_rede') . "\nN3: " . $this->request->getVar('n3_vivo_rede') . " " . $this->request->getVar('horario_contato_n3_vivo_rede') . " " . $this->request->getVar('forma_contato_n3_vivo_rede') . "\nN4: " . $this->request->getVar('n4_vivo_rede') . " " . $this->request->getVar('horario_contato_n4_vivo_rede') . " " . $this->request->getVar('forma_contato_n4_vivo_rede') .  "\nN5: " . $this->request->getVar('n5_vivo_rede') . " " . $this->request->getVar('horario_contato_n5_vivo_rede') . " " . $this->request->getVar('forma_contato_n5_vivo_rede') . "\n----------------------------------------------------\nVIVO CIRE \nN1: " . $this->request->getVar('n1_vivo_cire') . " " . $this->request->getVar('horario_contato_n1_vivo_cire') . " " . $this->request->getVar('forma_contato_n1_vivo_cire') . "\nN2: " . $this->request->getVar('n2_vivo_cire') . " " . $this->request->getVar('horario_contato_n2_vivo_cire') . " " . $this->request->getVar('forma_contato_n2_vivo_cire') . "\nN3: " . "" . $this->request->getVar('n3_vivo_cire') . " " . $this->request->getVar('horario_contato_n3_vivo_cire') . " " . $this->request->getVar('forma_contato_n3_vivo_cire') . "\nN4: " . "" . $this->request->getVar('n4_vivo_cire') . " " . $this->request->getVar('horario_contato_n4_vivo_cire') . " " . $this->request->getVar('forma_contato_n4_vivo_cire') . "\nN5: " . "" . $this->request->getVar('n5_vivo_cire') . " " . $this->request->getVar('horario_contato_n5_vivo_cire') .  " " . $this->request->getVar('forma_contato_n5_vivo_cire') . "\n----------------------------------------------------\nEPS " . $this->request->getVar('nome_eps') . "\nN1: " . $this->request->getVar('n1_eps') . " " . $this->request->getVar('horario_contato_n1_eps') . " " . $this->request->getVar('forma_contato_n1_eps') . "\nN2: " . $this->request->getVar('n2_eps') . " " . $this->request->getVar('horario_contato_n2_eps') . " " . $this->request->getVar('forma_contato_n2_eps') .  "\n----------------------------------------------------\nAnalista Cire: " . $nome_usuario . "\nxxxxxxxxxxxxxxx Escalonamento " . $this->request->getVar('escalonamento_horas') . " horas xxxxxxxxxxxxxx";

        //Atribuindo os valores
        $this->atividade->save([
            "usuario_id" => session()->get('id'),
            "data_hora" => date("Y-m-d H:i:s"),
            "numero_ta" => $this->request->getVar('numero_ta'),
            "tipo_atividade_id" => 2,
            "carimbo" => $response['carimbo']
        ]);

        return $this->response->setJSON($response);
    }
}
