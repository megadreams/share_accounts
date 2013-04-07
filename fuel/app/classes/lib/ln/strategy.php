<?php
//LINE用
class Lib_Ln_Strategy extends Lib_Strategy implements Lib_Strategy_Interface {
    
    public function get_user_profile_list($user_platform_id) {
        return $this->mongo_wrap->get_where('user_profile', array('user_line_id' => $user_platform_id));
    }
    
    public function get_friend() {
        return null;
    }
}
