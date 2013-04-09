<?php

namespace Contents;


//honda追加分の使い方
//サンプルコード集&hondaテスト用

class Controller_Honda extends \Controller_Common {
    
    public function action_index() {
        $lib_user_profile = new \Lib_Userprofile();
        
        //opensocial_user_idを取得する
        $opensocial_user_id = $lib_user_profile->get_opensocial_user_id();
        
        //Mongoに保存されているユーザー情報のレコードを取得する
        $user_data = $lib_user_profile->get_user_profile_data($opensocial_user_id, 'fb');
        
        //Mongoのuser_id(share独自の)を取得する
        $user_id = $lib_user_profile->get_user_profile_id($user_data);
        
        //userがshareのユーザーかどうか
        $is_user = $lib_user_profile->is_share_user();

 
        //ログイン時の処理
        //======================
        //facebookの場合
        //======================
//        $strategy = new \Lib_Fb_Strategy();
//        $ret = $strategy->start_oauth();
//        if ($ret !== null) {
//            //それぞれのPFにログインする処理
//            \Response::redirect($ret);
//        }
        //======================
        
        
        
        //======================
        //Twitterの場合
        //======================        
//        $strategy = new \Lib_Tw_Strategy();
//        $ret = $strategy->start_oauth();
//        if ($ret !== null) {
//            //それぞれのPFにログインする処理
//            \Response::redirect($ret);
//        }
        //======================
        
        
        //======================
        //Mongoのuser_profileの更新
        //======================
//        $lib_user_profile = new \Lib_Userprofile();
//        
//        //user_profileの追加
//        $lib_user_profile->save_user_profile(
//                    array('user_facebook_id' => 'testhogehoge')
//                );
//        
//        //user_profileのupdate
//        $lib_user_profile->update_user_profile(
//                array('user_facebook_id' => 'testhogehoge'), 
//                array('user_twitter_id' => '123')
//            );
        //======================
        
        
    }
}
