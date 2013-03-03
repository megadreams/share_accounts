<?php

/**
 * Description of ajaxapi
 *
 * @author fujiwara
 */

namespace Contents;

class Controller_Rest_lendandborrow extends \Controller_Commonrest {
    
    public function action_index() {
        $this->response(array('create' => 'OK'));
    }
        
    /*
     * Facebookの友達リストを返すAPI
     */
    public function get_facebook_friends() {
        //FBから友達リストの追加
        $fb_friends = $this->lib_friends->get_facebook_friend();
        $this->response($fb_friends, 200);
        
    }
    
    /*
     * アプリの友達リストを返すAPI
     */
    public function get_app_friends ($user_profile_id) {
        //FBから友達リストの追加
        $sql  = "SELECT up.id, up.user_name FROM user_friends uf";
        $sql .= " INNER JOIN user_profile up on up.id = uf.friend_user_id";
        $sql .= " WHERE ";
        $sql .= " uf.user_profile_id = " . $user_profile_id . ";";
        $model_wrap = new \Lib_Modelwrap();
        $user_friend_list = $model_wrap->call('DB', 'query', $sql);
        $lists = array();
        if (count($user_friend_list) > 0) {
            foreach($user_friend_list as $friend) {
                $lists[] = $friend;
            }
        }
        $this->response(array('data' => $lists), 200);
        
    }    
    
    
    /*
     * 登録処理
     */
    public function action_regist() {

        //情報を取得する
        $type                   = \Input::post('type');
        $from_user_id           = \Input::post('from_user_id');         
        $to_user_id             = \Input::post('to_user_id');
        $lend_and_borrow_mst_id = \Input::post('lend_and_borrow_mst_id');
        $date                   = \Input::post('date');
        $item                   = \Input::post('item');
        $memo                   = \Input::post('memo');
        $limit                  = \Input::post('limit');
        $status                 = \Input::post('status');

        

        //貸している人リストならば自分はfrom_user_idになる
        if ($type === \Config::get('TYPE_LEND')) {
            $my_user_id = $from_user_id;
            //相手の情報があるか？
            if ($to_user_id === null) {
                
                //Facebookリストから選んでいないか？
                $facebook_friend_id = \Input::post('facebook_friend_id');
                $facebook_friend_name = \Input::post('facebook_friend_name');

                if ($facebook_friend_id !== null) {
                    //Facebookユーザを返す　なければ作って返す
                    $to_user_profile = $this->return_facebook_user_profile($my_user_id, $facebook_friend_id, $facebook_friend_name);
                    $to_user_id = $to_user_profile->id;
                }
                //LINEから？
                //Twitterから？
            }
            
        //借りている人リストならば自分はto_user_idになる
        } else {
            $my_user_id = $to_user_id;
            
            //相手の情報があるか？
            if ($from_user_id === null) {
                //Facebookリストから選んでいないか？
                $facebook_friend_id = \Input::post('facebook_friend_id');
                $facebook_friend_name = \Input::post('facebook_friend_name');

                if ($facebook_friend_id !== null) {
                    //Facebookユーザを返す　なければ作って返す
                    $frim_user_profile = $this->return_facebook_user_profile($my_user_id, $facebook_friend_id, $facebook_friend_name);
                    $from_user_id = $frim_user_profile->id;
                }
                //LINEから？
                //Twitterから？
            }
        }
        

        //新規登録
        if ($lend_and_borrow_mst_id === null) {
  
            $insert_data = array(
                'from_user_id'    => $from_user_id,
                'to_user_id'      => $to_user_id,
                'category_mst_id' => 1,
                'item'            => $item,
                'date'            => $date,
                'status'          => $status,
                'memo'            => $memo,
                'limit'           => $limit,
                'created_at'      => (int)time(),
            );          
            $lend_and_borrow_mst = $this->model_wrap->getModelInstance('Model_Lend_And_Borrow_Mst', $insert_data);
            
        //更新処理
        } else {
            $lend_and_borrow_mst = $this->model_wrap->call('Model_Lend_And_Borrow_Mst', 'find', 'first', array(
                'where' => array(
                    array(
                        'id', '=', $lend_and_borrow_mst_id
                    )
                ))
            );
        
            $lend_and_borrow_mst->from_user_id    = $from_user_id;
            $lend_and_borrow_mst->to_user_id      = $to_user_id;              
            $lend_and_borrow_mst->category_mst_id = 1;
            $lend_and_borrow_mst->item            = $item;
            $lend_and_borrow_mst->date            = $date;
            $lend_and_borrow_mst->status          = $status;
            $lend_and_borrow_mst->memo            = $memo;
            $lend_and_borrow_mst->limit           = $limit;
            $lend_and_borrow_mst->updated_at      = (int)time();            
            
        }
        
        //データベース保存
        if (!$lend_and_borrow_mst->save()) {
            $this->response(array('error' => true,'data' => false), 500);
        } else {
            $this->response(array('error' => false,'data' => false), 200);        
        }
        
        
        
    }
    
    
    private function return_facebook_user_profile($my_user_id, $facebook_friend_id, $facebook_friend_name) {
        $user_facebook = $this->model_wrap->call('Model_User_Facebook', 'find', 'first', array(
            'where' => array(
                'fb_id' => $facebook_friend_id
            )
        ));

        // 初回ユーザかチェックするロジック
        if($user_facebook === null){
            $user_profile = $this->lib_userprofile->add_fb_user($this->model_wrap, $facebook_friend_id, $facebook_friend_name); 
        } else {
             //情報を取得する
            $user_profile = $this->model_wrap->call('Model_User_Profile', 'find', 'first', array(
                'where' => array(
                    'user_facebook_id' => $user_facebook->id
                )
            )); 
        }
        //フレンドリストへの登録
        $user_friends = $this->model_wrap->call('Model_User_Friend', 'find', 'first', array(
            'where' => array(
                array('user_profile_id', '=', $my_user_id),
                array('friend_user_id',  '=', $user_profile->id),
            )
        ));
        if ($user_friends === null) {        
            $insert_data = array(
                'user_profile_id' => $my_user_id,
                'friend_user_id'  => $user_profile->id,
            );
            $user_friends1 = $this->model_wrap->getModelInstance('Model_User_Friend', $insert_data);
            $insert_data = array(
                'user_profile_id' => $user_profile->id,
                'friend_user_id'  => $my_user_id,
            );            
            $user_friends2 = $this->model_wrap->getModelInstance('Model_User_Friend', $insert_data);
            $user_friends1->save();
            $user_friends2->save();
        }
        
        return $user_profile;
    }
}
