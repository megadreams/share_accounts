<?php

namespace Fuel\Migrations;

class Create_user_profiels
{
	public function up()
	{
		\DBUtil::create_table('user_profiels', array(
			'id' => array('constraint' => 11, 'type' => 'int'),
			'user_name' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('user_profiels');
	}
}