<?php 


class Controller_Commonrest extends \Controller_Rest {
        
	protected $model_wrap;
	protected $lib_user_profile;

        public function before() {
            parent::before();    

            $this->model_wrap = new Lib_Modelwrap();

            $this->lib_user_profile = new Lib_UserProfile();

	}
}

