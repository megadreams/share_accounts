<?php 

namespace Share;

class Controller_Rest_Commonrest extends \Controller_Rest {
        
    protected $mongo_wrap;
    protected $lib_lendandborrow;
    protected $lib_friends;
    
    public function before() {
        parent::before();    
        $this->lib_friends = new Lib_Friends();
        $this->mongo_wrap = \Lib_Mongowrap::getInstance();
    }
    
    /**
     * 引数で渡ってきたデータがセットされているかのチェックを行う
     * 今後、型の指定なども行えたらいいなと思う＾＾
     * 
     * @param type $input_data
     * @param type $validate_keys
     * @return boolean
     */
    protected function validation($input_data = array(), $validate_keys = array()) {
       $error_collum = array();
       foreach ($validate_keys as $key => $validate_type) {
           if (!isset($input_data[$key])) {
               $error_collum[] = $key;
           }
       }
       if (empty($error_collum)) {
           return true;
       } else {
           return $error_collum;
       }
               
    }
    
    
}

