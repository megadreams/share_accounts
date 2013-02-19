<?php

namespace Fuel\Migrations;

class Create_user_profile
{
	public function up()
	{
		\DBUtil::create_table('user_profile', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_name' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => true),
			'user_facebook_id' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => false),
			'user_line_id' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => false),
			'user_twitter_id' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => false),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('user_profile');
	}
}