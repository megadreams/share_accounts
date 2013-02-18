<?php

/**
 * Description of ajaxapi
 *
 * @author fujiwara
 */

namespace Contents;

class Controller_Ajaxapi extends \Controller_Commonrest {
    
    public function action_index() {
        $this->response(array('create' => 'OK'));
    }
        
    
    public function action_lend_and_borrow_regist() {
        
        $lend_and_borrow_mst_id = \Input::post('lend_and_borrow_mst_id');
        $type = \Input::post('type');
                
        //FBの友達に領収書を発行した場合は、
        //FBのテーブルを参照しIDが無ければテーブルに情報を格納
        //そして、同時にユーザ情報にもデータを格納する、その後登録すること
        $fb_id = \Input::post('fb_id');
        $fb_name = \Input::post('fb_name');
        
        if ($fb_id !== null) {
            $fb_user = $this->model_wrap->call('Model_User_Facebook', 'find', 'first', array(
                'where' => array(
                    array('fb_id' , '=' , $fb_id),
                )
            ));
            
            if ($fb_user === null) {
                //登録処理
                $user_profile = $this->lib_user_profile->addFbUserProfile($this->model_wrap, $fb_id, $fb_name);
                //エラー処理？
                
            } else {
                 //情報を取得する
                $user_profile = $this->model_wrap->call('Model_User_Profiel', 'find', 'first', array(
                    'where' => array(
                        'user_facebook_id' => $fb_user->id
                    )
                ));
            }
            //Facebookの友達が貸し借りのどちらかを判断
            if ($type === \Config::get('type_lend')) {
                $lend_user_id   = $user_profile->id;
            } else {
                $borrow_user_id = $user_profile->id;
            }
        }
        
        
        //登録もしてないのに勝手にアカウントができちゃう問題が起きるがまぁいいか！
        //退会は出来ない？出来る？
        //ログアウトは？

        
        
        
        //新規登録
        if ($lend_and_borrow_mst_id == null) {
  
            $insert_data = array(
                'date'           => \Input::post('date'),
                'money'          => \Input::post('money'),
                'status'         => \Input::post('status'),
                'memo'           => \Input::post('memo'),
                'limit'          => \Input::post('limit'),
                'created_at'     => \Input::post('created_at'),
            );
            $insert_data['lend_user_id']   = \Input::post('lend_user_id');
            $insert_data['borrow_user_id'] = \Input::post('borrow_user_id');
                
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
            $lend_and_borrow_mst->lend_user_id   = \Input::post('lend_user_id');
            $lend_and_borrow_mst->borrow_user_id = \Input::post('borrow_user_id');              

     
            
            $lend_and_borrow_mst->date           = \Input::post('date');
            $lend_and_borrow_mst->money          = \Input::post('money');
            $lend_and_borrow_mst->status         = \Input::post('status');
            $lend_and_borrow_mst->memo           = \Input::post('memo');
            $lend_and_borrow_mst->limit          = \Input::post('limit');
            $lend_and_borrow_mst->updated_at     = (int)time();            
            
        }
        
        
        //データベース保存
        if (!$lend_and_borrow_mst->save()) {
            $this->response(array('error' => true,'data' => false), 500);
        } else {
            $this->response(array('error' => false,'data' => false), 200);        
        }
        
        
        
    }
    
}
