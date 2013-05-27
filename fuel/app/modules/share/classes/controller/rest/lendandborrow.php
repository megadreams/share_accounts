<?php

/**
 * Description of ajaxapi
 *
 * @author fujiwara
 */

namespace Share;

class Controller_Rest_Lendandborrow extends Controller_Rest_Commonrest {
    
   /**
    * 貸し借り表への登録処理
    */
    //http://share.com/share_accounts/public/share/rest/lendandborrow/regist?type=lend&to_user_id=2&my_user_id=1&category=1&date=0&item=9&limit=0&memo=9&status=10&user_type=facebook&target_user_name=テスト
   public function post_regist() {
       $validation = \Config::get('validation');

       //Inputデータの取り組み
       $input_data = \Input::post();
              
       //update処理
       if (isset($input_data['collection_id']) === true) {
            //コレクションに保存するデータのみ　update用
            $lend_and_borrow_keys = \Config::get('lend_and_borrow_keys_update');
           
       //insert処理
       } else {
            //バリデーションチェック
            $validation_flg = $this->validation($input_data, $validation['lend_and_borrow']);
           //エラーチェック
           if ($validation_flg !== true) {
               $res = array('error' => true, 'msg' => 'バリデーションエラー', 'error_data' => $validation_flg);
               $this->response($res);
               return;
           }
           
            //ユーザチェック
            if ($input_data['user_type'] === 'default') {
                //何もしない

             } else if ($input_data['user_type'] === 'facebook') {
                 $lib_userprofile = new Lib_Userprofile($this->mongo_wrap);
                 $user_profile    =  $lib_userprofile->get_user_profile($input_data['my_user_id']);

                 //このIDのユーザが既に登録されているか？されていないなら登録！友達設定まで行うこと
                 $to_user_id = $lib_userprofile->get_user_profile_id($input_data['to_user_id'], $input_data['target_user_name'], $input_data['user_type']);
                 $input_data['to_user_id'] = $to_user_id; //取得したユーザID

                 //友達登録
                 $lib_userprofile->create_user_friend($user_profile, $to_user_id);            
            }
            //変換処理
            if ($input_data['type'] === \Config::get('TYPE_LEND')) {
                $input_data['borrow_user_id'] = $input_data['to_user_id'];
                $input_data['lend_user_id']   = $input_data['my_user_id'];

            } else if ($input_data['type'] === \Config::get('TYPE_BORROW')) {
                $input_data['lend_user_id']   = $input_data['to_user_id'];
                $input_data['borrow_user_id'] = $input_data['my_user_id'];

            } else {
                $res = array('error' => true, 'msg' => 'type is not defined!', 'data' => null);
                $this->response($res);
                return;           
            }
            //カテゴリがmoneyの場合、itemは数値
            if ($input_data['category'] === 'money') {
                $input_data['item'] = (int)$input_data['item'];
            }
            //コレクションに保存するデータのみ
            $lend_and_borrow_keys = \Config::get('lend_and_borrow_keys');
      }
        
       
       
       //collection_idがあれば編集
       if (isset($input_data['collection_id'])) {
           $this->lend_and_borrow_update($lend_and_borrow_keys, $input_data);
       } else {
           $this->lend_and_borrow_insert($lend_and_borrow_keys, $input_data);
       }
       $res = array('error' => false);
       $this->response($res);
   }
   
   
   /**
    * 新規挿入
    * @param type $input_data
    */
   public function lend_and_borrow_insert($insert_key, $input_data) {
       //バリデーションチェックは終わっているから大丈夫
       $insert_data = array();
       foreach ($insert_key as $keys => $validate_type) {
           if ($validate_type === 'int') {
               $insert_data[$keys] = (int)$input_data[$keys];           
           } else {
               $insert_data[$keys] = $input_data[$keys];
           }
       }

       \Lib_Mongowrap::insert_data('lend_and_borrow', $insert_data);       
   }
   
   /**
    * 更新処理
    * @param type $input_data
    */
    public function lend_and_borrow_update($update_key, $input_data) {
        $collection_id = (int)$input_data['collection_id'];
        
        $lend_and_borrow_data = $this->mongo_wrap->where(array('collection_id' => (int)$collection_id))->get_one('lend_and_borrow');
        if (empty($lend_and_borrow_data)) {
            $this->lend_and_borrow_insert($update_key, $input_data);
            return ;
        }
        
        foreach ($update_key as $key => $validate_type) {
            if ($validate_type === 'int') {
                $lend_and_borrow_data[$key] = (int)$input_data[$key];
            } else {
                $lend_and_borrow_data[$key] = $input_data[$key];
            }
        }
        \Lib_Mongowrap::update_data('lend_and_borrow', $lend_and_borrow_data);       
    }
    
    /**
     * 削除処理
     */
    public function post_delete() {
       //Inputデータの取り組み
        $input_data = \Input::post();
        $collection_id = (int)$input_data['collection_id'];
        $this->mongo_wrap->where(array('collection_id' => (int)$collection_id))->delete('lend_and_borrow');
        $res = array('error' => false);
        $this->response($res, 200);
    }
    
    /**
     * トップページからのアクセス
     */
    public function post_top() {
        $input_data = \Input::post();
        $type = $input_data['type'];
        $ids  = $input_data['checkbox'];
        //削除処理
        if ($type === 'delete') {
            foreach ($ids as $id) {
                $this->mongo_wrap->where(array('collection_id' => (int)$id))->delete('lend_and_borrow');        
            }
            
        //ステータス変更
        } else if ($type === 'status') {
            $insert_data = array();
            $insert_data['status'] = $input_data['status'];
            
            $update_key = array('status' => 'int');
            foreach ($ids as $id) {
                $insert_data['collection_id'] = $id;
                $this->lend_and_borrow_update($update_key, $insert_data);
            }
        }
        $res = array('error' => false);
        $this->response($res, 200);
        
    }
    
    /*
     * Facebookの友達リストを返すAPI
     */
    //http://share.com/share_accounts/public/share/rest/lendandborrow/facebook_friends
    
    public function get_facebook_friends() {
        //FBから友達リストの追加
        $fb_friends = $this->lib_friends->get_facebook_friend();
        $result = array(
            'error' => false,
            'data'  => $fb_friends,
            'type'  => 'facebook'
        );
        $this->response($result, 200);
        
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
}
