<?php

namespace Share;

class Controller_Common extends \Controller_Template {

    //追加で読み込むCSSファイル群(静的ファイル)
    protected $plus_css;
    //追加で読み込むJavaScriptファイル群(静的ファイル)
    protected $plus_js;

    protected $context;


    protected $view_data;
    
    protected $user_profile;
        
    protected $util;
    
    protected $mongo_wrap;

    protected $rest_url_list;
        
    public function before() {
        //親クラスのbeforeを呼び出して, $this->templateを使えるようにしてもらう
        $this->template = "share_template";
        parent::before();
        //ログインしているかのチェック
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
        
        $this->user_profile = new \StdClass();
        $this->user_profile->id = 1;
        $this->user_profile->name = "めがりょう";
    }


    public function after($response) {
        //親クラスのafterを呼び出して, responseインスタンスをもらう
        parent::after($response);
        $response = parent::after($response);
        return $response;
    }
    
    protected function viewWrap($path = null, $title = '貸し借り管理') {        
        //ユーザ本人の情報を取得
        $this->view_data['user_profile'] = $this->user_profile;
        $this->template->content = \View::forge($path,  array('view_data' => $this->view_data, 'title' => $title));
        
    }

    protected function request($url) {
        $res = \Request::forge($url)->execute()->response();
        return $res->body;
    }
    
    

}