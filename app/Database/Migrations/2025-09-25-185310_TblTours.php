<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblTours extends Migration
{
     public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'category' => ['type' => 'ENUM', 'constraint' => ['Safari', 'Kilimanjaro', 'Zanzibar', 'Cultural'], 'default' => 'Safari'],
            'description' => ['type' => 'TEXT'],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'itinerary' => ['type' => 'TEXT'],
            'image' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'duration' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'max_people' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'), 'extra' => 'ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tours');

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'review_text' => ['type' => 'TEXT'],
            'rating' => ['type' => 'INT', 'constraint' => 1],
            'date' => ['type' => 'DATE'],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('reviews');
    }

    public function down()
    {
        $this->forge->dropTable('tours');
        $this->forge->dropTable('reviews');
    }
}
