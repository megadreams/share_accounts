<?php

namespace Contents;

class Controller_Oauth extends \Controller_Common {
    
    //OAuthのcallback
    public function action_callback($pf) {
        if ($pf === null) {
            \Log::debug('ERROR callback no $pf');
            exit;
        }
        $strategy_name = 'Lib_' . $pf . '_Strategy';
        $strategy = new $strategy_name();
        var_dump($strategy);
        $verifier = $_GET['oauth_verifier'];
        $strategy->callback($verifier);
    }
}
