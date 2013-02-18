<?php

namespace Fuel\Migrations;

class Create_lend_and_borrow_msts
{
	public function up()
	{
		\DBUtil::create_table('lend_and_borrow_msts', array(
			'id' => array('constraint' => 11, 'type' => 'int'),
			'date' => array('constraint' => 11, 'type' => 'int'),
			'lend_user_id' => array('constraint' => 11, 'type' => 'int'),
			'borrow_user_id' => array('constraint' => 11, 'type' => 'int'),
			'money' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('lend_and_borrow_msts');
	}
}