<?php

class Lib_Userprofile {

    public function create_user_instance($model_wrap, $user_id = null, $user_name = null) {
        $user_profile = new stdClass();
        $user_profile->id = $user_id;
        $user_profile->user_name = $user_name;
        return $user_profile;
    }

    /*
     * Facebookのユーザ情報を登録する
     */

    public function add_fb_user($model_wrap, $fb_id, $fb_name) {
        $insert_data = array(
            'fb_id' => $fb_id,
            'name' => $fb_name
        );

        $user_facebook = $model_wrap->getModelInstance('Model_User_Facebook', $insert_data);

        try {
            \DB::start_transaction();
            //DB登録
            $user_facebook->save();
            $user_profile = $model_wrap->getModelInstance('Model_User_Profile', array(
                'user_name' => $user_facebook->name,
                'user_facebook_id' => $user_facebook->id
                    ));
            $user_profile->save();
            \DB::commit_transaction();
        } catch (Exception $e) {
            \DB::rollback_transaction();
//            \Log::debug($e->getMessage());
            return false;
        }
        return $user_profile;
    }

    
    //===========================
    //      以下Mongo用
    //===========================
    
    /**
     * Mongoにユーザー情報を保存する
     * @param type $user_array
     * $user_array(
     *       'user_facebook_id' => 'ID',
     *       'user_line_id' => 'ID',
     *       'user_twitter_id' => 'ID'
     * )
     */
    public function save_user_profile($user_array = array()) {
        $mongo_wrap = Lib_Mongowrap::getInstance();

        //auto increment用のデータ取得
        $user_profile_count_list = $mongo_wrap->get_where('user_profile_count');
        $user_profile_seq = Lib_Mongowrap::get_seq_number($user_profile_count_list);
        $user_profile_count_object_id = Lib_Mongowrap::get_mongo_id($user_profile_count_list);

        //user_profileの追加
        $insert_user_profile = $this->set_user_profile_data($user_array);
        $insert_user_profile['user_id'] = $user_profile_seq;
        $mongo_wrap->insert('user_profile', $insert_user_profile);

        //auto incrementを1増加させる
        $new_user_profile_count = array(
            'seq' => $user_profile_seq + 1
        );
        
        //auto incrementを保存
        $mongo_wrap->where(array('_id' => new MongoId($user_profile_count_object_id),))
                ->update('user_profile_count', $new_user_profile_count);
    }

    
    /**
     * user_profile insertする時のデフォルト値
     * @param type $user_array 追加するユーザー情報
     * array(
     *      'user_facebook_id' => 'ID',
     *      'user_line_id' => 'ID',
     *      'user_twitter_id' => 'ID'
     * )
     * このうちどれかあればいい
     * @return type 追加するユーザー情報
     */
    private function set_user_profile_data($user_array) {
        $ret = array();

        $key_list = \Config::get('user_profile_keys');

        foreach ($key_list as $key) {
            if (isset($user_array[$key]) !== true) {
                $ret[$key] = '';
            } else {
                $ret[$key] = $user_array[$key];
            }
        }
        $ret['updated_at'] = strtotime('now');
        $ret['created_at'] = strtotime('now');
        return $ret;
    }

    
    /**
     * ユーザー情報を更新する
     * @param type $where_key
     * updateするユーザーを抽出するためのplatform名 => 'ID'
     * もしくはuser_id => 'ID'
     * $where_key = array(
     *       'user_facebook_id' => 'ID'
     * )
     * 
     * @param type $update_user_data
     * //updateするユーザーのデータ(追加するIDのみ)
     * $update_user_data = array(
     *       'user_twitter_id' => 'ID'
     * )
     */
    public function update_user_profile($where_key, $update_user_data) {
        $mongo_wrap = Lib_Mongowrap::getInstance();
        
        $update_user_data['updated_at'] = strtotime('now');
        $mongo_wrap->where($where_key)->update('user_profile', $update_user_data);
    }

}