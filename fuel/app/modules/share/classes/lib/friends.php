<?php
namespace Share;
class Lib_Friends{
    
    //facebookから友達一覧を取得する
    public function get_facebook_friend() {
        $access_token = \Session::get('access_token');
        
        
        //アクセストークンが無ければ認証画面へ
        if ($access_token === null) {
            \Response::redirect('contents/auth/index');
        }
        //友達情報を取得する
        $user_friend = file_get_contents('https://graph.facebook.com/me/friends?locale=ja&' . $access_token);
        
        $user_friend_list = json_decode($user_friend);
        
        //名前の順番に並び替える
        $user_list = array();
        foreach ($user_friend_list->data as $user) {
            $user_list[$user->name] = $user;
        }
        krsort($user_list);
        
        $return_data = array();
        foreach ($user_list as $user) {
            $return_data[] = $user;
        }
        
        
        return array(
            'data' => $return_data,
            'type' => 'facebook',
        );
    } 
    
}