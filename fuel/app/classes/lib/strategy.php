<?php

interface Lib_Strategy_Interface {
    public function get_user_profile_list($user_platform_id);
    public function get_friend();
    public function start_oauth();
}

class Lib_Strategy {
    
    protected $mongo_wrap;
    
    public function __construce() {
        $this->mongo_wrap = Lib_Mongowrap::getInstance();
    }
    
    public function get_user_profile_list($user_platform_id) {
        return null;
    }
    
    public function get_friend() {
        return null;
    }
    
    public function start_oauth() {
        return null;
    }
}
