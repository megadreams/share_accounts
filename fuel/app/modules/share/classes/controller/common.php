<?php

namespace Share;

class Controller_Common extends \Controller_Template {

    //追加で読み込むCSSファイル群(静的ファイル)
    protected $plus_css;
    //追加で読み込むJavaScriptファイル群(静的ファイル)
    protected $plus_js;

    protected $context;


    protected $view_data;
    
    protected $lib_userprofile;
    
    protected $lib_lendandborrow;
    
    protected $util;
    
    protected $mongo_wrap;

    protected $rest_url_list;
        
    public function before() {
        //親クラスのbeforeを呼び出して, $this->templateを使えるようにしてもらう
        $this->template = "share_template";
        parent::before();
/*
        $this->user_profile_id = \Session::get('user_profile_id');
        if ($this->user_profile_id === null) {
            \Response::redirect('contents/auth/index');
        }
        $user_name = \Session::get('user_name'); 
*/ 
        $user_profile_id = 1;
        
        $this->mongo_wrap = \Lib_Mongowrap::getInstance();
        $this->rest_url_list = \Config::get('rest_list');
        
        $this->lib_userprofile = new Lib_Userprofile($this->mongo_wrap);
        $this->view_data['user_profile'] =  $this->lib_userprofile->get_user_profile($user_profile_id);
        
        
        $this->lib_lendandborrow = new Lib_Lendandborrow($this->mongo_wrap);
    }


    public function after($response) {
        //親クラスのafterを呼び出して, responseインスタンスをもらう
        parent::after($response);
        $response = parent::after($response);
        return $response;
    }
    
    public function viewWrap($path = null, $title = '貸し借り管理') {        
        $this->template->content = \View::forge($path,  array('view_data' => $this->view_data, 'title' => $title));
        
    }

    protected function request($url) {
        $res = \Request::forge($url)->execute()->response();
        return $res->body;
    }
    
    

}