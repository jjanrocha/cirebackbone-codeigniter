<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Atividade;
use App\Models\AtualizacaoTelegram;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('app/dashboard', [
            'title' => 'Dashboard',
        ]);
    }

    public function dadosGraficoGeral()
    {
        $db      = \Config\Database::connect();

        $data_inicio_geral = isset($_POST['data_inicio_geral']) ? $_POST['data_inicio_geral'] : '2021-01-01';
        $data_fim_geral = isset($_POST['data_fim_geral']) ? $_POST['data_fim_geral'] : '2021-12-31';
        //$data_fim_geral = isset($_POST['data_fim_geral']) ? $_POST['data_fim_geral'] : date("Y-m-d");

        /** Calcular o total de atividades do tipo Escalonamento Crise (controle) */
        $builder = $db->table('cire_backbone_atividades');
        $builder->where('tipo_atividade_id', 1);
        $builder->where('left(data_hora, 10) >=', $data_inicio_geral);
        $builder->where('left(data_hora, 10) <=', $data_fim_geral);
        $total_escalonamento_crise = $builder->countAllResults();

        /** Calcular o total de atividades do tipo Escalonamento Urgente (controle) */
        $builder = $db->table('cire_backbone_atividades');
        $builder->where('tipo_atividade_id', 2);
        $builder->where('left(data_hora, 10) >=', $data_inicio_geral);
        $builder->where('left(data_hora, 10) <=', $data_fim_geral);
        $total_escalonamento_urgente = $builder->countAllResults();

        /** Calcular o total de atividades do tipo Atualização Telegram (controle) */
        $builder = $db->table('cire_backbone_atualizacoes_telegram');
        $builder->where('left(data_hora, 10) >=', $data_inicio_geral);
        $builder->where('left(data_hora, 10) <=', $data_fim_geral);
        $total_atualizacao_telegram = $builder->countAllResults();

        /** Total de registros (todas as atividades) */
        $total_atividades = $total_escalonamento_crise + $total_escalonamento_urgente + $total_atualizacao_telegram;

        $data['cols'] = [
            array('id' => '', 'label' => 'Topping', 'pattern' => "", 'type' => "string"),
            array('id' => '', 'label' => 'Slices', 'pattern' => "", 'type' => "number")
        ];

        $data['rows'] = [
            array('c' => [
                array('v' => 'Escalonamento Crise', 'f' => null), array('v' => $total_escalonamento_crise, 'f' => null)
            ]),
            array('c' => [
                array('v' => 'Escalonamento Urgente', 'f' => null), array('v' => $total_escalonamento_urgente, 'f' => null)
            ]),
            array('c' => [
                array('v' => 'Atualização Telegram', 'f' => null), array('v' => $total_atualizacao_telegram, 'f' => null)
            ])
        ];

        $data['total_atividades'] = $total_atividades;
        $data['data_inicio'] = $data_inicio_geral;
        $data['data_fim'] = $data_fim_geral;

        return $this->response->setJSON($data);
    }
}
