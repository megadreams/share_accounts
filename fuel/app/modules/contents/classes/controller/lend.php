<?php

/*
 * @Admin
 */

namespace Contents;

class Controller_Lend extends \Controller_Common {

    public function action_index() {
        
        //貸しているリストを取得留守
        $this->view_data['lend_and_borrow_mst'] = $this->model_wrap->call('Model_Lend_And_Borrow_Mst', 'find', 'all',                
            array(
                'where' => array(
                    array('lend_user_id', '=', $this->user_profile->id)
                ),
            )
        );
        
        
        //ユーザ情報取得
        $user_list = $this->model_wrap->call('Model_User_Profiel', 'find', 'all');
        $user_lists = array();
        foreach ($user_list as $user) {
            $user_lists[$user->id] = $user;            
        }
       	$this->view_data['user_list'] = $user_lists;

        
        
        $this->viewContent('lend/lend_top_view', '貸している一覧表');
        
    }
    
    public function action_edit_data($lend_and_borrow_mst_id = null) {
        
        
        //TO DO;Facebookから友達情報を取得しよう（ユーザの端末に保存しておくか！）
        
        //FBから友達リストの追加
        $user_friend_list = $this->getFacebookFriend();
        $this->view_data['user_friend_list'] = $user_friend_list;
        
        
        
        $this->view_data['user_list']= $this->model_wrap->call('Model_User_Profiel', 'find', 'all');
        
        if ($lend_and_borrow_mst_id !== null) {
            //編集の場合情報を取得
            $this->view_data['lend_and_borrow_mst'] = $this->model_wrap->call('Model_Lend_And_Borrow_Mst', 'find','first',
                array(
                    'where' => array(
                        array('id', '=', $lend_and_borrow_mst_id)
                    ),
                )
            );
        }
        
        $this->view_data['user_profiel'] = $this->user_profile;
        $this->view_data['type'] = \Config::get('type_lend');
        
        $this->viewContent('lend/lend_edit_data_view', '貸しているリスト登録');
    }
        
   
    
    
}