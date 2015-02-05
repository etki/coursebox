<?php

class m150205_004257_introduce_posts_table extends CDbMigration
{
	private $tableName = 'posts';
	public function up()
	{
		$this->createTable(
			$this->tableName,
			array(
				'id' => 'pk',
				'title' => 'VARCHAR(64) NOT NULL',
				'content' => 'TEXT NOT NULL',
				'user_id' => 'INTEGER NOT NULL',
			)
		);
	}

	public function down()
	{
		$this->dropTable($this->tableName);
	}
}