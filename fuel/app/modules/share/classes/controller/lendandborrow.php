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
    public function action_edit_data($type, $lend_and_borrow_id = null) {
        
        //ユーザの友達情報を取得する
       	$this->view_data['user_friends'] = $this->lib_userprofile->get_user_friends();
        
        if ($lend_and_borrow_id !== null) {
            //編集の場合情報を取得
            $this->view_data['lend_and_borrow_mst'] = $this->lib_lendandborrow->get_lendandborrow_mst($lend_and_borrow_id);            
        }

        $this->view_data['type']         = $type;        
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