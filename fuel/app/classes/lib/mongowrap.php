<?php

class Lib_Mongowrap {

	public static function getInstance($db_conf = array()) {
		if (self::validateConf($db_conf) !== true) {
			$db_conf = \Config::get('MONGODB');
		}
		
		return new Fuel\Core\Mongo_Db($db_conf);
	}
	
	
	private static function validateConf($config = array()) {
		if (empty($config['hostname']) !== false) {
			return false;
		}

		if (empty($config['database'])!== false) {
			return false;
		}

		if (empty($config['username']) !== false) {
			return false;
		}
		
		if (empty($config['password']) !== false) {
			return false;
		}

		if (isset($config['port']) !== true || empty($config['port']) !== false) {
			return false;
		}
		return true;
	}

}
