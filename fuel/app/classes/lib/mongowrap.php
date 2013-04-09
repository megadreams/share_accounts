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
     * auto_incrementを使用して新規にデータをインサートする場合
     * 
     * @param type $collection_name
     * @param array $insert_data
     */
    public static function insert_data($collection_name, $insert_data = array()) {
        $mongo_wrap = self::getInstance();
        
        //auto increment用のデータ取得
        $pre_increment_count = $mongo_wrap->get_where($collection_name . '_count');
        $seq_number = self::get_seq_number($pre_increment_count);
        $lend_and_borrow_obj_id = self::get_mongo_id($pre_increment_count);

        if ($collection_name === 'user_profile') {
            $insert_data['user_id'] = $seq_number;            
        } else {
            $insert_data['collection_id'] = $seq_number;
        }
        $insert_data['created_at'] = time();
        $insert_data['updated_at'] = time();
        
        //auto incrementを1増加させる
        $new_increment_count = array(
            'seq' => $seq_number + 1
        );

        //保存処理
        try {
            $mongo_wrap->insert($collection_name, $insert_data);
            $mongo_wrap->where(array('_id' => new MongoId($lend_and_borrow_obj_id),))
                    ->update($collection_name . '_count', $new_increment_count);
        } catch (MongoConnectionException $e) {
            //ログ
            exit();            
        } catch (MongoException $e) {
            die('Error: ' . $e->getMessage());
            //ログ
            exit();
        }
    }
    
    /**
     * Update
     */
    public static function update_data($collection_name, $insert_collection) {
        $mongo_wrap = self::getInstance();
        $_id = $insert_collection['_id']->{'$id'};

        //updateは_idが無く、配列で渡さなければいけない
        $insert_arrya = array();
        foreach ($insert_collection as $key => $data) {
            if ($key === '_id') continue;
            $insert_arrya[$key] = $data;
        }
        $insert_arrya['updated_at'] = time();
        try {
            $mongo_wrap->where(array('_id' => new MongoId($_id),))
                    ->update($collection_name, $insert_arrya);  
        } catch (MongoConnectionException $e) {
            //ログ
            exit();            
        } catch (MongoException $e) {
            die('Error: ' . $e->getMessage());
            //ログ
            exit();
        }
    }
}
