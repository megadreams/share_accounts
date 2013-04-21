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
            'date'         => 'int',
            'item'         => 'string',
            'limit'        => 'int',
            'memo'         => 'string',
            'status'       => 'int',
        )
    ),
    
    //mongoに入れるlend_and_borrowのkey
    'lend_and_borrow_keys' => array(
            'borrow_user_id' => 'int',
            'lend_user_id'   => 'int',
            'category'       => 'string',
            'date'           => 'int',
            'item'           => 'string',
            'limit'          => 'int',
            'memo'           => 'string',
            'status'         => 'string',
    ),
    
);