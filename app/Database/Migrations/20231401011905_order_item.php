<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class Admins extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'fk_order_id' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'item_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00
            ],
            'item_qty' => [
                'type'       => 'INT',
                'null' => false,
            ],
            'order_date' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('order_item');
    }

    public function down()
    {
        $this->forge->dropTable('order_item');
    }
}