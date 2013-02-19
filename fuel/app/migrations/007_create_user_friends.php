<?php

namespace Fuel\Migrations;

class Create_user_friends
{
	public function up()
	{
		\DBUtil::create_table('user_friends', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_profile_id' => array('constraint' => 11, 'type' => 'int', 'notnull' => true),
			'friend_user_id' => array('constraint' => 11, 'type' => 'int', 'notnull' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('user_friends');
	}
}