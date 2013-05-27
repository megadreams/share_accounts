<?php
/*
 * 本来ならばModelを準備スべきだがMongoのためconfigに定義
 */
return array(
    'validation' => array(
        'lend_and_borrow' => array(
            'type'         => 'int',
            'to_user_id'   => 'int',
            'my_user_id'   => 'int',
            'category'     => 'string',
            'date'         => 'string',
            'item'         => 'string',
            'limit'        => 'int',
            'memo'         => 'string',
            'status'       => 'int',
            'user_type'    => 'string',
        )
    ),
    
    //mongoに入れるlend_and_borrowのkey
    'lend_and_borrow_keys' => array(
            'borrow_user_id' => 'int',
            'lend_user_id'   => 'int',
            'category'       => 'string',
            'date'           => 'string',
            'item'           => 'string',
            'limit'          => 'int',
            'memo'           => 'string',
            'status'         => 'string',
    ),
    
    //mongoに入れるlend_and_borrowのkey update用
    'lend_and_borrow_keys_update' => array(
            'collection_id' => 'int',        
            'limit'         => 'int',
            'status'        => 'string',
    )
);