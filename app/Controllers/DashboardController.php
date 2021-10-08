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

        $data = [
            'total_escalonamento_crise' => $total_escalonamento_crise,
            'total_escalonamento_urgente' => $total_escalonamento_urgente,
            'total_atualizacao_telegram' => $total_atualizacao_telegram,
            'total_atividades' => $total_atividades
        ];

        echo json_encode($data);
    }
}
