<?php
/**
 * The test database settings. These get merged with the global settings.
 *
 * This environment is primarily used by unit tests, to run on a controlled environment.
 */

return array(
    'mongo' => array(
        'default' => array(
            'hostname'   => '127.0.0.1',
            'port' => 27017,
            'database'   => 'admin',
            'username'   => 'admin',
            'password'   => 'admin',
        ),
    ),    
);
