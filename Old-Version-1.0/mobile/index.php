<?php

    include('includes/url-mapper.php');

    include('includes/class.db.mysqli.php');
    include('includes/class.user.php');
    include('includes/class.crypt.php');

    include('includes/common.php');
    include('includes/config.php');
    require_once '../libs/smarty3/Smarty.class.php';

    $db = db_connect();
    $tpl = new Smarty;
    $crypter = new Crypter();
    setDefaultTemplateVariables();

    $currentUser = new User();
    $tpl->assign( 'user_logged', $currentUser->is_logged );

    $page = !empty( $page ) ? $page : 'dashboard';

    $errors = array();
    $breadcrumbs = array();

    $pageName = 'Dashboard';

    if( !$currentUser->is_logged && 'login' !== $page ){
        redirect('login');
    }
    if( $currentUser->is_logged && 'login' == $page || 404 == $page ){
        redirect();
    }


    //$block_ssl = !empty( $_POST['registration_confirmation'] );

    /*if( !$force_block_ssl && !$block_ssl && $page !== 'registration' && $currentUser->is_logged && ( empty( $_SERVER["HTTPS"] ) || $_SERVER["HTTPS"] !== "on" ) ){
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }*/

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
        } break;
        case 'login':{

            if( $currentUser->is_logged ){
                redirect('dashboard');
            }

            if( !empty( $_POST ) ){

                $username = !empty( $_POST['username'] ) ? $_POST['username'] : '';
                $password = !empty( $_POST['password'] ) ? $_POST['password'] : '';

                $currentUser->login( $username, $password );

                if( $currentUser->login( $username, $password ) ){

                    redirect( );

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

        } break;
        case 'logout':{
            $currentUser->logout();
            redirect();
        } break;

        case 'reserve-equipment':
        case 'view-equipment':{

            $pageName = 'view-equipment' == $page ? 'View Equipment' : 'Reserve Equipment';

            $cat_list = $db->get_results( "SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A );
            $tpl->assign( 'categories', $cat_list );
            $quip_list = $db->get_results( "SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment ORDER BY equipment_name ASC", ARRAY_A );
            $tpl->assign( 'equipment', $quip_list );


        } break;

        case 'calendar':
        case 'calendar-reservation':{

            $pageName = 'calendar' == $page ? 'Calendar' : 'Reservation Calendar';

            if( !empty( $_POST ) ){
                $equipment = !empty( $_POST['equipment'] ) ? $_POST['equipment'] : '';

                if( !$equipment ){
                    redirect('view-equipment');
                }

                $item = $db->get_row( "SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment WHERE id = '$equipment'", ARRAY_A );
                if( !$item ){
                    redirect('view-equipment');
                }

                $start_date = !empty( $_POST['start_date'] ) ? $_POST['start_date'] : 0;
                $end_date = !empty( $_POST['end_date'] ) ? $_POST['end_date'] : 0;

                if(
                    $start_date &&
                    $end_date &&
                    strtotime( $start_date ) > 0 &&
                    strtotime( $end_date ) > 0 &&
                    strtotime( $start_date ) <= strtotime( $end_date )
                ){

                    $sql = "
                        SELECT
                            1 as 'result'
                        FROM
                            reservations
                        WHERE
                            equipment_id = '$equipment' AND
                            (
                                start_date BETWEEN '$start_date' AND '$end_date' OR
                                end_date BETWEEN '$start_date' AND '$end_date' OR
                                $start_date BETWEEN start_date AND end_date OR
                                $end_date BETWEEN start_date AND end_date
                            )
                    ";

                    $already_used = $db->get_var( $sql );

                    if( $already_used ){
                        $tpl->assign( 'alert_message', 'Sorry, this equipment already scheduled' );
                    }
                    else{
                        $reservation_key = 'reservation_'.uniqid();
                        $_SESSION[ $reservation_key ] = array(
                            'start_date'    => $start_date,
                            'end_date'      => $end_date,
                            'equipment'     => $item,
                            'equipment_id'  => $equipment,
                        );

                        redirect( 'save-reservation?id='.$reservation_key );
                    }

                }

                $sql = "
                    SELECT
                        r.id,
                        u.first_name,
                        u.last_name,
                        j.name as 'job_name',
                        r.start_date,
                        r.end_date
                    FROM
                        reservations r,
                        job j,
                        users u
                    WHERE
                        r.equipment_id = '$equipment' AND
                        r.user_id = u.id AND
                        j.id = r.job_id
                    ORDER BY
                        r.start_date ASC
                ";

                $reservations = $db->get_results( $sql, ARRAY_A );

                $tpl->assign( 'equipment_id', $equipment );
                $tpl->assign( 'item', $item );
                $tpl->assign( 'reservations', $reservations );

            }

        } break;

        case 'save-reservation':{

            $pageName = 'Save Reservation';

            $sess_id = !empty( $_GET['id'] ) ? $_GET['id'] : false;

            if( ( !$sess_id || empty( $_SESSION[ $sess_id ] ) ) && empty( $_POST ) ){
                redirect('view-equipment');
            }
            elseif( !empty( $_POST ) ) {
                $sess_id = !empty( $_POST['reservation_id'] ) ? $_POST['reservation_id'] : '';
            }

            if( $sess_id ){

                $session_reservation = $_SESSION[ $sess_id ];

                $start_date     = !empty( $session_reservation['start_date'] )  ? $session_reservation['start_date'] : 0;
                $end_date       = !empty( $session_reservation['end_date'] )    ? $session_reservation['end_date'] : 0;
                $equipment_id   = !empty( $session_reservation['equipment_id'] )? $session_reservation['equipment_id'] : 0;
                $item           = !empty( $session_reservation['equipment'] )   ? $session_reservation['equipment'] : array();

                if( empty( $item ) || !$start_date || !$end_date || !$equipment_id ){
                    redirect('view-equipment');
                }

                $temp_item = $db->get_var( "SELECT 1 as 'result' FROM equipment WHERE id = '$equipment_id'" );
                if( !$temp_item ){
                    redirect('view-equipment');
                }

            }

            if( !empty( $_POST ) ){


                $job_id = !empty( $_POST['job_id'] ) ? $_POST['job_id'] : 0;
                $job_name = !empty( $_POST['job_name'] ) ? $_POST['job_name'] : '';

                if( !$job_name && !$job_id ){
                    $errors []= 'Please enter Job Name';
                }

                $exist_job_id = $db->get_var( "SELECT id FROM job WHERE active='1' AND name = '$job_name' " );

                if( $exist_job_id && $exist_job_id !== $job_id ){
                    $job_id = $exist_job_id;
                }

                if( !$job_id ){
                    $result = $db->insert(
                        'job',
                        array(
                            'name'          => $job_name,
                            'active'        => '1',
                            'date_created'  =>  date('Y-m-d H:i:s'),
                            'date_modified' =>  '0000-00-00 00:00:00'
                        )
                    );
                    if( $result ){
                        $job_id = $db->insert_id;
                    }
                    else{
                        $errors[] = 'Job was not created';
                    }
                }

                if( empty( $errors ) ){
                    $result = $db->insert(
                        'reservations',
                        array(
                            'user_id'       => $currentUser->id,
                            'job_id'        =>  $job_id,
                            'equipment_id'  =>  $equipment_id,
                            'start_date'    =>  $start_date,
                            'end_date'      =>  $end_date,
                            'date_created'  =>  date('Y-m-d H:i:s'),
                            'date_modified' =>  '0000-00-00 00:00:00',
                        )
                    );

                    if( $result ){
                        unset( $_SESSION[ $sess_id ] );
                        redirect('my-reservations');
                    }
                }


            }

            $job_list = $db->get_results( "SELECT id, name FROM job ORDER BY name ASC", ARRAY_A );
            $tpl->assign( 'jobs', $job_list );

            $tpl->assign( 'item_name', $item['name'] );
            $tpl->assign( 'start_date', $start_date );
            $tpl->assign( 'end_date', $end_date );
            $tpl->assign( 'reservation_id', $sess_id );
            if( !empty( $errors ) ){
                $tpl->assign( 'alert_message', $errors );
            }

        } break;

        case 'my-reservations': {
            $pageName = 'My Reservations';

            $sql = "
                SELECT
                    r.id,
                    e.equipment_name,
                    j.name as 'job_name',
                    r.start_date,
                    r.end_date
                FROM
                    reservations r,
                    equipment e,
                    job j
                WHERE
                    r.user_id = '".$currentUser->id."' AND
                    r.equipment_id = e.id AND
                    j.id = r.job_id
                ORDER BY
                    r.start_date ASC
            ";
            $reservations = $db->get_results( $sql, ARRAY_A );
            $tpl->assign( 'reservations', $reservations );

        } break;

        case 'cancel-reservation': {

            $id = !empty( $_GET['id'] ) ? $_GET['id'] : 0;

            if( $id ){
                $db->delete(
                    'reservations',
                    array(
                        'id'        =>  $id,
                        'user_id'   =>  $currentUser->id
                    )
                );
            }

            redirect( 'my-reservations' );

        } break;

    }

    if( $currentUser->is_logged ){
        $tpl->assign( 'currentUser', array( 'fname' => $currentUser->fname ) );
    }

    $tpl->error_reporting = E_ALL & ~E_NOTICE;
    $tpl->assign( 'page', $page );
    $tpl->assign( 'pageName', $pageName );
    $tpl->assign( 'breadcrumbs', $breadcrumbs );
    $tpl->assign( 'siteUrl', $site_url );
    $tpl->assign( 'homeUrl', $site_url );
    $tpl->display('index.tpl');

?>