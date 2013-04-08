<?php

/*
 * @Admin
 */

namespace Share;

class Controller_Top extends Controller_Common {

    public function action_index() {
        $this->viewWrap('top/index', '貸し借り管理');
    }
}