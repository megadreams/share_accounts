<?php

namespace Fuel\Migrations;

class Create_lend_and_borrow
{
	public function up()
	{
		\DBUtil::create_table('lend_and_borrow', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'from_user_id' => array('constraint' => 11, 'type' => 'int', 'notnull' => true),
			'to_user_id' => array('constraint' => 11, 'type' => 'int', 'notnull' => true),
			'category_mst_id' => array('constraint' => 11, 'type' => 'int', 'notnull' => true),
			'item' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => true),
			'date' => array('constraint' => 11, 'type' => 'int', 'notnull' => true),
			'status' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => true),
			'memo' => array('constraint' => 255, 'type' => 'varchar'),
			'limit' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('lend_and_borrow');
	}
}