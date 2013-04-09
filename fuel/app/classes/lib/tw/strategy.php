<?php
//Twitter用
class Lib_Tw_Strategy extends Lib_Strategy implements Lib_Strategy_Interface {

    private $config;
    public function __construct() {
        Package::load('twitter');
        parent::__construct();
        $this->config = \Config::get('twitter');
    }

    public function get_user_profile_list($user_platform_id) {
        return $this->mongo_wrap->get_where('user_profile', array('user_twitter_id' => $user_platform_id));
    }
    
    public function get_friend() {
        $connect = new TwitterOAuth($this->config['CONSUMER_KEY'],$this->config['CONSUMER_SECRET'], \Session::get('access_token'), \Session::get('access_token_secret'));
 
        // フォローしてるユーザーのID一覧を取得
        $api_url = 'http://api.twitter.com/1.1/friends/ids.json';
        $method = 'GET';
        $option = array('screen_name' => \Session::get('screen_name'));
        $req = $connect->OAuthRequest($api_url,$method,$option);
        var_dump($req);
        exit;
        return null;
    }
    
    public function start_oauth() {
        if (\Session::get('access_token') !== null && \Session::get('access_token_secret') !== null) {
            //Twitterのアクセストークンが残っている場合は何もしない
            return null;
        }
        
        $to = new TwitterOAuth($this->config['CONSUMER_KEY'], $this->config['CONSUMER_SECRET']);
        $tok = $to->getRequestToken(\Uri::base(false) . 'contents/oauth/callback/tw');
        $token = $tok['oauth_token'];
        \Session::set('request_token', $tok['oauth_token']);
        \Session::set('request_token_secret', $tok['oauth_token_secret']);
        $url = $to->getAuthorizeURL($token);
        return $url;
    }
    
    public function callback($verifier) {
        $to = new TwitterOAuth($this->config['CONSUMER_KEY'],$this->config['CONSUMER_SECRET'], \Session::get('request_token'), \Session::get('request_token_secret'));
        $access_token = $to->getAccessToken($verifier);
        \Session::set('access_token', $access_token['oauth_token']);
        \Session::set('access_token_secret', $access_token['oauth_token_secret']);
//        \Session::set('user_id', $access_token['user_id']);
//        \Session::set('screen_name', $access_token['screen_name']);
        
        //opensocail_user_idの保存
        \Session::set('opensocail_user_id', $access_token['user_id']);
        
        
        //============================
        //TO DO
        //============================
        //ここでTOPページにリダイレクトする
        \Response::redirect(\Uri::base(false) . 'contents/honda');
        exit;
    }
}
