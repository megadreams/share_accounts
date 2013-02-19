<?php

namespace Fuel\Migrations;

class Create_token
{
	public function up()
	{
		\DBUtil::create_table('token', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'session_id' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => true),
			'user_profile_id' => array('constraint' => 11, 'type' => 'int', 'notnull' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('token');
	}
}