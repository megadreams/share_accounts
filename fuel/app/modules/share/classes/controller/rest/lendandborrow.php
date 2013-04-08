<?php

/**
 * Description of ajaxapi
 *
 * @author fujiwara
 */

namespace Share;

class Controller_Rest_Lendandborrow extends Controller_Rest_Commonrest {
    
   public function post_regist() {
       $res = array(
           'error' => false,
           'data'  => NULL
       );
       $this->response($res);
   }
}
