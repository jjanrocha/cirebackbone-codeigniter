<?php

namespace App\Models;

use CodeIgniter\Model;

class AtualizacaoTelegram extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'cire_backbone_atualizacoes_telegram';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'numero_ta',
        'usuario_id',
        'data_hora',
        'tipo_bilhete',
        'rota_ponta_a',
        'rota_ponta_b',
        'trecho_ponta_a',
        'trecho_ponta_b',
        'possui_draco',
        'equipamentos_v1',
        'equipamentos_v2',
        'redundancias_v2',
        'operadoras',
        'afetacao_erbs',
        'afetacao_voz',
        'afetacao_speedy',
        'afetacao_clientes',
        'afetacao_fttx',
        'afetacao_iptv',
        'lp',
        'horario_acionamento',
        'ttmc_numero',
        'ttmc_tipo',
        'ttmc_rede',
        'status',
        'escalonamento'
    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
}
