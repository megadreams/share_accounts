<?php

/*
 * @Contents
 */

namespace Contents;

class Controller_Auth extends \Controller_Commonlogin {
    
    
    public function action_index() {
       $this->viewContent('auth/top_view', 'ログイン画面');
    }
    
    public function action_login($_provider = null) {

        $login = \Config::get($_provider);
        $authURL = 'http://www.facebook.com/dialog/oauth?client_id=' . 
                $login['APP_ID'] . '&redirect_uri=' . urlencode($login['CALLBACK']);
        \Response::redirect($authURL, 'location');
    }
    
    // Print the user credentials after the authentication. Use this information as you need. (Log in, registrer, ...)
    public function action_callback($_provider = null) {
        $login = \Config::get($_provider);
        
        $code = $_REQUEST['code'];

        $token_url = 'https://graph.facebook.com/oauth/access_token?client_id='.
            $login['APP_ID'] . '&redirect_uri=' . urlencode($login['CALLBACK']) . '&client_secret='.
            $login['APP_SECRET'] . '&code=' . $code;

        // access token 取得
        $access_token = file_get_contents($token_url);
        
        
        // ユーザ情報json取得してdecode
        $user_json = file_get_contents('https://graph.facebook.com/me?' . $access_token);
        $user = json_decode($user_json);

        // facebook の user_id + name(表示名)をセット
        $user_id = $user->id;
        $name    = $user->name;

        $user_facebook = $this->model_wrap->call('Model_User_Facebook', 'find', 'first', array(
            'where' => array(
                'fb_id' => $user_id
            )
        ));
        // 初回ユーザかチェックするロジック
        if($user_facebook === null){
            $user_profile = $this->lib_user_profile->addFbUserProfile($this->model_wrap, $user_id, $name);;
            
        } else {
             //情報を取得する
            $user_profile = $this->model_wrap->call('Model_User_Profiel', 'find', 'first', array(
                'where' => array(
                    'user_facebook_id' => $user_facebook->id
                )
            )); 
        }
                
        \Session::set('user_id', $user_profile->id);
        \Session::set('user_name', $user_profile->user_name);
        \Session::set('access_token', $access_token);
        
        
        \Response::redirect('contents/top');

    }
    
    public function action_logout() {
        $access_token = \Session::get('access_token');

        $return = \Config::get('BASE_URL') . 'contents/top/';
        
        if ($access_token !== null) {
            $URL = 'https://www.facebook.com/logout.php' . '?next=REDIRECT&confirm=0&url='.$return . '&' . $access_token;
        } else {
            $URL = $next;
        }
        
        \Session::delete('user_id');
        \Session::delete('user_name');
        \Session::delete('access_token');
        \Session::delete('id');
        \Response::redirect($URL, 'location');
            
    }

}