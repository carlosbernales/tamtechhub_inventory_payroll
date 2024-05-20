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
            'fk_user_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'order_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00
            ],
            'order_date' => [
                'type' => 'DATETIME',
            ],
            'image' => [
                'type'       => 'text',
                'null' => false,
            ],
            'order_type' => [
                'type' => 'ENUM("Online", "COD")',
                'default' => "COD",
                'null' => false,
            ],
            'order_status' => [
                'type'       => 'ENUM("Pending", "Accepted", "Out_for_delivery", "Delivered")',
                'default' => "Pending",
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('order');
    }

    public function down()
    {
        $this->forge->dropTable('order');
    }
}