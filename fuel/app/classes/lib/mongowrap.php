<?php

class Lib_Mongowrap {

    public static function getInstance($db_conf = array()) {
        if (self::validateConf($db_conf) !== true) {
                $db_conf = \Config::get('MONGODB');
        }
		
        return new Fuel\Core\Mongo_Db($db_conf);
    }
        
        
    //データからseq番号を取得する
    public static function get_seq_number($data_list) {
        foreach ($data_list as $data) {
            if (array_key_exists('seq', $data) === true) {
                return intval($data['seq']);
            }
        }
        return 0;
    }
    
    //データからMongo object idを取得する
    public static function get_mongo_id($data_list) {
        foreach ($data_list as $data) {
            if (array_key_exists('_id', $data) === true) {
                return $data['_id']->{'$id'};
            }
        }
        return null;
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
