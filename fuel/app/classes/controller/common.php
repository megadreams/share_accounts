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
        $this->user_profile_id = \Session::get('user_id');
        if ($this->user_profile_id === null) {
            \Response::redirect('contents/auth/index');
        }
        $user_name = \Session::get('user_name');
                
        $lib_user_profile = new Lib_UserProfile();
        $this->user_profile = $lib_user_profile->createUserProfile($this->user_profile_id, $user_name);
        $this->model_wrap = new Lib_Modelwrap();
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

    //facebookから友達一覧を取得する
    public function getFacebookFriend() {
        $access_token = \Session::get('access_token');

        //アクセストークンが無ければ認証画面へ
        if ($access_token === null) {
            \Response::redirect('contents/auth/index');
        }
        
        //友達情報を取得する
        $user_friend = file_get_contents('https://graph.facebook.com/me/friends?locale=ja&' . $access_token);
        $user_friend_list = json_decode($user_friend);
        return $user_friend_list;
    }        
}