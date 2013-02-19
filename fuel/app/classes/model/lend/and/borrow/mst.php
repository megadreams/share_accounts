<?php
use Orm\Model;

class Model_Lend_And_Borrow_Mst extends Model
{
	public static $_table_name = "lend_and_borrow";
	protected static $_properties = array(
		'id',
		'from_user_id',
		'to_user_id',
		'category_mst_id',
		'item',
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
		$val->add_field('from_user_id', 'From User Id', 'required|valid_string[numeric]');
		$val->add_field('to_user_id', 'To User Id', 'required|valid_string[numeric]');
		$val->add_field('category_mst_id', 'Category Mst Id', 'required|valid_string[numeric]');
		$val->add_field('item', 'Item', 'required|max_length[255]');
		$val->add_field('date', 'Date', 'required|valid_string[numeric]');
		$val->add_field('status', 'Status', 'required|max_length[255]');
		$val->add_field('memo', 'Memo', 'required|max_length[255]');
		$val->add_field('limit', 'Limit', 'required|valid_string[numeric]');

		return $val;
	}

}
