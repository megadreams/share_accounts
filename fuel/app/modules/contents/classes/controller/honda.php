<?php

namespace Contents;


//honda追加分の使い方
//サンプルコード集&hondaテスト用

class Controller_Honda extends \Controller_Common {
    
    public function action_index() {
//        $strategy = new \Lib_Fb_Strategy();
//        $ret = $strategy->start_oauth();
//        if ($ret !== null) {
//            //それぞれのPFにログインする処理
//            \Response::redirect($ret);
//        }
//        
//        $friend_list = $strategy->get_friend();
//        var_dump($friend_list);
        
        
        $strategy = new \Lib_Tw_Strategy();
        $ret = $strategy->start_oauth();
        if ($ret !== null) {
            //それぞれのPFにログインする処理
            \Response::redirect($ret);
        }
        $friend_list = $strategy->get_friend();
        var_dump($friend_list);
        exit;
        
        
        
        
        $lib_user_profile = new \Lib_Userprofile();
        
        //user_profileの追加
        $lib_user_profile->save_user_profile(
                    array('user_facebook_id' => 'testhogehoge')
                );
        
        //user_profileのupdate
        $lib_user_profile->update_user_profile(
                array('user_facebook_id' => 'testhogehoge'), 
                array('user_twitter_id' => '123')
            );
        
        exit;
    }
}
