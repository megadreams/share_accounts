<?php
/*
 * 本来ならばModelを準備スべきだがMongoのためconfigに定義
 */
return array(
    
    //mongoに入れるlend_and_borrowのkey
    'lend_and_borrow_keys' => array(
        "borrow_user_id" => 'int',
        "category"       => 'string',
        "date"           => 'int',
        "item"           => 'string',
        "lend_user_id"   => 'int',
        "limit"          => 'int',
        "memo"           => 'string',
        "status"         => 'int'
    ),
    
);