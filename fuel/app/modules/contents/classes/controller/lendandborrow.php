<?php

/*
 * @Admin
 */

namespace Contents;

class Controller_Lendandborrow extends \Controller_Common {

    /*
     * 貸し借りを同じコントローラーで管理
     * 
     */
    public function action_top($type) {
        
        
        $this->view_data['lend_and_borrow_list'] = $this->return_lend_list($type);

        //ユーザの友達リストを取得する
        $sql  = "SELECT up.id, up.user_name FROM user_friends uf";
        $sql .= " INNER JOIN user_profile up ON up.id = uf.friend_user_id ";
        $sql .= " WHERE ";
        $sql .= " user_profile_id = " . $this->user_profile_id;
        $frined_list = $this->model_wrap->call('DB', 'query', $sql);

        $user_lists = array();
        if ($frined_list !== null) {
            foreach ($frined_list as $friends) {
                $user_lists[$friends['id']] = $friends;            
            }
        }
       	$this->view_data['user_list'] = $user_lists;
       	$this->view_data['type']      = $type;
        
        if ($type === \Config::get('TYPE_LEND')) {
            $title = '貸しているリスト';
        } else {
            $title = '借りているリスト';
        }
        
        $this->viewContent('lendandborrow/top', $title);
        
    }
    
    /*
     * 貸しているまたは借りているリストを返すメソッド
     * @param String $type 借りているor貸しているのタイプを引数で受け取る
     */
    private function return_lend_list($type) {

        //貸している側
        if ($type === \Config::get('TYPE_LEND')) {
            $search_key = 'from_user_id';
        //借りている側
        } else if($type === \Config::get('TYPE_BORROW')) {
            $search_key = 'to_user_id';            
            
        } else {
            //エラー処理
            return false;
        }

        
        //貸しているリストを取得留守
        $lend_and_borrow_list = $this->model_wrap->call('Model_Lend_And_Borrow_Mst', 'find', 'all',                
            array(
                'where' => array(
                    array($search_key, '=', $this->user_profile->id)
                ),
            )
        );
        return $lend_and_borrow_list;
    }
    
    /*
     * 登録、編集ページ
     * 
     */
    public function action_edit_data($type, $lend_and_borrow_mst_id = null) {
        
        
         //ユーザの友達リストを取得する
        $sql  = "SELECT up.id, up.user_name, up.user_facebook_id FROM user_friends uf";
        $sql .= " INNER JOIN user_profile up on up.id = uf.friend_user_id";
        $sql .= " WHERE ";
        $sql .= " user_profile_id = " . $this->user_profile_id;
        
        $this->view_data['user_friend_list'] = $this->model_wrap->call('DB', 'query', $sql);
        
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
        $this->view_data['type'] = $type;
        
        $this->viewContent('lendandborrow/edit_view', '登録');
    }
        
   
    
    
}