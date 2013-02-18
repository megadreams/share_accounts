<?php

class Lib_Userprofile{
    

    public function createUserProfile($user_id = null, $user_name = null) {
        $user_profile = new stdClass();
        $user_profile->id = $user_id;
        $user_profile->user_name = $user_name;         
        return $user_profile;
    }
    
    /*
     * Facebookのユーザ情報を登録する
     */
   public function addFbUserProfile($model_wrap, $fb_id, $fb_name) {
        $insert_data = array(
            'fb_id' => $fb_id,
            'name'  => $fb_name
        );
        $user_facebook = $model_wrap->getModelInstance('Model_User_Facebook', $insert_data);
        $user_facebook->save();

        $user_profile = $this->model_wrap->getModelInstance('Model_User_Profiel', array(
            'user_name' => $user_facebook->name,
            'user_facebook_id' => $user_facebook->id
        ));

        $user_profile->save();       

        return $user_profile;
       
   }
}