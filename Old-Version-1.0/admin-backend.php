<?php



    include('includes/class.db.mysqli.php');

    include('includes/class.user.php');

    include('includes/class.crypt.php');



    /*

    if (!class_exists('AuthorizeNetException')) {

        require_once 'libs/anet_php_sdk/AuthorizeNet.php';

    }



    if (!class_exists('Services_Twilio')) {

        require_once 'libs/twilio-php/Services/Twilio.php';

    }

    */



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



    $page = !empty( $page ) ? $page : 'dashboard';



    $errors = array();

    $breadcrumbs = array();



    $pageName = '';



    if( !$currentUser->is_logged ){

        redirect('login');

    }



    if( !empty( $force_block_ssl ) && !empty( $block_ssl ) && $currentUser->is_logged && ( empty( $_SERVER["HTTPS"] ) || $_SERVER["HTTPS"] !== "on" ) ){

        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);

        exit();

    }



    if( !empty( $_POST ) ){

        foreach( $_POST as $k => $v ){

            if( !is_array( $v ) ){

                $_POST[ $k ] = trim( $v );

            }

        }

    }



    switch( $page ){



        case 'ajax':{



            $response = $status = '';

            $action = !empty( $_POST['action'] ) ? $_POST['action'] : '' ;



            switch( $action ){

                default:{

                    echo json_encode(array(

                        'response'  =>  '',

                        'status'    =>  true,

                    ));

                }

            }



            exit;

        }



        case 'dashboard':{

            $pageName = 'Dashboard';

            if( !$currentUser->is_logged ){

                redirect('admin/login');

            }



            redirect('admin/equipment');



        } break;



        case 'categories': {



            $pageName = 'Categories';



            $cat_list = $db->get_results( "SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A );



            $tpl->assign( 'categories', $cat_list );



        } break;

        case 'delete-category': {

            if( !empty( $_GET['id'] ) ){

                $id = addslashes( trim( $_GET['id'] ) );

                $db->delete( 'categories' , array( 'id' => $id ) );

            }

            redirect('admin/categories');

        } break;

        case 'add-category':{

        //case 'edit-category':{

            /*if( !empty( $_GET['id'] ) ){

                $id = addslashes( trim( $_GET['id'] ) );

            }*/

            if( 'add-category' == $page ){

                $pageName = 'Add Category';

            }



            $breadcrumbs = array(

                'Categories' => 'categories',

                'Add Category' => '',

            );



            /*else{

                if( !empty( $id ) ){

                    $result = $db->get_var("SELECT category_name FROM JL_list WHERE JL_jobnum='$jobID' $add_sql");

                    if( !$result ){

                        $jobID = false;

                        redirect('admin/create-new-job');

                    }

                    $pageName = 'Edit Category';

                }

                else{

                    redirect('admin/categories');

                }

            }*/



            if( !empty( $_POST ) ){



                $cat_name = !empty( $_POST['name'] ) ? $_POST['name'] : '';



                if( !$cat_name ){

                    $errors []= 'Please enter category name';

                }



                if( empty( $errors ) ){

                    $result = $db->insert( 'categories', array( 'category_name' => $cat_name ) );



                    if( $result === false ){

                        $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                    }

                    else{

                        redirect('admin/categories');

                    }

                }



                $tpl->assign( 'errors', $errors );

                $tpl->assign( $_POST );



            }



        } break;



        case 'jobs': {



            $pageName = 'Jobs';



            $job_list = $db->get_results( "SELECT id, name FROM job ORDER BY name ASC", ARRAY_A );



            $tpl->assign( 'jobs', $job_list );



        } break;

        case 'delete-job': {

            if( !empty( $_GET['id'] ) ){

                $id = addslashes( trim( $_GET['id'] ) );

                if( is_numeric($id) ){

                    $db->delete( 'job' , array( 'id' => $id ) );

                    $db->delete( 'reservations' , array( 'job_id' => $id ) );

                }

            }

            redirect('admin/jobs');

        } break;

        case 'add-job':

        case 'edit-job':{



            $job_id = !empty( $_GET['id'] ) ? addslashes( trim( $_GET['id'] ) ) : 0;



            if( $job_id ){

                $job_data = $db->get_row("SELECT id as 'job_id', name FROM job WHERE id='$job_id'", ARRAY_A);

                if( !$job_data ){

                    redirect('admin/jobs');

                }

                else{

                    $tpl->assign($job_data);

                }

            }



            $pageName = 'add-job' == $page ? 'Add Job' : 'Edit Job';



            $breadcrumbs = array(

                'Jobs' => 'jobs',

                $pageName => '',

            );



            if( !empty( $_POST ) ){



                $job_id = !empty( $_POST['job_id'] ) ? $_POST['job_id'] : 0;

                $job_name = !empty( $_POST['name'] ) ? $_POST['name'] : '';



                if( !$job_name ){

                    $errors []= 'Please enter job name';

                }



                $exist_job = $db->get_var( "SELECT id FROM job WHERE active='1' AND name = '$job_name' " );

                if( $exist_job && $exist_job !== $job_id ){

                    $errors []= 'Job with this name already exists';

                }



                if( empty( $errors ) ){

                    if( $job_id ){

                        $result = $db->update(

                            'job',

                            array(

                                'name' => $job_name

                            ),

                            array(

                                'id'    => $job_id

                            )

                        );

                    }

                    else{

                        $result = $db->insert( 'job', array( 'name' => $job_name ) );

                    }





                    if( $result === false ){

                        $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                    }

                    else{

                        redirect('admin/jobs');

                    }

                }



                $tpl->assign( 'errors', $errors );

                $tpl->assign( $_POST );



            }



        } break;



        case 'equipment': {



            $pageName = 'Equipment';



            $filters = array();

            $filter_sql = '';



            if( !empty( $_REQUEST['category'] ) && $_REQUEST['category'] && is_numeric( $_REQUEST['category'] ) ){

                $category = $_REQUEST['category'];

                $filters['category'] = $category;

                $filter_sql = " WHERE e.category_id = '$category'";

            }



            $sql = "

                SELECT

                    e.id,

                    e.equipment_name as 'name',

                    c.category_name as 'cat_name',

                    c.id as 'cid'

                FROM

                    equipment e

                LEFT JOIN

                    categories c

                ON

                    c.id = e.category_id

                $filter_sql

            ";

            $equipment_list = $db->get_results( $sql , ARRAY_A );



            $cat_list = $db->get_results( "SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A );

            $tpl->assign( 'categories', $cat_list );



            $tpl->assign( 'filters', $filters );

            $tpl->assign( 'equipment', $equipment_list );



        } break;

        case 'delete-equipment': {

            if( !empty( $_GET['id'] ) ){

                $id = addslashes( trim( $_GET['id'] ) );

                if( is_numeric($id) ){

                    $db->delete( 'equipment' , array( 'id' => $id ) );

                    $db->delete( 'reservations' , array( 'equipment_id' => $id ) );

                }

            }

            redirect('admin/equipment');

        } break;

        case 'add-equipment':{

        //case 'edit-equipment':{

            /*if( !empty( $_GET['id'] ) ){

                $id = addslashes( trim( $_GET['id'] ) );

            }*/

            if( 'add-equipment' == $page ){

                $pageName = 'Add Equipment';

            }



            $breadcrumbs = array(

                'Equipment' => 'equipment',

                'Add equipment' => '',

            );



            $cat_list = $db->get_results( "SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A );

            $tpl->assign( 'categories', $cat_list );



            /*else{

                if( !empty( $id ) ){

                    $result = $db->get_var("SELECT equipment_name FROM JL_list WHERE JL_jobnum='$jobID' $add_sql");

                    if( !$result ){

                        $jobID = false;

                        redirect('admin/create-new-job');

                    }

                    $pageName = 'Edit equipment';

                }

                else{

                    redirect('admin/equipment');

                }

            }*/



            if( !empty( $_POST ) ){



                $equip_cat = !empty( $_POST['category'] ) ? $_POST['category'] : '0';

                $equip_name = !empty( $_POST['equip_type'] ) ? $_POST['equip_type'] : '';



                if( !$equip_cat ){

                    $errors []= 'Please select equipment category';

                }



                if( !$equip_name ){

                    $errors []= 'Please enter equipment type';

                }



                if( empty( $errors ) ){

                    $result = $db->insert(

                        'equipment',

                        array(

                            'equipment_name' => $equip_name,

                            'category_id' => $equip_cat,

                        )

                    );



                    if( $result === false ){

                        $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                    }

                    else{

                        redirect('admin/equipment');

                    }

                }



                $tpl->assign( 'errors', $errors );

                $tpl->assign( $_POST );



            }



        } break;

        case 'reserve-equipment': {



            $pageName = 'Make Equipment Reservation';



            if( !empty( $_POST ) ){



                $equip_id = !empty( $_POST['equip_id'] ) ? $_POST['equip_id'] : 0;

                $user_id = !empty( $_POST['user_id'] ) ? $_POST['user_id'] : 0;

                $job_id = !empty( $_POST['job_id'] ) ? $_POST['job_id'] : 0;

                $start_date = !empty( $_POST['start_date'] ) ? $_POST['start_date'] : 0;

                $end_date = !empty( $_POST['end_date'] ) ? $_POST['end_date'] : 0;

                $mk_reserv = !empty( $_POST['make_reservation'] ) ? $_POST['make_reservation'] : 0;



                if( $equip_id && $mk_reserv ){

                    redirect( 'admin/reserve-equipment&id='.$equip_id );

                }



                if( !$equip_id || !$user_id || !$job_id ){

                    redirect( 'admin/equipment ');

                }



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

                            equipment_id = '$equip_id' AND

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



                        $result = $db->insert(

                            'reservations',

                            array(

                                'user_id'       =>  $user_id,

                                'job_id'        =>  $job_id,

                                'equipment_id'  =>  $equip_id,

                                'start_date'    =>  $start_date,

                                'end_date'      =>  $end_date,

                                'date_created'  =>  date('Y-m-d H:i:s'),

                                'date_modified' =>  '0000-00-00 00:00:00',

                            )

                        );



                        if( $result ){

                            redirect( 'admin/confirm-reservation&id='.$db->insert_id );

                        }

                        else{

                            $errors[] = 'Unable create reservation';

                        }



                    }



                }





            }

            else{



                $equip_id = !empty( $_GET['id'] ) ? $_GET['id'] : 0;



                /*if( !$equip_id ){

                    redirect( 'admin/equipment' );

                }*/



                $item = $db->get_row( "SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment WHERE id = '$equip_id'", ARRAY_A );

                if( $equip_id && !$item ){

                    redirect('admin/equipment');

                }



                $sql = "

                    SELECT

                        id,

                        first_name,

                        last_name

                    FROM

                        users

                    ORDER BY

                        first_name ASC,

                        last_name ASC

                ";

                $users = $db->get_results( $sql, ARRAY_A );



                $job_list = $db->get_results( "SELECT id, name FROM job ORDER BY name ASC", ARRAY_A );





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

                        r.equipment_id = '$equip_id' AND

                        r.user_id = u.id AND

                        j.id = r.job_id

                    ORDER BY

                        r.start_date ASC

                ";



                $reservations = $db->get_results( $sql, ARRAY_A );



                if( $item ){

                    $cat_name = $db->get_var( "SELECT category_name FROM categories WHERE id = '".$item['cat_id']."'" );

                    $tpl->assign( 'category', $cat_name );

                    $tpl->assign( 'equipment', $item );

                }

                else{



                    $cat_list = $db->get_results( "SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A );

                    $tpl->assign( 'categories', $cat_list );

                    $quip_list = $db->get_results( "SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment ORDER BY equipment_name ASC", ARRAY_A );

                    $tpl->assign( 'equipment', $quip_list );



                    $tpl->assign('make_reservation',true);

                }

                $tpl->assign( 'reservations', $reservations );

                $tpl->assign( 'users', $users );

                $tpl->assign( 'jobs', $job_list );



            }



        } break;

        case 'confirm-reservation':{



            $pageName = 'Calendar';



            $res_id = !empty( $_GET['id'] ) ? $_GET['id'] : 0;



            if( !$res_id ){

                redirect('admin/reserve-equipment');

            }



            $sql = "

                SELECT

                    r.id,

                    e.equipment_name,

                    j.name as 'job_name',

                    CONCAT( u.first_name, ' ', u.last_name) as 'user_name',

                    r.start_date,

                    r.end_date

                FROM

                    reservations r,

                    equipment e,

                    job j,

                    users u

                WHERE

                    r.id = '$res_id' AND

                    r.equipment_id = e.id AND

                    r.job_id = j.id AND

                    r.user_id = u.id

            ";

            $reservation = $db->get_row( $sql, ARRAY_A );

            if( $reservation ){

                $reservation['start_date_formated'] = date('F d, Y', strtotime( $reservation['start_date'] ) );

                $reservation['end_date_formated'] = date('F d, Y', strtotime( $reservation['end_date'] ) );

            }



            $tpl->assign( $reservation );



        } break;



        case 'users': {

            $pageName = 'Users';



            $sql = "

                SELECT

                    id,

                    first_name,

                    last_name,

                    username,

                    role

                FROM

                    users

            ";



            $users = $db->get_results( $sql, ARRAY_A );



            $tpl->assign( 'users', $users );



        } break;

        case 'delete-user': {

            if( !empty( $_GET['id'] ) ){

                $id = addslashes( trim( $_GET['id'] ) );

                if( is_numeric($id) ){

                    $db->delete( 'users' , array( 'id' => $id ) );

                    $db->delete( 'reservations' , array( 'user_id' => $id ) );

                }

            }

            redirect('admin/users');

        } break;

        case 'add-user':

        case 'edit-user':{



            $user_id = !empty( $_GET['id'] ) ? addslashes( trim( $_GET['id'] ) ) : 0;



            $pageName = $user_id ? 'Edit User' : 'Add User';



            $breadcrumbs = array(

                'Users' => 'users',

                $pageName => '',

            );



            if( $user_id ){

                $user_data = User::getUserBy('id',$user_id);

                if( !$user_data ){

                    redirect( 'admin/users' );

                }

                else{

                    $user_data['user_id'] = $user_data['id'];

                    $user_data['password1'] = $user_data['password'];

                    $user_data['password2'] = $user_data['password'];

                    $tpl->assign($user_data);

                }

            }



            if( !empty( $_POST ) ){



                $user_id = !empty( $_POST['user_id'] ) ? $_POST['user_id'] : '';



                $fname = !empty( $_POST['first_name'] ) ? $_POST['first_name'] : '';

                $lname = !empty( $_POST['last_name'] ) ? $_POST['last_name'] : '';

                $uname = !empty( $_POST['username'] ) ? $_POST['username'] : '';

                $urole = !empty( $_POST['is_admin'] ) ? 'admin' : 'user';



                $pass1 = !empty( $_POST['password1'] ) ? $_POST['password1'] : '';

                $pass2 = !empty( $_POST['password2'] ) ? $_POST['password2'] : '';





                if( !$fname ){

                    $errors []= 'Please enter first name';

                }



                if( !$lname ){

                    $errors []= 'Please enter last name';

                }



                if( !$uname ){

                    $errors []= 'Please enter username';

                }



                $exist_id = User::isAlreadyExist( $uname );

                if( $exist_id && $exist_id !== $user_id ){

                    $errors []= 'This username already used';

                }



                if( 'admin' == $urole ){



                    if( !$pass1 ){

                        $errors []= 'Please enter password';

                    }



                    if( !$pass2 ){

                        $errors []= 'Please enter password confirmation';

                    }



                    if( $pass1 !== $pass2 ){

                        $errors []= 'Password confirmation does not match password';

                    }



                }



                if( empty( $errors ) ){



                    if( $user_id ){

                        $result = $db->update(

                            'users',

                            array(

                                'first_name'    => $fname,

                                'last_name'     => $lname,

                                'username'      => $uname,

                                'role'          => $urole,

                                'password'      => $pass1,

                            ),

                            array(

                                'id'            => $user_id

                            )

                        );



                        if( $result < 0 ){

                            $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                        }

                        else{



                            if( $user_id == $currentUser->id ){

                                $currentUser->updateSession();

                            }



                            redirect('admin/users');

                        }



                    }

                    else{

                        $result = $db->insert(

                            'users',

                            array(

                                'first_name'    => $fname,

                                'last_name'     => $lname,

                                'username'      => $uname,

                                'role'          => $urole,

                                'password'      => $pass1,

                            )

                        );



                        if( $result === false ){

                            $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                        }

                        else{

                            redirect('admin/users');

                        }



                    }









                }



                $tpl->assign( 'errors', $errors );

                $tpl->assign( $_POST );



            }



        } break;



        case 'calendar': {



            $pageName = 'Calendar';



            $cat_list = $db->get_results( "SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A );

            $job_list = $db->get_results( "SELECT id, name FROM job ORDER BY name ASC", ARRAY_A );

            $usr_list = $db->get_results( "SELECT id, first_name as 'fname', last_name as 'lname' FROM users ORDER BY first_name ASC, last_name ASC", ARRAY_A );

            $quip_list = $db->get_results( "SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment ORDER BY equipment_name ASC", ARRAY_A );



            $tpl->assign( 'categories', $cat_list );

            $tpl->assign( 'jobs', $job_list );

            $tpl->assign( 'users', $usr_list );

            $tpl->assign( 'equipment', $quip_list );



        } break;

        case 'calendar-details':{

            if( !empty( $_POST ) ){

                $type = !empty( $_POST['calendar'] ) ? $_POST['calendar'] : '';

                $cat = !empty( $_POST['category'] ) ? $_POST['category'] : 0;

                $job = !empty( $_POST['job'] ) ? $_POST['job'] : 0;

                $usr = !empty( $_POST['user'] ) ? $_POST['user'] : 0;

                $veo = !empty( $_POST['view_equip_option'] ) ? $_POST['view_equip_option'] : 'user';

                $job_id = !empty( $_POST['job_id'] ) ? $_POST['job_id'] : 0;

                $usr_id = !empty( $_POST['user_id'] ) ? $_POST['user_id'] : 0;

                $equip_id = !empty( $_POST['equip_id'] ) ? $_POST['equip_id'] : 0;

                $udate = !empty( $_POST['use_date'] ) ? $_POST['use_date'] : 0;

                $sdate = !empty( $_POST['start_date'] ) ? $_POST['start_date'] : 0;

                $edate = !empty( $_POST['end_date'] ) ? $_POST['end_date'] : 0;



                if( !in_array( $type, array('category','job','user') ) ){

                    $errors[]= 'Please select calendar type';

                }

                else{



                    if( $udate ){

                        if(

                            (

                                $sdate && !preg_match( '/^[\d]{4}-[\d]{2}-[\d]{2}$/', $sdate )

                            ) ||

                            (

                                $edate && !preg_match( '/^[\d]{4}-[\d]{2}-[\d]{2}$/', $edate )

                            )

                        ){

                            $errors[] = 'Incorrect Date Format';

                        }

                    }



                    $order_by = '';



                    switch( $type ){

                        // equipment

                        case 'category':{



                            $cat_name = $db->get_var("SELECT category_name FROM categories WHERE id='$cat'");

                            $pageName = 'Category Calendar: '.$cat_name;



                            if( !$cat || !$cat_name ){

                                $errors[] = 'Please select category';

                            }



                            if( 'single' == $veo ){



                                if( !$equip_id ){

                                    $errors[] = 'Please select category';

                                }

                                else{

                                    $equip_name = $db->get_var("SELECT equipment_name FROM equipment WHERE id='$equip_id'");

                                    $order_by = '`user_name` ASC, ';

                                    $pageName .= ' - '.$equip_name;

                                }



                            }

                            else{

                                $order_by = 'user' == $veo ? ' `user_name` ASC, ' : ' j.name ASC, ';

                            }







                        } break;

                        case 'job':{



                            $veo = 'job';



                            $job_name = $db->get_var("SELECT name FROM job WHERE id='$job'");



                            if( !$job ){

                                $errors[] = 'Please select job';

                            }

                            else{

                                $job_id = $job;

                            }



                            $pageName = 'Job Calendar: '.$job_name;



                        } break;

                        case 'user':{



                            $veo = 'user';



                            $user_name = $db->get_var("SELECT CONCAT( first_name,' ', last_name ) as 'user_name' FROM users WHERE id='$usr'");



                            if( !$usr ){

                                $errors[] = 'Please select user';

                            }

                            else{

                                $usr_id = $usr;

                            }



                            $pageName = 'User Calendar: '.$user_name;



                        } break;

                    }



                    if( empty( $errors ) ){



                        $date_period = $udate && ( $sdate || $edate ) ? ' AND '.( ( "r.start_date >= '$sdate'" ).( $sdate && $edate ? ' AND ' : '' ).( "r.end_date <= '$edate'" ) )  : '';

                        $date_period = !$udate ? " AND r.start_date >= '".date('Y-m-d')."'" : $date_period;

                        $equipm_filter = $veo && $usr_id  ? " AND r.user_id = '$usr_id'" : '';

                        $equipm_filter = $veo && $equip_id  ? " AND e.id = '$equip_id'" : $equipm_filter;

                        $equipm_filter = !$equipm_filter && $veo && $job_id  ? " AND r.job_id = '$job_id'" : $equipm_filter;



                        $categr_filter = $cat ? " AND c.id = '$cat' " : '' ;



                        $sql = "

                            SELECT

                                r.id as 'rid',

                                u.id as 'uid',

                                c.id as 'cid',

                                j.id as 'jid',

                                e.id as 'eid',

                                CONCAT( u.first_name,' ', u.last_name ) as 'user_name',

                                c.category_name as 'cat_name',

                                j.name as 'job_name',

                                e.equipment_name as 'equip_name',

                                r.start_date,

                                r.end_date

                            FROM

                                categories c,

                                reservations r,

                                equipment e,

                                job j,

                                users u

                            WHERE

                                j.active = 1 AND

                                r.equipment_id = e.id AND

                                r.user_id = u.id AND

                                r.job_id = j.id AND

                                c.id = e.category_id

                                $date_period

                                $equipm_filter

                                $categr_filter

                            ORDER BY

                                $order_by

                                e.equipment_name ASC,

                                r.start_date ASC

                        ";



                        $results = $db->get_results( $sql, ARRAY_A );



                        //$veo = 'single' == $veo ? 'user' : $veo;



                        $tpl->assign( 'results', $results );

                        $tpl->assign( 'veo', 'category' == $type ? $veo : false );

                        $tpl->assign( 'type', $type );

                        $tpl->assign( 'indexColor', 0 );



                    }

                    else{

                        $tpl->assign( $_POST );

                        $page = 'calendar';

                    }



                }



            }

        } break;



        case 'edit-account': {



            $pageName = 'Edit Account';



            //$tpl->assign( 'errors', $errors );

            //$tpl->assign( $user_data );

        } break;



        case 'test':{



            /*for( $user_id = 1; $user_id < 121; $user_id++ ){

                User::deleteMetaById( $user_id, 'showmanship_class' );

                User::updateMetaById( $user_id, 'showmanship_class', getShowmanshipClass( User::getMetaById( $user_id, 'birth_date', true ), User::getMetaById( $user_id, 'yearprogram', true ) ) );

            }*/







            break;

        }

        default: $tpl->assign( 'page', $page );

    }



    if( $currentUser->is_logged ){

        $tpl->assign(

            'currentUser',

            array(

                'id'    =>  $currentUser->id,

                'fname' =>  $currentUser->fname,

                'is_admin' => 'admin' == $currentUser->role

            )

        );

    }



    $tpl->assign( 'page', $page );

    $tpl->assign( 'breadcrumbs', $breadcrumbs );

    $tpl->assign( 'current_time', date('M d, Y g:ia').' EST' );

    $tpl->assign( 'page_name', stripslashes( $pageName ) );

    $tpl->assign( 'homeUrl', $site_url );

    $tpl->assign( 'siteUrl', $site_url );

    $tpl->assign( 'adminUrl', $site_url.'admin/' );

    $tpl->display('index.tpl');

?>