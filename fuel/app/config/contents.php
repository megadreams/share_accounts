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
    
    //Twitter
    'twitter' => array(
        'CONSUMER_KEY' => 'XyOv9DT8WzcwwAeC0pUGA',
        'CONSUMER_SECRET' => 'HDwTsKWxF0YTLOBrBpLwQTjJPKRFEJ1DJ90VcfRD1s'
    ),
    
    //Mongoのuser_profileのそれぞれのPFのopensocial_user_idとそのPFを対応させたもの
    'user_profile_platform_keys' => array(
        'fb' => 'user_facebook_id',
        'ln' => 'user_line_id',
        'tw' => 'user_twitter_id'
    )
    
);