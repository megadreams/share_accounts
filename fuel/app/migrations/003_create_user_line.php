<?php

namespace Fuel\Migrations;

class Create_user_line
{
	public function up()
	{
		\DBUtil::create_table('user_line', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'line_id' => array('constraint' => 255, 'type' => 'varchar'),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('user_line');
	}
}