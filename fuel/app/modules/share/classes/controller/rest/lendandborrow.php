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
    //http://share.com/share_accounts/public/share/rest/lendandborrow/regist?collection_id=3&date=2009&memo=1000&borrow_user_id=1&category=10&item=10&lend_user_id=1&limit=0&status=1
    
   public function post_regist() {
       $lend_and_borrow_keys = \Config::get('lend_and_borrow_keys');

       //Inputデータの取り組み
       $input_data = \Input::post();
                  
       //バリデーションチェック
       $validation = $this->validation($input_data, $lend_and_borrow_keys);

       //エラーチェック
       if ($validation !== true) {
           $res = array('error' => true, 'msg' => 'バリデーションエラー', 'data' => $validation);
           $this->response($res);
           return;
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
    
    public function post_delete() {
       //Inputデータの取り組み
        $input_data = \Input::post();
        $collection_id = (int)$input_data['collection_id'];       
        $this->mongo_wrap->where(array('collection_id' => (int)$collection_id))->delete('lend_and_borrow');
        $res = array('error' => false);
        $this->response($res);     
    }
}
