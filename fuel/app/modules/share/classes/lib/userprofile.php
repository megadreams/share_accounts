<?php

namespace Share;

class Lib_Userprofile {
    public $user_id;
    public $mongo_wrap;
        
    public function __construct($mongo_wrap) {
        $this->mongo_wrap = $mongo_wrap;
        $this->user_id    = 0;
        $this->user_name  = "";
    }
    public function model_user_profile() {
        $user = array();
        $user['user_facebook_id'] = null;
        $user['user_name']        = null;
        $user['user_line_id']     = null;
        $user['user_twitter_id']  = null;
        return $user;
    }
    public function get_user_profile ($user_id) {
        $this->user_id = (int)$user_id;
        $user_profile = $this->mongo_wrap->where(array('user_id' => (int)$user_id))->get_one('user_profile');
        return $user_profile;
    }

    
    public function get_user_friends() {
        $frind_list = $this->mongo_wrap->where(array('user_id' => (int)$this->user_id))->get('user_friends');
        $user_frinend_ids = array();
        foreach ($frind_list as $friend) {
            $user_frinend_ids[] = $friend['friend_user_id'];
        }
        $friend_user =  $this->mongo_wrap->where_in('user_id', $user_frinend_ids)->get('user_profile');
        
        $frend_list = array();
        foreach ($friend_user as $datas) {
            $frend_list[$datas['user_id']] = $datas;
        }
        return $frend_list;
    }
    
    /**
     * 友達のユーザ情報の新規追加やチェックを行う所
     */
    public function get_user_profile_id($target_user_id, $target_user_name, $friend_type) {
        //既にユーザが登録されているか？
        if ($friend_type === 'facebook') {
            $target = 'user_facebook_id';
        }
        $target_user = $this->mongo_wrap->where(array($target => $target_user_id))->get_one('user_profile');
        if (empty($target_user)) {
            $insert_data = $this->model_user_profile();
            $insert_data[$target]     = $target_user_id;
            $insert_data['user_name'] = $target_user_name;
            
            \Lib_Mongowrap::insert_data('user_profile', $insert_data);       
            $target_user = $this->mongo_wrap->where(array($target => $target_user_id))->get_one('user_profile');
        }
        
        return $target_user['user_id'];
    }
    
    public function create_user_friend($my_user_id, $to_user_id) {
        $user_friend =  $this->mongo_wrap->where(array(
                            'user_id'        => (int)$my_user_id,
                            'friend_user_id' => (int)$to_user_id,
                           ))->get_one('user_friends');
        if (empty($user_friend)) {
            $insert_data = array(
                'user_id'        => (int)$my_user_id,
                'friend_user_id' => (int)$to_user_id,                
            );
            $insert_data2 = array(
                'user_id'        => (int)$to_user_id,
                'friend_user_id' => (int)$my_user_id,
            );
            
            \Lib_Mongowrap::insert_data('user_friends', $insert_data);
            \Lib_Mongowrap::insert_data('user_friends', $insert_data2);

            $user_friend =  $this->mongo_wrap->where(array(
                                'user_id'        => (int)$my_user_id,
                                'friend_user_id' => (int)$to_user_id,
                               ))->get_one('user_friends');
        }        
        return $user_friend;        
    }
    
    
}

