<?php

    include('includes/url-mapper.php');

    if( 'admin' == $controller ){
        require('admin-backend.php');
        exit;
    }

    include('includes/class.db.mysqli.php');
    include('includes/class.user.php');
    include('includes/class.crypt.php');

    include('includes/common.php');
    include('includes/config.php');
    require_once 'libs/smarty3/Smarty.class.php';

    $db = db_connect();
    $tpl = new Smarty();
    $tpl->error_reporting = E_ALL & ~E_NOTICE;
    $crypter = new Crypter();
    setDefaultTemplateVariables();

    $currentUser = new User();
    $tpl->assign( 'user_logged', $currentUser->is_logged );

    $page = !empty( $page ) ? $page : 'login';

    $block_ssl = !empty( $_POST['registration_confirmation'] );

    if( !$force_block_ssl && !$block_ssl && $page !== 'registration' && $currentUser->is_logged && ( empty( $_SERVER["HTTPS"] ) || $_SERVER["HTTPS"] !== "on" ) ){
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }

    if( $currentUser->is_logged && $page !== 'logout'){
        redirect( 'admin/' );
    }

    $errors = array();

    if( !empty( $_POST ) ){
        foreach( $_POST as $k => $v ){
            if( !is_array( $v ) ){
                $_POST[ $k ] = trim( $v );
            }
        }
    }

    switch( $page ){

        case 'ajax':{

            $action = !empty( $_POST['action'] ) ? $_POST['action'] : '' ;
            $status = false;
            $response = '';

            switch( $action ){
                case 'remove_nomination':{
                    if( $currentUser->is_logged ){

                        $id = !empty( $_POST['id'] ) ? $_POST['id'] : '' ;

                        /*$result = $db->delete(
                            'animals',
                            array(
                                'id'        =>  $id,
                                'user_id'   =>  $currentUser->id,
                                'payed'     =>  0,
                            )
                        );*/
                        $currentUser->removeCardAnimal($id);

                        if( !$result ){
                            $response = 'Error';
                        }
                    }

                    echo json_encode(array(
                        'response'  =>  $response,
                        'status'    =>  true,
                    ));
                } break;
                case 'get-showmanship-class': {
                    if( isset( $_POST['birth_date'] ) && isset( $_POST['best'] ) ){
                        $response = getShowmanshipClass( $_POST['birth_date'], $_POST['best'] );
                        if( $response ){
                            $status = true;
                        }
                    }
                    else{
                        $response = 'Missing parameter';
                    }
                    echo json_encode(array(
                        'response'  =>  $response,
                        'status'    =>  $status,
                    ));
                } break;
                default:{
                    echo json_encode(array(
                        'response'  =>  '',
                        'status'    =>  true,
                    ));
                }
            }

            exit;
        }
        case 'login':{

            if( $currentUser->is_logged ){
                redirect('dashboard');
            }

            if( !empty( $_POST ) ){

                $username = !empty( $_POST['username'] ) ? $_POST['username'] : '';
                $password = !empty( $_POST['password'] ) ? $_POST['password'] : '';

                $currentUser->login( $username, $password );

                if( $currentUser->login( $username, $password ) ){

                    if( 'admin' !== $currentUser->role ){
                        redirect( 'dashboard' );
                    }
                    else{
                        redirect( 'admin/' );
                    }
                }
                else{
                    $tpl->assign( 'login_failed' , 1 );
                }

                $tpl->assign( 'username', $username );
            }

            $tpl->assign( 'title', 'Login');

            if( !empty( $_SESSION['user_message'] ) ){
                $tpl->assign( 'popup_message', $_SESSION['user_message'] );
                $_SESSION['user_message'] = '';
            }

            break;
        }
        case 'logout':{
            $currentUser->logout();
            redirect('home');
            break;
        }
        case 'forgot-password':{

            $tpl->assign( 'pageName', 'Forgot Password' );

            $error = '';

            if( !empty( $_POST ) ){

                $username = !empty( $_POST['username'] ) ? trim( $_POST['username'] ) : '';

                if( $username && checkEmail( $email ) ){

                    $user_data = $currentUser->getUserBy( 'username', $username );
                    if( $user_data ){
                        if( !sendEmail( 'forgot-password', $user_data['ID'] ) ){
                            $error = 'Password reminder is not available for your account. Please contact site owner about this issue.';
                        }
                        else{
                            $_SESSION['user_message'] = 'Your password has been sent to your email address.';
                            redirect('login');
                        }
                    }
                    else{
                        $error = 'User with this username doesn\'t exist';
                    }

                }
                else{
                    $error = 'Invalid email address.';
                }
            }

            $tpl->assign( 'error', $error );


            break;
        }

    }

    $tpl->error_reporting = E_ALL & ~E_NOTICE;
    $tpl->assign( 'curYear', date('Y') );
    $tpl->assign( 'page', $page );
    $tpl->assign( 'siteUrl', $site_url );
    $tpl->assign( 'homeUrl', $site_url );
    $tpl->display('index.tpl');
?>