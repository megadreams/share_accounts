<?php
//Twitter用
class Lib_Tw_Strategy extends Lib_Strategy implements Lib_Strategy_Interface {
    
    public function get_user_profile_list($user_platform_id) {
        return $this->mongo_wrap->get_where('user_profile', array('user_twitter_id' => $user_platform_id));
    }
    
    public function get_friend() {
        return null;
    }
}
