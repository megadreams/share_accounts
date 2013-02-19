<?php

namespace Fuel\Migrations;

class Create_category_mst
{
	public function up()
	{
		\DBUtil::create_table('category_mst', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'category_name' => array('constraint' => 255, 'type' => 'varchar', 'notnull' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('category_mst');
	}
}