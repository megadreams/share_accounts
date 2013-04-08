<?php
/**
 * The test database settings. These get merged with the global settings.
 *
 * This environment is primarily used by unit tests, to run on a controlled environment.
 */

return array(   
    'MONGODB' => array(
            'database' => 'share',
            'port'     => '27017',
            'username' => 'share',
            'password' => 'sharepass',
            'hostname' => '127.0.0.1'
    ),
    
);
