<?php

namespace Share;

class Lib_Userprofile {
    public $user_id;
    public $name;
    
    public function __construct($user_id) {
        $this->user_id = $user_id;
        $this->name    = 'めがりょう';
    }
}

