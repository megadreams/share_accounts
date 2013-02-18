<?php

namespace Fuel\Migrations;

class Create_demo_scaffolds
{
	public function up()
	{
		\DBUtil::create_table('demo_scaffolds', array(
			'title' => array('constraint' => 50, 'type' => 'varchar'),
			'content' => array('type' => 'text'),
			'id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('demo_scaffolds');
	}
}