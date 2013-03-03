<?php 


class Controller_Commonlogin extends \Controller_Template {

        
    protected $model_wrap;
    protected $view_data;
    protected $lib_userprofile;
    
    
    public function before() {
        parent::before();

        $this->model_wrap      = new Lib_Modelwrap();
        $this->lib_userprofile = new Lib_UserProfile();
    }
    
     protected function viewWrap($path = null, $title = '大感謝祭') {        
        //Viewのtemplate.phpにそれぞれ渡す
        
        $this->template->content = \View::forge($path,  array('view_data' => $this->view_data, 'title' => $title));
    }
        
}

