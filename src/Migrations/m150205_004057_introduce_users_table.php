<?php

class m150205_004057_introduce_users_table extends CDbMigration
{
	private $tableName = 'users';
	public function up()
	{
		$this->createTable(
			$this->tableName,
			array(
				'id' => 'pk',
				'login' => 'VARCHAR(64)',
				'password' => 'VARCHAR(256)',
			)
		);
	}

	public function down()
	{
		$this->dropTable($this->tableName);
	}
}
