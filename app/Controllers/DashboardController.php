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

        /** Calcular o total de atividades do tipo Escalonamento Crise (controle) */
        $builder = $db->table('cire_backbone_atividades');
        $builder->like('tipo_atividade_id', 1);
        $total_escalonamento_crise = $builder->countAllResults();

        /** Calcular o total de atividades do tipo Escalonamento Urgente (controle) */
        $builder = $db->table('cire_backbone_atividades');
        $builder->like('tipo_atividade_id', 2);
        $total_escalonamento_urgente = $builder->countAllResults();

        /** Calcular o total de atividades do tipo Atualização Telegram (controle) */
        $builder = $db->table('cire_backbone_atualizacoes_telegram');
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

        return $this->response->setJSON($data);
    }
}
