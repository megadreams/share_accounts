<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
	'MONGODB' => array(
	        'database' => 'sharedb',
		'port'	   => '33047',
		'username' => 'share',
		'password' => 'sharepass',
		'hostname' => 'ds033047.mongolab.com'
	),
	'DB_CONNECT' => 'mongodb://share:sharepass@ds033047.mongolab.com:33047/sharedb',
);
