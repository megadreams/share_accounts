<?php

/*
 * @Contents
 */

namespace Contents;

class Controller_Auth extends \Controller_Commonlogin {
    
    public $callback_url;
    
    public function action_index() {
       $this->viewWrap('auth/top_view', 'ログイン画面');
    }
    
    public function action_login($_provider) {
        $login = \Config::get($_provider); 
        $authURL = 'http://www.facebook.com/dialog/oauth?client_id=' .
                $login['APP_ID'] . '&redirect_uri=' . urlencode(\Uri::base() . $login['CALLBACK'] . $_provider);
        \Response::redirect($authURL, 'location');
    }


    // Print the user credentials after the authentication. Use this information as you need. (Log in, registrer, ...)
    public function action_callback($_provider = null) {
        $login = \Config::get($_provider);
        
        $code = $_REQUEST['code'];

        $token_url = 'https://graph.facebook.com/oauth/access_token?client_id='.
            $login['APP_ID'] . '&redirect_uri=' . urlencode(\Uri::base() . $login['CALLBACK'] . $_provider) . '&client_secret='.
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
            $user_profile = $this->lib_userprofile->add_fb_user($this->model_wrap, $user_id, $name);
        } else {
             //情報を取得する
            $user_profile = $this->model_wrap->call('Model_User_Profile', 'find', 'first', array(
                'where' => array(
                    'user_facebook_id' => $user_facebook->id
                )
            )); 
        }
        //トーク−ンの発行
/*        
        $session_id = (int)time() . rand(1,99999);
        $insert_data = array(
            'session_id'      => $session_id,
            'user_profile_id' => $user_profile->id
        );
        $token_table = $this->model_wrap->getModelInstance('Model_Token', $insert_data);
        $token_table->save();
        \Session::set('token_id', $token_table->id);
  */      
 
        \Session::set('user_profile_id', $user_profile->id);
        \Session::set('user_name', $user_profile->user_name);
        \Session::set('access_token', $access_token);
        
        \Response::redirect('contents/top');

    }
 
    
    
    public function action_logout() {
        $access_token = \Session::get('access_token');

        $return = \Config::get('BASE_URL') . 'contents/top/';
        
        if ($access_token !== null) {
            $URL = 'https://www.facebook.com/logout.php' . '?next=REDIRECT&confirm=0&url='.$return . '&' . $access_token;
        }
/*        
        $token_id = \Session::get('token_id');
        $sql = "DELETE token where id = " . $token_id;
        $this->model_wrap->call('DB','query',$sql);        
        \Session::delete('token_id');
 */

        \Session::delete('user_profile_id');
        \Session::delete('user_name');
        \Session::delete('access_token');

        \Response::redirect(\Uri::base(), 'location');            
    }

}