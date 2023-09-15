<?php

    $admin_pages = array(

        'index.php',

        'ajax',
        'login',
        'dashboard',

        'add-category',
        'edit-category',
        'delete-category',
        'categories',

        'add-equipment',
        'edit-equipment',
        'delete-equipment',
        'equipment',
        'reserve-equipment',
        'confirm-reservation',

        'add-job',
        'edit-job',
        'delete-job',
        'assign-job',
        'jobs',
        'tasks',

        'add-user',
        'add-user-admin',
        'edit-user',
        'delete-user',
        'users',
        'add-timeoff',

        'calendar',
        'calendar-details',
        'prj-calendar',
        'wkr-calendar',

        'timecard'
    );

    $user_pages = array(

        'index.php',

        '404',
        'test',
        'ajax',
        'login',
        'logout',
        'forgot-password',
    );

    $request_url = $_SERVER['REQUEST_URI'];

    if( false && preg_match( '/~equipmen/ims', $request_url ) ){

        $request_url = str_replace('~equipmen/index.php?','',$request_url);
        $page = !empty( $_GET['page'] ) ? urldecode( $_GET['page'] ) : '';
        $controller = preg_match('/^admin\//',$page) ? 'admin' : 'user';
        $page = $_GET['page'] = preg_replace('/^admin\//','',$page);

        if( $page && 'admin' == $controller && !in_array( $page, $admin_pages ) ){
            $page = 404;
        }
        if( $page && 'user' == $controller && !in_array( $page, $user_pages ) ){
            $page = 404;
        }

        $controller = $page == 404 ? '' : $controller;

    }
    else{

#################################
        if( '127.0.0.1' == $_SERVER['REMOTE_ADDR'] ){
            $request_url = str_replace('equipment-scheduler/','',$_SERVER['REQUEST_URI']);
            $request_url = str_replace('equipment.normaneckinger.com/','',$_SERVER['REQUEST_URI']);
            $force_block_ssl = true;
        }
        $controller = '';
        if( preg_match('/^\/admin((\/([^\/\?]+)\/?(\?(.*?))?)|\/?)$/ims', $request_url, $result ) ){
            $controller = 'admin';
        }
        else if( preg_match('/^((\/([^\/\?]+)\/?(\?(.*?))?)|\/?)$/ims',$request_url, $result ) ){
            $controller = 'user';
        }
        else{
            $page = 404;
        }

        // var_dump( $result );exit;

        if( $page !== 404 ){
            if( empty( $page ) ){
                $page = !empty( $result[3] ) ? $result[3] : '';
            }

            if( $page && 'admin' == $controller && !in_array( $page, $admin_pages ) ){
                $page = 404;
            }
            if( $page && 'user' == $controller && !in_array( $page, $user_pages ) ){
                $page = 404;
            }

            if( $page !== 404 && !empty( $result[3] ) ){
                foreach( explode('&', $result[5]) as $params ){
                    if( !$params ) continue;
                    $params = explode('=',$params);
                    $_GET[$params[0]] = isset($params[1]) ? $params[1] : NULL;
                }
            }
        }
        if( 404 == $page ){
            $controller = '';
        }
        //unset($page);
#################################

    }
    //$request_url = str_replace('~equipmen/index.php?','',$request_url);


    /*if( 'http://174.121.236.78' == $_SERVER['SERVER_NAME'] ){
        $request_url = str_replace('~equipmen/','',$request_url);
        $request_url = str_replace('.hmtl','',$request_url);
    }*/



?>
