<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCireBackboneAvisos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nome_usuario_criacao' => [
                'type' => 'VARCHAR',
                'constraint' => 120
            ],
            'nome_usuario_edicao' => [
                'type' => 'VARCHAR',
                'constraint' => 120
            ],
            'descricao'          => [
                'type' => 'TEXT',
            ],
            'prioridade' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'fixado' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
                'default' => null,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => null,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'default' => null,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('cire_backbone_avisos');
    }

    public function down()
    {
        $this->forge->dropTable('cire_backbone_avisos');
    }
}
