<?php

namespace Share;

class Controller_Common extends \Controller_Template {

    //追加で読み込むCSSファイル群(静的ファイル)
    protected $plus_css;
    //追加で読み込むJavaScriptファイル群(静的ファイル)
    protected $plus_js;

    protected $context;

    protected $seg;
    protected $view_data;
    
    protected $lib_userprofile;
    
    protected $lib_lendandborrow;
    
    protected $util;
    
    protected $mongo_wrap;

    protected $rest_url_list;
        
    public function before() {
        //親クラスのbeforeを呼び出して, $this->templateを使えるようにしてもらう
        $this->seg = \Uri::segments();
        if (in_array('top', $this->seg)) {
            $this->template = "share_top_template";
        } else {
            $this->template = "share_other_template";
        }
        
        parent::before();
        $this->mongo_wrap = \Lib_Mongowrap::getInstance();
        
        if (in_array('auth', $this->seg)) {
            return ;
        }

        //認証チェック
        $this->user_profile_id = \Session::get('user_id');
        if ($this->user_profile_id === null) {
            \Response::redirect('share/auth/index');
        }
        
        $this->rest_url_list = \Config::get('rest_list');

        //ユーザ情報の作成
        $this->lib_userprofile = new Lib_Userprofile($this->mongo_wrap);
        $this->view_data['user_profile'] =  $this->lib_userprofile->get_user_profile($this->user_profile_id);
        
        if (empty($this->view_data['user_profile'])) {
            \Response::redirect('share/auth/index');            
        }
        
        //貸し借り管理関係ライブラリ
        $this->lib_lendandborrow = new Lib_Lendandborrow($this->mongo_wrap);
          
        
    }


    public function after($response) {
        //親クラスのafterを呼び出して, responseインスタンスをもらう
        parent::after($response);
        $response = parent::after($response);
        return $response;
    }
    
    public function viewWrap($path = null, $title = '貸し借り管理') {        
        $this->template->content   = \View::forge($path,  array('view_data' => $this->view_data, 'title' => $title));
        $this->template->header  = \View::forge('inc/header',  array('view_data' => null));
        
        //左サイドメニュ
        $this->template->leftmenu  = \View::forge('inc/leftmenu',  array('view_data' => $this->view_data));
        $this->template->rightmenu = \View::forge('inc/rightmenu',  array('view_data' => null));
        
    }

    protected function request($url) {
        $res = \Request::forge($url)->execute()->response();
        return $res->body;
    }
    
    

}