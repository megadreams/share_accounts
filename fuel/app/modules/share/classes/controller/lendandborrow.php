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
        $url = $this->rest_url_list['lendandborrow'] . $type . "/" . $this->user_profile->id;
        $this->view_data['lend_and_borrow_list'] = $this->request($url);
        

        //ユーザの友達情報を取得する
        $url = $this->rest_url_list['friends'] . $this->user_profile->id;
       	$this->view_data['user_friends'] = $this->request($url);

        
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
        $url = $this->rest_url_list['friends'] . $this->user_profile->id;
       	$this->view_data['user_friends'] = $this->request($url);

        
        if ($lend_and_borrow_id !== null) {
            //編集の場合情報を取得
            $url = $this->rest_url_list['edit_lendandborrow'] . $lend_and_borrow_id;
            $this->view_data['lend_and_borrow_mst'] = $this->request($url);
            
        }
        $this->view_data['user_profiel'] = $this->user_profile;
        $this->view_data['type']         = $type;
        
        $this->viewWrap('lendandborrow/edit_view', '登録');
    }
        
   
    
    
}