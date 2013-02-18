<?php
use Orm\Model;

class Model_Lend_And_Borrow_Mst extends Model
{
//    	protected static $_belongs_to = array('user_profile');

	protected static $_properties = array(
		'id',
		'lend_user_id',
		'borrow_user_id',
		'money',
		'date',
		'status',
		'memo',
		'limit',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('lend_user_id', 'Lend User Id', 'required|valid_string[numeric]');
		$val->add_field('borrow_user_id', 'Borrow User Id', 'required|valid_string[numeric]');
		$val->add_field('money', 'Money', 'required|valid_string[numeric]');
		$val->add_field('date', 'Lend User Id', 'required|valid_string[numeric]');

		return $val;
	}

}
