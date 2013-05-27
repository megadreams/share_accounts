<?php

/*
 * @Admin
 */

namespace Share;

class Controller_Lendandborrow extends Controller_Common {
    
    /*
     * 貸し借りを同じコントローラーで管理
     * 
     */
    public function action_top($type) {
        
        //貸し借り情報の取得
        $lend_and_borrow_list = $this->lib_lendandborrow->get_lendandborrow_list($type, $this->lib_userprofile->user_id);
        if ($type === \Config::get('TYPE_LEND')) {
            $target_collum = 'borrow_user_id';
        } else {
            $target_collum = 'lend_user_id';            
        }
        //ユーザ別のリストを取得する
        $user_lend_and_borrows = array();
        foreach($lend_and_borrow_list as $data) {
            $data_user_id = (int)$data[$target_collum];
            if (isset($user_lend_and_borrows[$data_user_id]) === false) {            
                $user_lend_and_borrows[$data_user_id] = array();
            }
            $user_lend_and_borrows[$data_user_id][]  = (int)$data['item'];            
        }
        $this->view_data['user_lend_and_borrows'] = $user_lend_and_borrows;
        
        
        //ユーザの友達情報を取得する
       	$this->view_data['user_friends'] = $this->lib_userprofile->get_user_friends();

        
        if ($type === \Config::get('TYPE_LEND')) {
            $title = '貸しているリスト';
        } else {
            $title = '借りているリスト';
        }
       	$this->view_data['type']         = $type;
        
        $this->viewWrap('lendandborrow/top', $title);
        
    }

    /*
     * 登録、編集ページ
     * 
     */
    public function action_edit($type, $collection_id = null) {
        
        if ($collection_id === null) {
            return ;
        }

        //ステータス状況の取得
        $this->view_data['status'] = \Config::get('status');

        //編集の場合情報を取得
        $lend_and_borrow_data = $this->lib_lendandborrow->get_lendandborrow_mst($collection_id);            
        $this->view_data['lend_and_borrow_data'] = $lend_and_borrow_data;
        
        
        //自分がどちらの立場かどうか？　lend : 貸している borrow:借りている
        $this->view_data['type'] = $type;
        if ($type === \Config::get('TYPE_LEND')) {
            $your_type = 'borrow_user_id';
        } else if ($type === \Config::get('TYPE_BORROW')) {
            $your_type = 'lend_user_id';        
        } else {
            //error
            return ;
        }
        
        
        $lib_userprofile = new Lib_Userprofile($this->mongo_wrap);
        $this->view_data['your_user_profile'] = $lib_userprofile->get_user_profile($lend_and_borrow_data[$your_type]);
        

        $this->viewWrap('lendandborrow/edit_view', '登録');
    }
        
    
    /**
     * 新規登録ページ
     */
   
    public function action_create() {
        //ユーザの友達情報を取得する
       	$this->view_data['user_friends'] = $this->lib_userprofile->get_user_friends();        
        $this->viewWrap('lendandborrow/create_view', '登録');        
    }
    
    
}