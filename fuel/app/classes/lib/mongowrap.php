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
    
    /*
     * auto_incrementを使用してデータをインサートする場合
     * 
     * @param type $collection_name
     * @param array $insert_data
     */
    public function insert_data($collection_name, $insert_data = array()) {
        $mongo_wrap = \Lib_Mongowrap::getInstance();
        
        //auto increment用のデータ取得
        $pre_increment_count = $mongo_wrap->get_where($collection_name . '_count');
        $seq_number = \Lib_Mongowrap::get_seq_number($pre_increment_count);
        
        $lend_and_borrow_obj_id = \Lib_Mongowrap::get_mongo_id($pre_increment_count);
    
        $insert_data['id'] = $seq_number;

        //auto incrementを1増加させる
        $new_increment_count = array(
            'seq' => $seq_number + 1
        );

        //保存処理
        $mongo_wrap->insert($collection_name, $insert_data);
        $mongo_wrap->where(array('_id' => new MongoId($lend_and_borrow_obj_id),))
                ->update($collection_name . '_count', $new_increment_count);
    }     

}
