<?php
return array(
    'type_lend'   => 'lend',
    'type_borrow' => 'borrow',
    
    //貸し借りのどちらか
    'TYPE_LEND' => 'lend', //貸している
    'TYPE_BORROW' => 'borrow',   //借りている

    
    
    'status' => array(
        //貸している人一覧に出すステータスの文言
        'lend' => array(
            '貸している',
            '受取済',
        ),
        //借りているる人一覧に出すステータスの文言
        'borrow' => array(
            '借りている',
            '支払済',
        )
    ),
    //Facebook
    'facebook' => array(
      'APP_ID' => '344664518982268', 
      'APP_SECRET' => 'f6d5ea7a24a9258c96a2caa4c5a0a052',
      'CALLBACK' => 'contents/auth/callback/',
    ),
    
    //mongoに入れるOAuthのid
    'user_profile_keys' => array(
        'user_facebook_id',
        'user_line_id',
        'user_twitter_id'
    )
    
);