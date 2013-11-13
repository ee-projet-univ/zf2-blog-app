<?php
return array(
	'asset_bundle' => array(
		'production' => false
	),
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
			    'params' => array(
			    	'host' => '127.0.0.1',
			        'user' => 'root',
			        'password' => '',
			        'dbname' => 'zf2-blog-app'
		    	)
			)
		)
	)
);