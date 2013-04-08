<?php
//Facebook用
class Lib_Fb_Strategy extends Lib_Strategy implements Lib_Strategy_Interface {
    
    private $facebook;
    
    public function get_user_profile_list($user_platform_id) {
        return $this->mongo_wrap->get_where('user_profile', array('user_facebook_id' => $user_platform_id));
    }
    
    //友達リストを取得する
    public function get_friend() {
        return $this->facebook->api('/me/friends');
    }
    
    //OAuth開始
    public function start_oauth() {
        Package::load('facebook');
        $config = \Config::get('facebook');
        $this->facebook = new Facebook(array(
            'appId' => $config['APP_ID'],
            'secret' => $config['APP_SECRET']
        ));
        
        //ローカル用
        if (ENVIRONMENT === ENVIRONMENT_DEVELOPMENT) {
            $this->facebook = new Facebook(array(
                'appId' => '274598509250032',
                'secret' => '556cc187bdb89e7769d36eb8cca07bae'
            ));
        }

        //ログイン済みの場合は何もしない
        if ($this->facebook->getUser()) {
            try {
                //To Do
                //ここでFacebookのIDをShareのuser_idに変換してSessionに入れる
                return null;
            } catch(FacebookApiException $e) {
                //取得に失敗したら例外をキャッチしてエラーログに出力
                \Log::debug($e->getType());
                \Log::debug($e->getMessage());
            }
	}
        
        $user = $this->facebook->getUser();
        if (isset($user) === true) {
            //ログイン済みの場合は何もしない
            return null;
        } else {
            //未ログインならログイン URL を返す
            $loginUrl = $this->facebook->getLoginUrl();
            return $loginUrl;
        }
    }
}
