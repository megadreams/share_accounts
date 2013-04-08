<?php 

namespace Share;

class Controller_Rest_Commonrest extends \Controller_Rest {
        
    protected $mongo_wrap;
        
    public function before() {
        parent::before();
        $this->mongo_wrap = \Lib_Mongowrap::getInstance();
    }
    
    
    
}

