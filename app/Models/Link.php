<?php

namespace App\Models;

use CodeIgniter\Model;

class Link extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'cire_backbone_links';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['titulo', 'link'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'titulo' => 'required|min_length[3]',
        'link' => 'required|min_length[3]',
    ];
    protected $validationMessages   = [
        'titulo' => [
            'required' => 'O campo título é de preenchimento obrigatório.',
            'min_length' => 'O campo título deve possuir no mínimo {param} caracteres.'
        ],
        'link' => [
            'required' => 'O campo link é de preenchimento obrigatório.',
            'min_length' => 'O campo link deve possuir no mínimo {param} caracteres.'
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
