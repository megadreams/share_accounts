<?php

/**
 * Description of ajaxapi
 *
 * @author fujiwara
 */

namespace Share;

class Controller_Rest_Share extends Controller_Rest_Commonrest {
    /**
     * 貸し借り情報を取得する
     * @param type $type
     * @param type $user_id
     */
    public function get_share_list ($type, $user_id) {
        $res = array(
            array(
                "id"           => 1,
                "from_user_id" => 2, 
                "to_user_id"   => 1, 
                "item"         => 1000, 
                "category"     => "money",
                "date"         => 13590700, 
                "status"       => 0,
                "memo"         => "早く返せ！", 
                "limit"        => 13690700
            )
        );
        $this->response($res);
    }
    
    /**
     * 貸し借り情報を取得する
     * @param type $type
     * @param type $user_id
     */
    public function get_share_info ($lendandborrow_id) {
        $res = array(
            "id"           => 1,
            "from_user_id" => 2, 
            "to_user_id"   => 1, 
            "item"         => 1000, 
            "category"     => "money",
            "date"         => 13590700, 
            "status"       => 0,
            "memo"         => "早く返せ！", 
            "limit"        => 13690700
        );
        $this->response($res);
    }
    
    public function post_regist() {
        $res = array('error' => false, 'date' => true);
        $this->response($res);        
    }
    /**
     * 友達リストを取得する
     * 
     */
    public function get_friends($user_id) {
        $res = array(
            2 => 'A',
            3 => 'B',
            4 => 'C',
            5 => 'D',
        );
        $this->response($res);        
    }
  
}
