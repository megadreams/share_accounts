<?php 


class Controller_Commonrest extends \Controller_Rest {
        
    protected $model_wrap;
    protected $lib_userprofile;
    protected $lib_friends;
        
    public function before() {
        parent::before();    

        $this->model_wrap       = new Lib_Modelwrap();
        $this->lib_userprofile = new Lib_UserProfile();
        $this->lib_friends          = new Lib_Friends();
    }
    
    
    
}

