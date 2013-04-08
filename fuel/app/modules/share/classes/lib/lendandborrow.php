<?php

/**
 * Description of lendandborrow
 *
 * @author fujiwara
 */

namespace Share;

class Lib_Lendandborrow {
    private $mongo_wrap;
    
    public function __construct($mongo_wrap) {
        $this->mongo_wrap = $mongo_wrap;
    }
    
    
    /**
     * 貸し借りリストを取得する
     * 
     * @param type $type    lend = 借りている or borrow = 貸している
     * @param type $user_id
     * @return type
     */
    public function get_lendandborrow_list ($type, $user_id) {
        if ($type === \Config::get('TYPE_LEND')) {
            $target_colum = 'lend_user_id';
        } else if ($type === \Config::get('TYPE_BORROW')) {
            $target_colum = 'borrow_user_id';
        } else {
            echo 'error!!';
            exit();            
        }
        
        $data = $this->mongo_wrap->get_where('lend_and_borrow',
                array($target_colum => (int)$user_id)
            );
        return $data;
    }
    

    public function get_lendandborrow_mst($collection_id) {        
        $data = $this->mongo_wrap->where(array('collection_id' => (int)$collection_id))->get_one('lend_and_borrow');
        return $data;
    }
}

