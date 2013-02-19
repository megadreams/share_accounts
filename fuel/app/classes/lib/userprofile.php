<?php

class Lib_Userprofile{
    
    public function create_user_instance($model_wrap, $user_id = null, $user_name = null) {
        $user_profile            = new stdClass();
        $user_profile->id        = $user_id;
        $user_profile->user_name = $user_name;         
        return $user_profile;
    }
    
    /*
     * Facebookのユーザ情報を登録する
     */
   public function add_fb_user($model_wrap, $fb_id, $fb_name) {
        $insert_data = array(
            'fb_id' => $fb_id,
            'name'  => $fb_name
        );
        
        $user_facebook = $model_wrap->getModelInstance('Model_User_Facebook', $insert_data);
        
        try {
            \DB::start_transaction();
            //DB登録
            $user_facebook->save();
            $user_profile = $model_wrap->getModelInstance('Model_User_Profile', array(
                'user_name' => $user_facebook->name,
                'user_facebook_id' => $user_facebook->id
            ));
            $user_profile->save();       
            \DB::commit_transaction();
        } catch (Exception $e) {
            \DB::rollback_transaction();
//            \Log::debug($e->getMessage());
            return false;
        }
        return $user_profile;
       
   }
}