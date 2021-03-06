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
    public function get_user_profile ($user_id) {
        $this->user_id = $user_id;
        $user_profile = $this->mongo_wrap->where(array('user_id' => (int)$user_id))->get_one('user_profile');
        return $user_profile;
    }

    
    public function get_user_friends() {
        $frind_list = $this->mongo_wrap->get_where('user_friends', array('user_id' => (int)$this->user_id));
        $user_frinend_ids = array();
        foreach ($frind_list as $friend) {
            $user_frinend_ids[] = $friend['frined_user_id'];    
        }
        
        return $this->mongo_wrap->where_in('user_id', $user_frinend_ids)->get('user_profile');
        
    }
}

