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
    
    //mongoに入れるOAuthのid
    'user_profile_keys' => array(
        'user_facebook_id',
        'user_line_id',
        'user_twitter_id'
    ),
        
    //RestURL系
    'rest_list' => array(
        'lendandborrow'      => 'share/rest/share/share_list/',
        'edit_lendandborrow' => 'share/rest/share/share_info/',
        'friends'            => 'share/rest/share/friends/',

    ),

    //Mongoのuser_profileのそれぞれのPFのopensocial_user_idとそのPFを対応させたもの
    'user_profile_platform_keys' => array(
        'fb' => 'user_facebook_id',
        'ln' => 'user_line_id',
        'tw' => 'user_twitter_id'
    )

);