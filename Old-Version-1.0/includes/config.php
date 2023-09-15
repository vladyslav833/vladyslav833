<?php

define('DEBUG_MODE',true);

	date_default_timezone_set('Europe/London');

    # SESSIONS
    ini_set('session.gc_maxlifetime', 120960);
    ini_set('session.cookie_lifetime', 120960);
    session_start();

    # MEMCACHE
    $memcache = null;
    if (!extension_loaded('memcache') && function_exists('dl') ) {
        if ( dl('memcache.so') ) {
            if( class_exists('Memcache') ){
                $memcache = new Memcache();
                $memcache->addServer ("localhost");
            }
        }
    }
    else {
        if( class_exists('Memcache') ){
            $memcache = new Memcache();
            $memcache->addServer ("localhost");
        }
    }

    $current_config = 'degerio';
    $current_config = 'live';

    $force_block_ssl = true;
    if( '127.0.0.1' == $_SERVER['REMOTE_ADDR'] ){
        $current_config = 'degerio';
        $force_block_ssl = true;
    }

    if( isLocal() ){
        error_reporting(E_ALL);
        ini_set('display_errors',1);
    }

    $dbConfigs = array(
		'degerio'   => array(
		    'dbHost' => 'localhost',
		    'dbUser' => 'root',
		    'dbPass' => '',
		    'dbName' => 'equipment_scheduler'
		),
		'live'      => array(
		    'dbHost' => 'localhost',
		    'dbUser' => 'equipmen_1',
		    'dbPass' => '-+*hncBipR@W',
		    'dbName' => 'equipmen_1'
		),
	);

    $default_settings = array(
        'degerio'   => array(
            'title'     => 'Equipment Scheduler',
            'homeurl'   => 'http://localhost/equipment-scheduler/',
        ),
        /*'live'      => array(
            'title'     => 'Equipment Scheduler',
            'homeurl'   => 'http://198.74.54.154/~equipmen/',
            'shomeurl'   => 'https://198.74.54.154/~equipmen/',
        ),*/

/*
        'live'      => array(
            'title'     => 'Equipment Scheduler',
            'homeurl'   => 'http://198.74.54.154/~equipmen/',
            'shomeurl'   => 'https://198.74.54.154/~equipmen/index.php?page=',
        ),
*/

        'live'      => array(
            'title'     => 'Equipment Scheduler',
            'homeurl'   => 'http://equipment.normaneckinger.com/',
            'shomeurl'   => 'https://equipment.normaneckinger.com/',
        ),
    );

    # Do not change this key before backup all database and saving old key.
    $security_settings = array(
        'degerio'   => array(
            'crypt_on'  => true,
            'crypt_key' => 'Z5asM{LUAnqnQE1jgtOs',
            'crypt_iv'  => 'g~HMCJt$',
        ),
        'live'      => array(
            'crypt_on'  => true,
            'crypt_key' => 'Z5asM{LUAnqnQE1jgtOs',
            'crypt_iv'  => 'g~HMCJt$',
        ),
    );

    $email_settings = array(
        'degerio'   => array(
            'no-reply'  => 'no-reply@ohio.cooldev.net',
            'admin'     => 'admin@ohio.cooldev.net',
            'support'   => 'support@ohio.cooldev.net',
        ),
        /*'live'   => array(
            'no-reply'  => 'no-reply@ocabest.org',
            'admin'     => 'admin@ocabest.org',
            'support'   => 'support@ocabest.org',
            'user'      => 'ocabest',
            'pass'      => 'BESToc@1',
        ),*/
    );

    $site_url = $default_settings[$current_config]['homeurl'];
    $site_url = empty( $_SERVER["HTTPS"] ) ? $site_url : $default_settings[$current_config]['shomeurl'] ;

?>