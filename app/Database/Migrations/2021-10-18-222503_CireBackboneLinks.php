<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CireBackboneLinks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'link' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cire_backbone_links');
    }

    public function down()
    {
        $this->forge->dropTable('cire_backbone_links');
    }
}
