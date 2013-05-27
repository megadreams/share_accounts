<?php

/*
 * @Admin
 */

namespace Share;

class Controller_Top extends Controller_Common {

    public function action_index() {
        
        //データの取得
        $this->view_data['lend_list']   = $this->lib_lendandborrow->get_lendandborrow_list(\Config::get('TYPE_LEND'), $this->lib_userprofile->user_id);
        $this->view_data['borrow_list'] = $this->lib_lendandborrow->get_lendandborrow_list(\Config::get('TYPE_BORROW'), $this->lib_userprofile->user_id);

        //ユーザの友達情報を取得する
       	$this->view_data['user_friends'] = $this->lib_userprofile->get_user_friends();

        //ステータス状況の取得
        $this->view_data['status'] = \Config::get('status');

        $this->viewWrap('top/index', '貸し借り管理');
    }
}