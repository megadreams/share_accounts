<?php

namespace Contents;


//honda追加分の使い方
//サンプルコード集&hondaテスト用

class Controller_Honda extends \Controller_Common {
    
    public function action_index() {
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
