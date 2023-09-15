<?php

    $admin_pages = array(

        'index.php',

        'ajax',
        'login',
        'logout',
        'dashboard',

        'save-reservation',

        'add-category',
        'edit-category',
        'delete-category',
        'categories',

        'add-equipment',
        'edit-equipment',
        'delete-equipment',
        'equipment',

        'add-job',
        'edit-job',
        'delete-job',
        'jobs',

        'add-user',
        'add-user-admin',
        'edit-user',
        'delete-user',
        'users',

        'calendar',
    );

    $user_pages = array(

        'index.php',

        '404',
        'ajax',
        'login',
        'logout',

        'dashboard',
        'calendar',
        'timecard',
        'add-entry',
        'schedule',
        'coworker-schedule',
        'calendar-reservation',
        'save-reservation',
        'my-reservations',
        'cancel-reservation',
        'view-equipment',
        'reserve-equipment',
    );

    $request_url = $_SERVER['REQUEST_URI'];
    if( preg_match( '/~equipmen\/mobile/ims', $request_url ) ){
    //if( preg_match( '/^\/mobile\/?/ims', $request_url ) ){
        $request_url = str_replace('/mobile/','',$request_url);

        /*$request_url = str_replace('~equipmen/index.php?','',$request_url);
        $page = !empty( $_GET['page'] ) ? $_GET['page'] : '';
        $controller = preg_match('/^admin\//',$page) ? 'admin' : 'user';*/

        $page = !empty( $_GET['page'] ) ? $_GET['page'] : '';// = preg_replace('/^admin\//','',$page);

        if( $page && !in_array( $page, $user_pages ) ){
            $page = '';
        }

        //$request_url = str_replace('/mobile/','',$request_url);
        //if( preg_match('/^((\/([^\/\?]+)\/?(\?(.*?))?)|\/?)$/ims',$request_url, $result ) ){
        if( preg_match('/^((([^\/\?]+)\/?(\?(.*?))?)|\/?)$/ims',$request_url, $result ) ){
            $controller = 'user';
        }
        else{
           $page = 404;
        }
        if( $page !== 404 ){
            if( empty( $page ) ){
                $page = !empty( $result[3] ) ? $result[3] : '';

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
        exit();
        /*if( $page && 'admin' == $controller && !in_array( $page, $admin_pages ) ){
            $page = 404;
        }
        if( $page && 'user' == $controller && !in_array( $page, $user_pages ) ){
            $page = 404;
        }*/



        //$_GET['page'] = $page;

        //$controller = $page == 404 ? '' : $controller;

    }
    else{
#################################
    if( '127.0.0.1' == $_SERVER['REMOTE_ADDR'] ){
        $request_url = str_replace('equipment-scheduler/','',$_SERVER['REQUEST_URI']);
        $request_url = str_replace('equipment.normaneckinger.com/mobile/','',$_SERVER['REQUEST_URI']);
        $force_block_ssl = true;
    } else {
        $request_url = str_replace('/mobile','',$_SERVER['REQUEST_URI']);
        $force_block_ssl = true;
    }

    $controller = '';
    if( preg_match('/^\/admin((\/([^\/\?]+)(\?(.*?))?)|\/?)$/ims', $request_url, $result ) ){
        $controller = 'admin';
    }
    else if( preg_match('/^((\/([^\/\?]+)\/?(\?(.*?))?)|\/?)$/ims',$request_url, $result ) ){
        $controller = 'user';
    }
    else{
       $page = 404;
    }

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
