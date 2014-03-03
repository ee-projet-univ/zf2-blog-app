<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'asset_bundle' => array(
        'assets' => array(
            'css' => array('css'),
            'js' => array(
                'js/jquery.min.js',
                'js/bootstrap.min.js',
                'js/mootools-core-1.4.5-full-nocompat.js',
                'js/moostarrating.js'
            ),
            'media' => array('img','fonts')
        )
    ),
    //Default locale
    'translator' => array('locale' => 'fr_FR'),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => '127.0.0.1',
                    'dbname' => 'zf2-blog-app',
                    'charset' => 'utf8',
                    'driverOptions' => array (1002 => 'SET NAMES utf8'),
                )
            )
        )
    )
);
