<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'cire_backbone_usuarios';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id', 'nome', 'password', 'nivel'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id' => 'required|is_unique[cire_backbone_usuarios.id]',
        'nome' => 'required',
        'nivel' => 'required',
    ];
    protected $validationMessages   = [
        'id' => [
            'required' => 'O campo RE é de preenchimento obrigatório',
            'is_unique' => 'Já consta usuário cadastrado com o RE informado',
        ],
        'nome' => [
            'required' => 'O campo nome é de preenchimento obrigatório',
        ],
        'nivel' => [
            'required' => 'O campo nível é de preenchimento obrigatório',
        ],
    ];
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
