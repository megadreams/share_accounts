<?php
/**
 * The test database settings. These get merged with the global settings.
 *
 * This environment is primarily used by unit tests, to run on a controlled environment.
 */

return array(
	'default' => array(
                'type'			=> 'mysql',
                'connection'	=> array(
                        'hostname'		=> 'localhost',
                        'port'			=> '3306',
                        'database'		=> 'share_accounts',
                        'username'		=> 'share_accounts',
                        'password'		=> 'share_accounts',
                ),
                // 		'table_prefix' => 'ls_',
                'profiling' => true
        )
);
