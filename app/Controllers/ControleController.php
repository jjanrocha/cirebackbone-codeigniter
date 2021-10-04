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
