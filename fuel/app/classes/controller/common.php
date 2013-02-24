<?php


class Controller_Common extends \Controller_Template {

    //追加で読み込むCSSファイル群(静的ファイル)
    protected $plus_css;
    //追加で読み込むJavaScriptファイル群(静的ファイル)
    protected $plus_js;

    protected $context;

    protected $model_wrap;

    protected $view_data;
    
    protected $user_profile;
    
    protected $user_profile_id;

        
        
    public function before() {
        //親クラスのbeforeを呼び出して, $this->templateを使えるようにしてもらう
        parent::before();
        //ログインしているかのチェック
        $this->user_profile_id = \Session::get('user_profile_id');
//        $this->user_profile_id = 1;
        if ($this->user_profile_id === null) {
            \Response::redirect('contents/auth/index');
        }
        $user_name = \Session::get('user_name'); 
        
        $this->model_wrap = new Lib_Modelwrap();

        
        $lib_user_profile = new Lib_UserProfile();
        $this->user_profile = $lib_user_profile->create_user_instance($this->model_wrap, $this->user_profile_id, $user_name);
        
    }


    public function after($response) {
        //親クラスのafterを呼び出して, responseインスタンスをもらう
        parent::after($response);
        $response = parent::after($response);
        return $response;
    }
    
     protected function viewContent($path = null, $title = '大感謝祭') {        
        //Viewのtemplate.phpにそれぞれ渡す

        //ユーザ本人の情報を取得
        $this->view_data['user_profile'] = $this->user_profile;
        
        $this->template->content = \View::forge($path,  array('view_data' => $this->view_data, 'title' => $title));
        
    }

    
    

}