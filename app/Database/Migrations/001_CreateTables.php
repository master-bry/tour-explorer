<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'category' => ['type' => 'ENUM("Safari", "Kilimanjaro")'],
            'description' => ['type' => 'TEXT'],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'itinerary' => ['type' => 'TEXT'],
            'image' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tours');
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'review_text' => ['type' => 'TEXT'],
            'rating' => ['type' => 'INT', 'constraint' => 5],
            'date' => ['type' => 'DATE'],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('reviews');
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'ENUM("user", "admin")', 'default' => 'user'],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }
    public function down()
    {
        $this->forge->dropTable('tours');
        $this->forge->dropTable('reviews');
        $this->forge->dropTable('users');
    }
}