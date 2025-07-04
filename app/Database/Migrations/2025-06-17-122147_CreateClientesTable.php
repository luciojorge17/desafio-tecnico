<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'nome' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
        ],
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
        ],
        'telefone' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
        ],
        'foto' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
