<?php
return array(
    'asset_bundle' => array(
        'production' => false
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'params' => array(
                    'user' => 'root',
                    'password' => '',
                )
            )
        )
    ),
    'zenddevelopertools' => array(
        'profiler' => array(
            'enabled' => true,
        ),
        'toolbar' => array(
            'enabled' => true,
        )
    )
);
