<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Noticias extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'description' => [
				'type' => 'text',
				'null' => TRUE,
			],
			'autor' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => TRUE,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => TRUE,
			],
			'deleted_at' => [
				'type' => 'DATETIME',
				'null' => TRUE,
			],
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('noticias');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('noticias');
	}
}
