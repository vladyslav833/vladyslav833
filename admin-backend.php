<?php



include('includes/class.db.mysqli.php');

include('includes/class.user.php');

include('includes/class.crypt.php');

require_once 'includes/Api2Pdf.php';


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

$apiClient = new Api2Pdf('a29e1c58-3a51-4697-b793-bd3c27e21b84');


$currentUser = new User();

$tpl->assign('user_logged', $currentUser->is_logged);


$page = !empty($page) ? $page : 'dashboard';


$errors = array();

$breadcrumbs = array();


$pageName = '';


if (!$currentUser->is_logged) {

    redirect('login');

}


if (!empty($force_block_ssl) && !empty($block_ssl) && $currentUser->is_logged && (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on")) {

    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);

    exit();

}


if (!empty($_POST)) {

    foreach ($_POST as $k => $v) {

        if (!is_array($v)) {

            $_POST[$k] = trim($v);

        }

    }

}

function getWeekSunSat($weekOffset) {
    $dt = new DateTime();
    $dt->setIsoDate($dt->format('o'), $dt->format('W') + $weekOffset);
    return array(
        'Sun' => $dt->modify('-1 day')->format('M jS, Y'),
        'Sun_date' => $dt->format('Y-m-d'),
        'Sat' => $dt->modify('+6 day')->format('M jS, Y'),
        'Sat_date' => $dt->format('Y-m-d'),
    );
}

switch ($page) {


    case 'ajax':
    {


        $response = $status = '';

        $action = !empty($_POST['action']) ? $_POST['action'] : '';

        switch ($action) {

            case 'get_jobs':{
                $job_list = $db->get_results("SELECT id, name FROM job ORDER BY name ASC", ARRAY_A);

                $date_array = array();
                $selected_time = !empty($_POST['selected_time']) ? $_POST['selected_time'] : "";
                if($selected_time && $selected_time != ""){
                    for($i = 0; $i < 7; $i++) {
                        array_push($date_array, date('Y-m-d', strtotime("+". $i ." day", strtotime($selected_time))));
                    }
                }

                echo json_encode(array(
                    'jobs'  =>  $job_list,
                    'status'    =>  true,
                    'data_time' => $date_array
                ));
            } break;
            case 'finalize':{
                $tids = $_POST['tids'];
                foreach ($tids as $k => $v) {
                    $result = $db->update('timecard', array('finalize' => 1), array('id' => $v));
                }
                echo json_encode(array(
                    'status'    =>  true,
                ));
            } break;
            case 'saveCard':{
                $tids = $_POST['tids'];
                $user_id = $_POST['userid'];
                foreach ($tids as $k => $v) {
                    if($v['id'] != "") {
                        $result = $db->update('timecard', array('time_worked' => $v['val'], 'description' => $v['description']), array('id' => $v['id']));
                    } else {
                        if($v['timestamp'] == "")
                            $result = $db->insert('timecard', array('user_id'=>$user_id, 'job_id'=>$v['jobid'], 'job_name'=> $v['job_name'], 'description' => $v['description'], 'time_worked' => $v['val'], 'timestamp' => date("Y-m-d"), 'mask_req' => $v['afp']));
                        else
                            $result = $db->insert('timecard', array('user_id'=>$user_id, 'job_id'=>$v['jobid'], 'job_name'=> $v['job_name'], 'description' => $v['description'], 'time_worked' => $v['val'], 'timestamp' => $v['timestamp'], 'mask_req' => $v['afp']));
                    }
                }
                echo json_encode(array(
                    'status'    =>  true,
                ));
            } break;
            case 'download':{
                $tableData = $_POST['tableData'];
                $fileContent = file_get_contents('includes/TimeCard.html', true);
                $fileContent = str_replace("{timecard_details}", $tableData, $fileContent);
                $result = $apiClient->chromeHtmlToPdf($fileContent);
                echo json_encode(array(
                    'status'    =>  true,
                    'data' => $result->getFile()
                ));
            } break;
            case 'checkSchedule':{
                $userid = $_POST['userid'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                $sql = "SELECT t.id as 'tid', t.user_id, t.job_id, j.name, t.start_date, t.end_date FROM tasks as t LEFT JOIN job j ON j.id = t.job_id WHERE hide_task=0 AND end_date >= '{$start_date}' AND start_date <= '{$end_date}'";

                $task_list = $db->get_results($sql, ARRAY_A);
                $jobs_array = array();
                foreach ($task_list as $k => $v) {
                    $user_ids = unserialize($v['user_id']);
                    if (in_array($userid, $user_ids)) {
                        $jobs_array[] = $v;
                    }
                }

                $timeoff_data = $db->get_row("SELECT id, start_date, end_date FROM timeoff WHERE end_date >= '{$start_date}' AND start_date <= '{$end_date}' AND worker_id='$userid'", ARRAY_A);

                echo json_encode(array(
                    'jobs'  =>  $jobs_array,
                    'timeoff' => $timeoff_data,
                    'status'    =>  true
                ));
            } break;
            case 'checkWorkerTimeOff':{
                $workerId = $_POST['workerId'];
                $user_data = $db->get_row("SELECT id, start_date, end_date FROM timeoff WHERE worker_id='$workerId'", ARRAY_A);
                if($user_data && $user_data['id']){
                    echo json_encode(array(
                        'userdata' => $user_data,
                        'status'    =>  true
                    ));
                } else {
                    echo json_encode(array(
                        'status'    =>  false
                    ));
                }
                /*echo json_encode(array(
                    'status'    =>  false,
                    'sql'=>"SELECT id, start_date, end_date FROM timeoff WHERE worker_id='$workerId'"
                ));*/
            } break;
            default:
                {

                echo json_encode(array(

                    'response' => '',

                    'status' => true,

                ));

                }

        }
        exit;
    }


    case 'dashboard':
    {

        $pageName = 'Dashboard';

        if (!$currentUser->is_logged) {

            redirect('admin/login');

        }


        redirect('admin/timecard');


    }
        break;


    case 'categories':
    {


        $pageName = 'Categories';


        $cat_list = $db->get_results("SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A);


        $tpl->assign('categories', $cat_list);


    }
        break;

    case 'delete-category':
    {

        if (!empty($_GET['id'])) {

            $id = addslashes(trim($_GET['id']));

            $db->delete('categories', array('id' => $id));

        }

        redirect('admin/categories');

    }
        break;

    case 'add-category':
    {

        if ('add-category' == $page) {

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


        if (!empty($_POST)) {


            $cat_name = !empty($_POST['name']) ? $_POST['name'] : '';


            if (!$cat_name) {

                $errors [] = 'Please enter category name';

            }


            if (empty($errors)) {

                $result = $db->insert('categories', array('category_name' => $cat_name));


                if ($result === false) {

                    $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                } else {

                    redirect('admin/categories');

                }

            }


            $tpl->assign('errors', $errors);

            $tpl->assign($_POST);


        }


    }
        break;


    case 'timecard':
    {
        $condition = "";
        $this_week = "n";
        $weekdays = getWeekSunSat(0);
        $thisSunday = $weekdays['Sun_date'];
        if(!empty($_GET['timestamp'])){
            $selected_time = addslashes(trim($_GET['timestamp']));
            if($selected_time === $thisSunday)
                $this_week = "y";
        } else {
            $this_week = "y";
            $selected_time = $thisSunday;
        }
        $tpl->assign('thisweek', $this_week);

        $selected_time_str = date('F j, Y', strtotime($selected_time));
        $selected_weekend_day = date('Y-m-d', strtotime("+6 day", strtotime($selected_time)));
        $condition = " WHERE timestamp >= '". $selected_time ."' AND timestamp <= '". $selected_weekend_day ."' ";
        $selected_wkend = date('l, F d, Y', strtotime("+6 day", strtotime($selected_time)));


        $tpl->assign('timestamp', $selected_time);
        $tpl->assign('selected_wkend', $selected_wkend);
        $tpl->assign('selected_time_str', $selected_time_str);

        $prev_week_days = array();
        for($i = 0; $i > -9; $i--) {
            $weekdays = getWeekSunSat($i);
            $prev_week_days[] = array(
                "week_day_label" => $weekdays['Sun']." - ".$weekdays['Sat'],
                "week_day_value" => $weekdays['Sun_date']
            );
        }
        $tpl->assign('prev_week_days', $prev_week_days);

        $pageName = 'Timecards';

        $sql = "
            SELECT
                t.id as 'tid',
                t.user_id,
                u.first_name,
                u.last_name,
                t.job_id,
                t.job_name,
                t.description,
                t.timestamp,
                t.time_worked,
                t.mask_time_worked,
                t.mask_req
            FROM timecard as t
            LEFT JOIN
                users u
            ON
                u.id = t.user_id
            ". $condition ."
            ORDER BY mask_req DESC
            ";

        $timecard_list = $db->get_results($sql, ARRAY_A);
        $job_list = array();
        $card_detail = array();
        if($selected_time != 0) {
            foreach ($timecard_list as $k => $v) {
                if($v['time_worked'] == 0 && $v['mask_time_worked'] == 0)
                    continue;
                $job_name = $v['job_name'];
                $job_number = 0;
                $jid = $v['job_id'];
                if ($jid != 0) {
                    $job_data = $db->get_row("SELECT name, job_num FROM job WHERE id='$jid'", ARRAY_A);
                    $job_name = $job_data['name'];
                    $timecard_list[$k]['job_title'] = $job_name;
                    $job_number = $job_data['job_num'];
                }
                if(array_key_exists($v['user_id'], $job_list)) {
                    $job_list[$v['user_id']]['total_hours'] += $v['time_worked'];
                    $job_list[$v['user_id']]['days_worked'][$v['timestamp']] = 1;
                    if($jid != 0 && !in_array($jid, $job_list[$v['user_id']]['job_id'])) {
                        $job_list[$v['user_id']]['job_id'][] = $jid;
                        $job_list[$v['user_id']]['job_name'] .= " | ".$job_name;
                    }
                    $job_list[$v['user_id']]['worker'] = $v['first_name']." ".$v['last_name'];
                } else {
                    $job_list[$v['user_id']] = array(
                        'total_hours' => $v['time_worked'],
                        'job_id' => array($jid),
                        'job_name' => $job_name,
                        'worker' => $v['first_name']." ".$v['last_name']
                    );
                    $job_list[$v['user_id']]['days_worked'][$v['timestamp']] = 1;
                }
                if($selected_time == $v['timestamp'] && $v['mask_req'])
                    if(array_key_exists('su', $job_list[$v['user_id']]))
                        $job_list[$v['user_id']]['su'] += $v['mask_time_worked'];
                    else
                        $job_list[$v['user_id']]['su'] = $v['mask_time_worked'];
                else if($selected_time <= $v['timestamp'] && strtotime("+1 day", strtotime($selected_time)) >= strtotime($v['timestamp']) && $v['mask_req'])
                    if(array_key_exists('mo', $job_list[$v['user_id']]))
                        $job_list[$v['user_id']]['mo'] += $v['mask_time_worked'];
                    else
                        $job_list[$v['user_id']]['mo'] = $v['mask_time_worked'];
                else if($selected_time <= $v['timestamp'] && strtotime("+2 day", strtotime($selected_time)) >= strtotime($v['timestamp']) && $v['mask_req'])
                    if(array_key_exists('tu', $job_list[$v['user_id']]))
                        $job_list[$v['user_id']]['tu'] += $v['mask_time_worked'];
                    else
                        $job_list[$v['user_id']]['tu'] = $v['mask_time_worked'];
                else if($selected_time <= $v['timestamp'] && strtotime("+3 day", strtotime($selected_time)) >= strtotime($v['timestamp']) && $v['mask_req'])
                    if(array_key_exists('we', $job_list[$v['user_id']]))
                        $job_list[$v['user_id']]['we'] += $v['mask_time_worked'];
                    else
                        $job_list[$v['user_id']]['we'] = $v['mask_time_worked'];
                else if($selected_time <= $v['timestamp'] && strtotime("+4 day", strtotime($selected_time)) >= strtotime($v['timestamp']) && $v['mask_req'])
                    if(array_key_exists('th', $job_list[$v['user_id']]))
                        $job_list[$v['user_id']]['th'] += $v['mask_time_worked'];
                    else
                        $job_list[$v['user_id']]['th'] = $v['mask_time_worked'];
                else if($selected_time <= $v['timestamp'] && strtotime("+5 day", strtotime($selected_time)) >= strtotime($v['timestamp']) && $v['mask_req'])
                    if(array_key_exists('fr', $job_list[$v['user_id']]))
                        $job_list[$v['user_id']]['fr'] += $v['mask_time_worked'];
                    else
                        $job_list[$v['user_id']]['fr'] = $v['mask_time_worked'];
                else if($selected_time <= $v['timestamp'] && strtotime("+6 day", strtotime($selected_time)) >= strtotime($v['timestamp']) && $v['mask_req'])
                    if(array_key_exists('sa', $job_list[$v['user_id']]))
                        $job_list[$v['user_id']]['sa'] += $v['mask_time_worked'];
                    else
                        $job_list[$v['user_id']]['sa'] = $v['mask_time_worked'];

                $jindex = 0;
                if(array_key_exists($jid, $card_detail) && array_key_exists($v['user_id'], $card_detail[$jid])){
                    if($jid == 0) {
                        $jindex = count($card_detail[$jid][$v['user_id']]['job_name']);
                        array_push($card_detail[$jid][$v['user_id']]['job_name'], $job_name);
                    }
                } else {
                    $card_detail[$jid][$v['user_id']] = array(
                        'tid' => $v['tid'],
                        'job_name' => array($job_name),
                        'job_number' => $job_number
                    );
                }
                if($selected_time != "") {
                    if($selected_time == $v['timestamp'])
                        $card_detail[$jid][$v['user_id']][$jindex]['su'] = array($v['time_worked'], $v['tid'], $v['mask_req'], $v['mask_time_worked'], $v['description']);
                    else if($selected_time <= $v['timestamp'] && strtotime("+1 day", strtotime($selected_time)) >= strtotime($v['timestamp']))
                        $card_detail[$jid][$v['user_id']][$jindex]['mo'] = array($v['time_worked'], $v['tid'], $v['mask_req'], $v['mask_time_worked'], $v['description']);
                    else if($selected_time <= $v['timestamp'] && strtotime("+2 day", strtotime($selected_time)) >= strtotime($v['timestamp']))
                        $card_detail[$jid][$v['user_id']][$jindex]['tu'] = array($v['time_worked'], $v['tid'], $v['mask_req'], $v['mask_time_worked'], $v['description']);
                    else if($selected_time <= $v['timestamp'] && strtotime("+3 day", strtotime($selected_time)) >= strtotime($v['timestamp']))
                        $card_detail[$jid][$v['user_id']][$jindex]['we'] = array($v['time_worked'], $v['tid'], $v['mask_req'], $v['mask_time_worked'], $v['description']);
                    else if($selected_time <= $v['timestamp'] && strtotime("+4 day", strtotime($selected_time)) >= strtotime($v['timestamp']))
                        $card_detail[$jid][$v['user_id']][$jindex]['th'] = array($v['time_worked'], $v['tid'], $v['mask_req'], $v['mask_time_worked'], $v['description']);
                    else if($selected_time <= $v['timestamp'] && strtotime("+5 day", strtotime($selected_time)) >= strtotime($v['timestamp']))
                        $card_detail[$jid][$v['user_id']][$jindex]['fr'] = array($v['time_worked'], $v['tid'], $v['mask_req'], $v['mask_time_worked'], $v['description']);
                    else if($selected_time <= $v['timestamp'] && strtotime("+6 day", strtotime($selected_time)) >= strtotime($v['timestamp']))
                        $card_detail[$jid][$v['user_id']][$jindex]['sa'] = array($v['time_worked'], $v['tid'], $v['mask_req'], $v['mask_time_worked'], $v['description']);
                }
            }
        }
        $tpl->assign('timecards', $job_list);
        $tpl->assign('details', $card_detail);
    }
        break;

    case 'jobs':
    {

        $pageName = 'Jobs';

        $filters = array();

        $filter_sql = '';

        if (!empty($_REQUEST['status']) && $_REQUEST['status'] && $_REQUEST['status'] != "unselected" && $_REQUEST['status'] != "all") {

            $status = $_REQUEST['status'];

            $filters['status'] = $status;

            $filter_sql = " WHERE status = '$status'";

        }

        $job_list = $db->get_results("SELECT id, name, job_num, status FROM job $filter_sql ORDER BY name ASC", ARRAY_A);

        $tpl->assign('filters', $filters);

        $tpl->assign('jobs', $job_list);

    }
        break;

    case 'delete-job':
    {

        if (!empty($_GET['id'])) {

            $id = addslashes(trim($_GET['id']));

            if (is_numeric($id)) {

                $db->delete('job', array('id' => $id));

                $db->delete('reservations', array('job_id' => $id));

            }

        }

        redirect('admin/jobs');

    }
        break;

    case 'add-job':

    case 'edit-job':
    {


        $job_id = !empty($_GET['id']) ? addslashes(trim($_GET['id'])) : 0;

        if ($job_id) {

            $job_data = $db->get_row("SELECT id as 'job_id', name, job_num, status, mgr_id, location, address1, address2, city, state, zip, link, contact, phone, notes FROM job WHERE id='$job_id'", ARRAY_A);

            if (!$job_data) {

                redirect('admin/jobs');

            } else {

                $tpl->assign($job_data);

            }

        }

        $user_id = !empty($_GET['user_id']) ? addslashes(trim($_GET['user_id'])) : 0;
        $tpl->assign('user_id', $user_id);

        $pageName = 'add-job' == $page ? 'Add Project' : 'Edit Project';


        $breadcrumbs = array(

            'Projects' => 'projects',

            $pageName => '',

        );

        $mgr_list = $db->get_results("SELECT id, first_name, last_name FROM users WHERE role='proj_mgr' or role='admin' ORDER BY username ASC", ARRAY_A);

        $tpl->assign('managers', $mgr_list);

        if (!empty($_POST)) {


            $job_id = !empty($_POST['job_id']) ? $_POST['job_id'] : 0;

            $job_name = !empty($_POST['name']) ? $_POST['name'] : '';

            $job_num = !empty($_POST['job_num']) ? $_POST['job_num'] : '';

            $status = !empty($_POST['status']) ? $_POST['status'] : 0;

            $mgr_id = !empty($_POST['mgr_id']) ? $_POST['mgr_id'] : 0;

            $location = !empty($_POST['location']) ? $_POST['location'] : '';

            $address1 = !empty($_POST['address1']) ? $_POST['address1'] : '';

            $address2 = !empty($_POST['address2']) ? $_POST['address2'] : '';

            $city = !empty($_POST['city']) ? $_POST['city'] : '';

            $state = !empty($_POST['state']) ? $_POST['state'] : '';

            $zip = !empty($_POST['zip']) ? $_POST['zip'] : '';

            $link = !empty($_POST['link']) ? $_POST['link'] : '';

            $contact = !empty($_POST['contact']) ? $_POST['contact'] : '';

            $phone = !empty($_POST['phone']) ? $_POST['phone'] : '';

            $notes = !empty($_POST['notes']) ? $_POST['notes'] : '';

            if (!$job_name) {

                $errors [] = 'Please enter job name';

            }

            if (!$status || $status == 0) {

                $errors [] = 'Please select Status';

            }

            if (!$mgr_id || $mgr_id == 0) {

                $errors [] = 'Please select Manager';

            }


            $exist_job = $db->get_var("SELECT id FROM job WHERE active='1' AND name = '$job_name' ");

            if ($exist_job && $exist_job !== $job_id) {

                $errors [] = 'Job with this name already exists';

            }


            if (empty($errors)) {

                if ($job_id) {

                    $result = $db->update(

                        'job',

                        array(

                            'name' => $job_name,

                            'job_num' => $job_num,

                            'status' => $status,

                            'mgr_id' => $mgr_id,

                            'location' => $location,

                            'address1' => $address1,

                            'address2' => $address2,

                            'city' => $city,

                            'state' => $state,

                            'zip' => $zip,

                            'link' => $link,

                            'contact' => $contact,

                            'phone' => $phone,

                            'notes' => $notes

                        ),

                        array(

                            'id' => $job_id

                        )

                    );

                } else {

                    $result = $db->insert('job',
                        array(
                            'name' => $job_name,

                            'job_num' => $job_num,

                            'status' => $status,

                            'mgr_id' => $mgr_id,

                            'location' => $location,

                            'address1' => $address1,

                            'address2' => $address2,

                            'city' => $city,

                            'state' => $state,

                            'zip' => $zip,

                            'link' => $link,

                            'contact' => $contact,

                            'phone' => $phone,

                            'notes' => $notes
                        )
                    );

                }


                if ($result === false) {

                    $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                } else {

                    redirect('admin/jobs');

                }

            }


            $tpl->assign('errors', $errors);

            $tpl->assign($_POST);


        }


    }
        break;

    case 'assign-job':
    {
        $job_id = !empty($_GET['job_id']) ? addslashes(trim($_GET['job_id'])) : 0;
        $tpl->assign('job_id', $job_id);

        $id = !empty($_GET['id']) ? addslashes(trim($_GET['id'])) : 0;

        if ($id) {

            $tasks_data = $db->get_row("SELECT id , job_id, user_id, start_date, end_date, hide_task, alert, alert_text, description FROM tasks WHERE id='$id'", ARRAY_A);

            if (!$tasks_data) {

                redirect('admin/tasks');

            } else {
                $tasks_data['workers'] = unserialize($tasks_data['user_id']);

                $tpl->assign($tasks_data);

            }

        }

        $user_id = !empty($_GET['user_id']) ? addslashes(trim($_GET['user_id'])) : 0;
        $tpl->assign('user_id', $user_id);

        $pageName = 'Assign Job';


        $breadcrumbs = array(

            'Jobs' => 'jobs',

            $pageName => '',

        );

        $mgr_list = $db->get_results("SELECT id, first_name, last_name FROM users WHERE role='user' AND 1='status' ORDER BY username ASC", ARRAY_A);

        $tpl->assign('users', $mgr_list);

        $job_list = $db->get_results("SELECT id, name FROM job ORDER BY name ASC", ARRAY_A);

        $tpl->assign('jobs', $job_list);

        if (!empty($_POST)) {

            $task_id = !empty($_POST['task_id']) ? $_POST['task_id'] : 0;

            $worker_id = $_POST['worker_id'];
            $worker_ids = serialize($worker_id);

            $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : '';

            $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : '';

            $alert = !empty($_POST['alert']) && $_POST['alert'] == "on" ? 1 : 0;

            $hide_task = !empty($_POST['hide_task']) && $_POST['hide_task'] == "on" ? 1 : 0;

            $alert_text = !empty($_POST['alert_text']) ? $_POST['alert_text'] : '';

            $description = !empty($_POST['description']) ? $_POST['description'] : '';

            if (!$task_id) {

                $errors [] = 'Please select task';

            }

            if ($worker_ids == "") {

                $errors [] = 'Please select worker';

            }

            if (!$start_date) {

                $errors [] = 'Please select start date';

            }

            if (!$end_date) {

                $errors [] = 'Please select end date';

            }


            if (empty($errors)) {

                if($task_id == "new") {

                    $new_name = !empty($_POST['newName']) ? $_POST['newName'] : '';

                    $new_proj = $db->insert('job',
                        array(
                            'name' => $new_name,

                            'status' => 1,

                            'mgr_id' => $currentUser->id,
                        )
                    );
                    if ($new_proj === false) {
                        $errors[] = 'Operation was failed, try again later or Contact site owned about this issue.';
                    } else {
                        $task_id = $db->insert_id;
                    }
                }

                if ($id) {

                    $result = $db->update(

                        'tasks',

                        array(

                            'job_id' => $task_id,

                            'user_id' => $worker_ids,

                            'start_date' => $start_date,

                            'end_date' => $end_date,

                            'hide_task' => $hide_task,

                            'alert' => $alert,

                            'alert_text' => $alert_text,

                            'description' => $description

                        ),

                        array(

                            'id' => $id

                        )

                    );

                } else {

                    $result = $db->insert('tasks',
                        array(
                            'job_id' => $task_id,

                            'user_id' => $worker_ids,

                            'start_date' => $start_date,

                            'end_date' => $end_date,

                            'hide_task' => $hide_task,

                            'alert' => $alert,

                            'alert_text' => $alert_text,

                            'description' => $description
                        )
                    );

                }


                if ($result === false) {

                    $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                } else {

                    redirect('admin/tasks');

                }

            }

            $tpl->assign('errors', $errors);

            $tpl->assign($_POST);


        }


    }
        break;

    case 'tasks':
    {
        $pageName = 'Jobs/Tasks';

        $filters = array();

        $filter_sql = '';

        if (!empty($_REQUEST['datefilter']) && $_REQUEST['datefilter']) {

            $filters['daterange'] = $_REQUEST['datefilter'];

        } else {
            $filters['daterange'] = "this";
        }

        $this_sunday = strtotime('sunday previous week');
        $this_saturday = strtotime('saturday this week');
        $start_date = $end_date = "";
        if($filters['daterange'] == "this") {
            $start_date = $this_sunday;
            $end_date = $this_saturday;

            $start = date("Y-m-d", $start_date);
            $end = date("Y-m-d", $end_date);
            $filter_sql = " WHERE t.end_date >= '$start' AND t.start_date <= '$end'";
        } else if($filters['daterange'] == "next") {
            $start_date = strtotime("+7 day 00:00", $this_sunday);
            $end_date = strtotime("+7 day 00:00", $this_saturday);

            $start = date("Y-m-d", $start_date);
            $end = date("Y-m-d", $end_date);
            $filter_sql = " WHERE t.end_date >= '$start' AND t.start_date <= '$end'";
        } else if($filters['daterange'] == "last") {
            $start_date = strtotime("-7 day 00:00", $this_sunday);
            $end_date = strtotime("-7 day 00:00", $this_saturday);

            $start = date("Y-m-d", $start_date);
            $end = date("Y-m-d", $end_date);
            $filter_sql = " WHERE t.end_date >= '$start' AND t.start_date <= '$end'";
        } else if($filters['daterange'] == "range") {
            if (!empty($_REQUEST['start_date']) && $_REQUEST['start_date']) {
                $start_date = strtotime($_REQUEST['start_date']);
            }

            if (!empty($_REQUEST['end_date']) && $_REQUEST['end_date']) {
                $end_date = strtotime($_REQUEST['end_date']);
            }
            $start = date("Y-m-d", $start_date);
            $end = date("Y-m-d", $end_date);
            $filter_sql = " WHERE t.start_date >= '$start' AND t.end_date <= '$end'";
        }
        $filters['start_date'] = $start_date;
        $filters['end_date'] = $end_date;

        $tpl->assign('filters', $filters);
        $sql = "

                SELECT
                    t.id as 'tid',

                    t.user_id,

                    t.start_date,

                    t.end_date,

                    j.name

                FROM

                    tasks t

                LEFT JOIN

                    job j

                ON

                    j.id = t.job_id

                $filter_sql

                ORDER BY t.id ASC

            ";

        $task_list = $db->get_results($sql, ARRAY_A);

        foreach ($task_list as $k => $v) {

            $user_ids = unserialize($v['user_id']);

            $username = "";

            foreach($user_ids as $key => $value) {

                if($value == 0)
                    continue;

                $user_data = User::getUserBy('id', $value);

                if($username == "")
                    $username = $user_data['first_name']." ".$user_data['last_name'];
                else
                    $username .= ", ".$user_data['first_name']." ".$user_data['last_name'];

            }
            $task_list[$k]['user_id'] = $username;

        }

        $tpl->assign('tasks', $task_list);

    }
        break;

    case 'equipment':
    {


        $pageName = 'Equipment';


        $filters = array();

        $filter_sql = '';


        if (!empty($_REQUEST['category']) && $_REQUEST['category'] && is_numeric($_REQUEST['category'])) {

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

        $equipment_list = $db->get_results($sql, ARRAY_A);


        $cat_list = $db->get_results("SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A);

        $tpl->assign('categories', $cat_list);


        $tpl->assign('filters', $filters);

        $tpl->assign('equipment', $equipment_list);


    }
        break;

    case 'delete-equipment':
    {

        if (!empty($_GET['id'])) {

            $id = addslashes(trim($_GET['id']));

            if (is_numeric($id)) {

                $db->delete('equipment', array('id' => $id));

                $db->delete('reservations', array('equipment_id' => $id));

            }

        }

        redirect('admin/equipment');

    }
        break;

    case 'add-equipment':
    {

        //case 'edit-equipment':{

        /*if( !empty( $_GET['id'] ) ){

            $id = addslashes( trim( $_GET['id'] ) );

        }*/

        if ('add-equipment' == $page) {

            $pageName = 'Add Equipment';

        }


        $breadcrumbs = array(

            'Equipment' => 'equipment',

            'Add equipment' => '',

        );


        $cat_list = $db->get_results("SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A);

        $tpl->assign('categories', $cat_list);


        if (!empty($_POST)) {


            $equip_cat = !empty($_POST['category']) ? $_POST['category'] : '0';

            $equip_name = !empty($_POST['equip_type']) ? $_POST['equip_type'] : '';


            if (!$equip_cat) {

                $errors [] = 'Please select equipment category';

            }


            if (!$equip_name) {

                $errors [] = 'Please enter equipment type';

            }


            if (empty($errors)) {

                $result = $db->insert(

                    'equipment',

                    array(

                        'equipment_name' => $equip_name,

                        'category_id' => $equip_cat,

                    )

                );


                if ($result === false) {

                    $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                } else {

                    redirect('admin/equipment');

                }

            }


            $tpl->assign('errors', $errors);

            $tpl->assign($_POST);


        }


    }
        break;

    case 'reserve-equipment':
    {


        $pageName = 'Make Equipment Reservation';


        if (!empty($_POST)) {


            $equip_id = !empty($_POST['equip_id']) ? $_POST['equip_id'] : 0;

            $user_id = !empty($_POST['user_id']) ? $_POST['user_id'] : 0;

            $job_id = !empty($_POST['job_id']) ? $_POST['job_id'] : 0;

            $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : 0;

            $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : 0;

            $mk_reserv = !empty($_POST['make_reservation']) ? $_POST['make_reservation'] : 0;


            if ($equip_id && $mk_reserv) {

                redirect('admin/reserve-equipment&id=' . $equip_id);

            }


            if (!$equip_id || !$user_id || !$job_id) {

                redirect('admin/equipment ');

            }


            if (

                $start_date &&

                $end_date &&

                strtotime($start_date) > 0 &&

                strtotime($end_date) > 0 &&

                strtotime($start_date) <= strtotime($end_date)

            ) {


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


                $already_used = $db->get_var($sql);


                if ($already_used) {

                    $tpl->assign('alert_message', 'Sorry, this equipment already scheduled');

                } else {


                    $result = $db->insert(

                        'reservations',

                        array(

                            'user_id' => $user_id,

                            'job_id' => $job_id,

                            'equipment_id' => $equip_id,

                            'start_date' => $start_date,

                            'end_date' => $end_date,

                            'date_created' => date('Y-m-d H:i:s'),

                            'date_modified' => '0000-00-00 00:00:00',

                        )

                    );


                    if ($result) {

                        redirect('admin/confirm-reservation&id=' . $db->insert_id);

                    } else {

                        $errors[] = 'Unable create reservation';

                    }


                }


            }


        } else {


            $equip_id = !empty($_GET['id']) ? $_GET['id'] : 0;


            /*if( !$equip_id ){

                redirect( 'admin/equipment' );

            }*/


            $item = $db->get_row("SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment WHERE id = '$equip_id'", ARRAY_A);

            if ($equip_id && !$item) {

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

            $users = $db->get_results($sql, ARRAY_A);


            $job_list = $db->get_results("SELECT id, name FROM job ORDER BY name ASC", ARRAY_A);


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


            $reservations = $db->get_results($sql, ARRAY_A);


            if ($item) {

                $cat_name = $db->get_var("SELECT category_name FROM categories WHERE id = '" . $item['cat_id'] . "'");

                $tpl->assign('category', $cat_name);

                $tpl->assign('equipment', $item);

            } else {


                $cat_list = $db->get_results("SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A);

                $tpl->assign('categories', $cat_list);

                $quip_list = $db->get_results("SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment ORDER BY equipment_name ASC", ARRAY_A);

                $tpl->assign('equipment', $quip_list);


                $tpl->assign('make_reservation', true);

            }

            $tpl->assign('reservations', $reservations);

            $tpl->assign('users', $users);

            $tpl->assign('jobs', $job_list);


        }


    }
        break;

    case 'confirm-reservation':
    {


        $pageName = 'Calendar';


        $res_id = !empty($_GET['id']) ? $_GET['id'] : 0;


        if (!$res_id) {

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

        $reservation = $db->get_row($sql, ARRAY_A);

        if ($reservation) {

            $reservation['start_date_formated'] = date('F d, Y', strtotime($reservation['start_date']));

            $reservation['end_date_formated'] = date('F d, Y', strtotime($reservation['end_date']));

        }


        $tpl->assign($reservation);


    }
        break;


    case 'users':
    {

        $pageName = 'Users';

        $filters = array();

        $filter_sql = '';

        if (!empty($_REQUEST['userrole']) && $_REQUEST['userrole'] && $_REQUEST['userrole'] != "unselected") {

            $userrole = $_REQUEST['userrole'];

            $filters['userrole'] = $userrole;

            $filter_sql = " WHERE role = '$userrole'";

            if (isset($_POST['status'])) {
                $status = $_POST['status'] == 'active';
                $filter_sql .= " AND active = '$status'";
            }

        } else if (isset($_POST['status'])) {
            $status = $_POST['status'] == 'active';
            $filter_sql = " WHERE active = '$status'";
        }

        $sql = "

                SELECT

                    id,

                    first_name,

                    last_name,

                    username,

                    role,

                    active

                FROM

                    users

                $filter_sql

            ";


        $users = $db->get_results($sql, ARRAY_A);

        $tpl->assign('filters', $filters);

        $tpl->assign('users', $users);


    }
        break;

    case 'delete-user':
    {

        if (!empty($_GET['id'])) {

            $id = addslashes(trim($_GET['id']));

            if (is_numeric($id)) {

                $db->delete('users', array('id' => $id));

                $db->delete('reservations', array('user_id' => $id));

            }

        }

        redirect('admin/users');

    }
        break;

    case 'add-user':

    case 'edit-user':
    {

        $user_id = !empty($_GET['id']) ? addslashes(trim($_GET['id'])) : 0;


        $pageName = $user_id ? 'Edit User' : 'Add User';


        $breadcrumbs = array(

            'Users' => 'users',

            $pageName => '',

        );


        if ($user_id) {

            $user_data = User::getUserBy('id', $user_id);

            if (!$user_data) {

                redirect('admin/users');

            } else {

                $user_data['user_id'] = $user_data['id'];

                $user_data['password1'] = $user_data['password'];

                $user_data['password2'] = $user_data['password'];

                $user_status = $db->get_results("SELECT active FROM users WHERE id = " . $user_data['id'], ARRAY_A);
                
                $user_data['status'] = $user_status[0]['active'];

                $tpl->assign($user_data);

            }

        }


        if (!empty($_POST)) {


            $user_id = !empty($_POST['user_id']) ? $_POST['user_id'] : '';


            $fname = !empty($_POST['first_name']) ? $_POST['first_name'] : '';

            $lname = !empty($_POST['last_name']) ? $_POST['last_name'] : '';

            $uname = !empty($_POST['username']) ? $_POST['username'] : '';

            if (!empty($_POST['is_admin']))
                $urole = 'admin';
            else if (!empty($_POST['is_proj_mgr']))
                $urole = 'proj_mgr';
            else
                $urole = 'user';

            if (isset($_POST['status'])) {
                $active = $_POST['status'];
            } else {
                $active = 0;
            }
                

            $pass1 = !empty($_POST['password1']) ? $_POST['password1'] : '';

            $pass2 = !empty($_POST['password2']) ? $_POST['password2'] : '';


            if (!$fname) {

                $errors [] = 'Please enter first name';

            }


            if (!$lname) {

                $errors [] = 'Please enter last name';

            }


            if (!$uname) {

                $errors [] = 'Please enter username';

            }


            $exist_id = User::isAlreadyExist($uname);

            if ($exist_id && $exist_id !== $user_id) {

                $errors [] = 'This username already used';

            }


            if ('admin' == $urole || 'proj_mgr' == $urole) {


                if (!$pass1) {

                    $errors [] = 'Please enter password';

                }


                if (!$pass2) {

                    $errors [] = 'Please enter password confirmation';

                }


                if ($pass1 !== $pass2) {

                    $errors [] = 'Password confirmation does not match password';

                }


            }


            if (empty($errors)) {


                if ($user_id) {

                    $result = $db->update(

                        'users',

                        array(

                            'first_name' => $fname,

                            'last_name' => $lname,

                            'username' => $uname,

                            'role' => $urole,

                            'password' => $pass1,

                            'active' => $active,

                        ),

                        array(

                            'id' => $user_id

                        )

                    );


                    if ($result < 0) {

                        $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                    } else {


                        if ($user_id == $currentUser->id) {

                            $currentUser->updateSession();

                        }


                        redirect('admin/users');

                    }


                } else {

                    $result = $db->insert(

                        'users',

                        array(

                            'first_name' => $fname,

                            'last_name' => $lname,

                            'username' => $uname,

                            'role' => $urole,

                            'password' => $pass1,

                            'active' => $active,

                        )

                    );


                    if ($result === false) {

                        $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                    } else {

                        redirect('admin/users');

                    }


                }


            }


            $tpl->assign('errors', $errors);

            $tpl->assign($_POST);


        }


    }
        break;

    case 'add-timeoff':
    {
        $pageName = 'Schedule Time Off';
        $breadcrumbs = array(
            'Users' => 'users',
            $pageName => '',
        );

        $mgr_list = $db->get_results("SELECT id, first_name, last_name FROM users WHERE role='user' AND 1='status' ORDER BY username ASC", ARRAY_A);
        $tpl->assign('users', $mgr_list);


        if (!empty($_POST)) {

            $worker_id = $_POST['worker_id'];

            $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : '';

            $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : '';

            $uid = !empty($_POST['uid']) ? $_POST['uid'] : '';

            if ($worker_id == "" || $worker_id == "0") {

                $errors [] = 'Please select worker';

            }

            if (!$start_date) {

                $errors [] = 'Please select start date';

            }

            if (!$end_date) {

                $errors [] = 'Please select end date';

            }


            if (empty($errors)) {

                if ($uid != "") {

                    $result = $db->update(

                        'timeoff',

                        array(

                            'start_date' => $start_date,

                            'end_date' => $end_date,

                        ),

                        array(

                            'worker_id' => $uid

                        )

                    );

                } else {

                    $result = $db->insert('timeoff',
                        array(
                            'worker_id' => $worker_id,

                            'start_date' => $start_date,

                            'end_date' => $end_date
                        )
                    );

                }


                if ($result === false) {

                    $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

                } else {

                    redirect('admin/add-timeoff');

                }

            }

            $tpl->assign('errors', $errors);

            $tpl->assign($_POST);

        }

    }
        break;

    case 'calendar':
    {
        $pageName = 'Calendar';

        $cat_list = $db->get_results("SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A);

        $job_list = $db->get_results("SELECT id, name FROM job ORDER BY name ASC", ARRAY_A);

        $usr_list = $db->get_results("SELECT id, first_name as 'fname', last_name as 'lname' FROM users ORDER BY first_name ASC, last_name ASC", ARRAY_A);

        $quip_list = $db->get_results("SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment ORDER BY equipment_name ASC", ARRAY_A);


        $tpl->assign('categories', $cat_list);

        $tpl->assign('jobs', $job_list);

        $tpl->assign('users', $usr_list);

        $tpl->assign('equipment', $quip_list);


    }
        break;

    case 'prj-calendar':
    {
        $pageName = 'Project Calendar';
        $breadcrumbs = array(
            'Calendar' => 'calendar',
            $pageName => '',
        );

        $job_list = $db->get_results("SELECT id, name FROM job ORDER BY name ASC", ARRAY_A);
        $tpl->assign('jobs', $job_list);


        if (!empty($_REQUEST['datefilter']) && $_REQUEST['datefilter']) {
            $filters['daterange'] = $_REQUEST['datefilter'];
        } else {
            $filters['daterange'] = "week";
        }

        if (!empty($_REQUEST['prjselect']) && $_REQUEST['prjselect']) {
            $filters['prjselect'] = $_REQUEST['prjselect'];
        } else {
            $filters['prjselect'] = 0;
        }

        if (!empty($_REQUEST['prj-name']) && $_REQUEST['prj-name']) {
            $filters['pname'] = $_REQUEST['pname'];
        } else {
            $filters['pname'] = "";
        }

        $this_sunday = strtotime('sunday previous week');
        $this_saturday = strtotime('saturday this week');
        $start_date = $end_date = "";
        if($filters['daterange'] == "week") {
            $start_date = $this_sunday;
            $end_date = $this_saturday;

            $start = date("Y-m-d", $start_date);
            $end = date("Y-m-d", $end_date);
        } else if($filters['daterange'] == "month") {
            $first_day_this_month = strtotime('first day of this month');
            $last_day_this_month = strtotime('last day of this month');

            $start_date = $first_day_this_month;
            $end_date = $last_day_this_month;

            $firstDay = date("Y-m-d D", $first_day_this_month);
            $lastDay = date("Y-m-d D", $last_day_this_month);

            $start = explode(" ", $firstDay)[0];
            $end = explode(" ", $lastDay)[0];
        } else if($filters['daterange'] == "range") {
            if (!empty($_REQUEST['start_date']) && $_REQUEST['start_date']) {
                $start_date = strtotime($_REQUEST['start_date']);
            }

            if (!empty($_REQUEST['end_date']) && $_REQUEST['end_date']) {
                $end_date = strtotime($_REQUEST['end_date']);
            }
            $firstDay = date("Y-m-d D", $start_date);
            $lastDay = date("Y-m-d D", $end_date);

            $start = explode(" ", $firstDay)[0];
            $end = explode(" ", $lastDay)[0];
        }
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $interval = $date1->diff($date2);

        $filters['start_date'] = $start_date;
        $filters['end_date'] = $end_date;
        $filters['difference_days'] = $date1->diff($date2)->days + 1;

        $first_date = new DateTime($start);
        $last_date = new DateTime($end);
        $date = $first_date;
        $month_headers = array();
        while ($date <= $last_date)
        {
            $year_month = $date->format('Y-m');
            if(array_key_exists($year_month, $month_headers))
                $month_headers[$year_month] += 1;
            else
                $month_headers[$year_month] = 1;
            $date->modify("+1 day");
        }
        $filters['month_headers'] = $month_headers;

        $first_date = new DateTime($start);
        $last_date = new DateTime($end);
        $date = $first_date;
        $week_headers = array();
        while ($date <= $last_date)
        {
            $first_of_week = clone($date);
            $day_of_week = $date->format('N');
            if($day_of_week == 7)
                $day_of_week = 0;
            $date->modify("+".(6-$day_of_week)." day");
            $last_of_week = $date;
            if($last_of_week > $last_date)
                $last_of_week = $last_date;
            $days = $first_of_week->diff($last_of_week)->days + 1;
            $week_days = array();
            $week_days['days'] = $days;
            $week_days['first_day'] = $first_of_week->format("M j");
            $week_days['last_day'] = $last_of_week->format("M j");

            $week_headers[$first_of_week->format('Y-m-d')] = $week_days;
            $date->modify("+1 day");
        }
        $filters['week_headers'] = $week_headers;

        $first_date = new DateTime($start);
        $last_date = new DateTime($end);
        $date = $first_date;
        $wname_headers = array();
        while ($date <= $last_date)
        {
            $first_date = clone($date);
            $wname_headers[$first_date->format("y-m-d")] = $first_date->format("D");
            $date->modify("+1 day");
        }
        $filters['wname_headers'] = $wname_headers;
        $tpl->assign('filters', $filters);

        $sql = "SELECT t.id as 'tid', t.user_id, t.start_date, t.end_date, j.name FROM tasks t LEFT JOIN job j ON j.id = t.job_id WHERE t.hide_task=0 AND t.end_date >= '$start' AND t.start_date <= '$end' AND t.job_id={$filters['prjselect']}";
        $task_list = $db->get_results($sql, ARRAY_A);
        $job_name = "";
        $workers = array();
        foreach ($task_list as $k => $v) {
            $user_ids = unserialize($v['user_id']);
            $username = "";
            foreach($user_ids as $key => $value) {
                if($value == 0)
                    continue;
                $user_data = User::getUserBy('id', $value);
                $username = $user_data['first_name']." ".$user_data['last_name'];

                if(!array_key_exists($username, $workers)) {
                    $first_date = new DateTime($start);
                    $last_date = new DateTime($end);
                    $date = $first_date;
                    $worker_schedule = array();
                    while ($date <= $last_date)
                    {
                        $first_date = clone($date);
                        $uStartDate = new DateTime($v['start_date']);
                        $uEndDate = new DateTime($v['end_date']);
                        if($first_date >= $uStartDate && $first_date <= $uEndDate) {
                            $worker_schedule[$first_date->format("Y-m-d")] = 1;
                        } else {
                            $worker_schedule[$first_date->format("Y-m-d")] = 0;
                        }
                        $date->modify("+1 day");
                    }
                    $workers[$username] = $worker_schedule;
                } else {
                    foreach($workers[$username] as $scheduleKey => $scheduleValue) {
                        $uStartDate = new DateTime($v['start_date']);
                        $uEndDate = new DateTime($v['end_date']);
                        $keyDate = new DateTime($scheduleKey);
                        if($keyDate >= $uStartDate && $keyDate <= $uEndDate)
                            $workers[$username][$scheduleKey] = 1;
                    }
                }
            }
            if($job_name == "")
                $job_name = $v['name'];
        }
        $tpl->assign('workers', $workers);
        $tpl->assign('selected_job', $job_name);

        $sql = "SELECT r.id as 'rid', r.user_id, r.start_date, r.end_date, e.equipment_name FROM reservations r LEFT JOIN equipment e ON r.equipment_id = e.id WHERE r.end_date >= '$start' AND r.start_date <= '$end' AND r.job_id={$filters['prjselect']}";
        $reservation_result = $db->get_results($sql, ARRAY_A);
        $reservations = array();
        foreach ($reservation_result as $k => $v) {
            if(!array_key_exists($v['equipment_name'], $reservations)) {
                $first_date = new DateTime($start);
                $last_date = new DateTime($end);
                $date = $first_date;
                $rSchedule = array();
                while ($date <= $last_date)
                {
                    $first_date = clone($date);
                    $uStartDate = new DateTime($v['start_date']);
                    $uEndDate = new DateTime($v['end_date']);
                    if($first_date >= $uStartDate && $first_date <= $uEndDate) {
                        $rSchedule[$first_date->format("Y-m-d")] = 1;
                    } else {
                        $rSchedule[$first_date->format("Y-m-d")] = 0;
                    }
                    $date->modify("+1 day");
                }
                $reservations[$v['equipment_name']] = $rSchedule;
            } else {
                foreach($reservations[$v['equipment_name']] as $scheduleKey => $scheduleValue) {
                    $uStartDate = new DateTime($v['start_date']);
                    $uEndDate = new DateTime($v['end_date']);
                    $keyDate = new DateTime($scheduleKey);
                    if($keyDate >= $uStartDate && $keyDate <= $uEndDate)
                        $reservations[$v['equipment_name']][$scheduleKey] = 1;
                }
            }
        }
        $tpl->assign('reservations', $reservations);
    }
        break;

    case 'wkr-calendar':
    {
        $pageName = 'Worker Calendar';
        $breadcrumbs = array(
            'Calendar' => 'calendar',
            $pageName => '',
        );

        $user_list = $db->get_results("SELECT id, first_name, last_name FROM users WHERE role='user'", ARRAY_A);
        $tpl->assign('users', $user_list);


        if (!empty($_REQUEST['datefilter']) && $_REQUEST['datefilter']) {
            $filters['daterange'] = $_REQUEST['datefilter'];
        } else {
            $filters['daterange'] = "week";
        }

        if (!empty($_REQUEST['usrselect']) && $_REQUEST['usrselect']) {
            $filters['usrselect'] = $_REQUEST['usrselect'];
        } else {
            $filters['usrselect'] = 0;
        }

        if (!empty($_REQUEST['uname']) && $_REQUEST['uname']) {
            $filters['uname'] = $_REQUEST['uname'];
        } else {
            $filters['uname'] = "";
        }

        $this_sunday = strtotime('sunday previous week');
        $this_saturday = strtotime('saturday this week');
        $start_date = $end_date = "";
        if($filters['daterange'] == "week") {
            $start_date = $this_sunday;
            $end_date = $this_saturday;

            $start = date("Y-m-d", $start_date);
            $end = date("Y-m-d", $end_date);
        } else if($filters['daterange'] == "month") {
            $first_day_this_month = strtotime('first day of this month');
            $last_day_this_month = strtotime('last day of this month');

            $start_date = $first_day_this_month;
            $end_date = $last_day_this_month;

            $firstDay = date("Y-m-d D", $first_day_this_month);
            $lastDay = date("Y-m-d D", $last_day_this_month);

            $start = explode(" ", $firstDay)[0];
            $end = explode(" ", $lastDay)[0];
        } else if($filters['daterange'] == "range") {
            if (!empty($_REQUEST['start_date']) && $_REQUEST['start_date']) {
                $start_date = strtotime($_REQUEST['start_date']);
            }

            if (!empty($_REQUEST['end_date']) && $_REQUEST['end_date']) {
                $end_date = strtotime($_REQUEST['end_date']);
            }
            $firstDay = date("Y-m-d D", $start_date);
            $lastDay = date("Y-m-d D", $end_date);

            $start = explode(" ", $firstDay)[0];
            $end = explode(" ", $lastDay)[0];
            //$filter_sql = " WHERE t.start_date >= '$start' AND t.end_date <= '$end'";
        }
        $filter_sql = " WHERE t.hide_task=0 AND t.end_date >= '$start' AND t.start_date <= '$end'";
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $interval = $date1->diff($date2);

        $filters['start_date'] = $start_date;
        $filters['end_date'] = $end_date;
        $filters['difference_days'] = $date1->diff($date2)->days + 1;

        $first_date = new DateTime($start);
        $last_date = new DateTime($end);
        $date = $first_date;
        $month_headers = array();
        while ($date <= $last_date)
        {
            $year_month = $date->format('Y-m');
            if(array_key_exists($year_month, $month_headers))
                $month_headers[$year_month] += 1;
            else
                $month_headers[$year_month] = 1;
            $date->modify("+1 day");
        }
        $filters['month_headers'] = $month_headers;

        $first_date = new DateTime($start);
        $last_date = new DateTime($end);
        $date = $first_date;
        $week_headers = array();
        while ($date <= $last_date)
        {
            $first_of_week = clone($date);
            $day_of_week = $date->format('N');
            if($day_of_week == 7)
                $day_of_week = 0;
            $date->modify("+".(6-$day_of_week)." day");
            $last_of_week = $date;
            if($last_of_week > $last_date)
                $last_of_week = $last_date;
            $days = $first_of_week->diff($last_of_week)->days + 1;
            $week_days = array();
            $week_days['days'] = $days;
            $week_days['first_day'] = $first_of_week->format("M j");
            $week_days['last_day'] = $last_of_week->format("M j");

            $week_headers[$first_of_week->format('Y-m-d')] = $week_days;
            $date->modify("+1 day");
        }
        $filters['week_headers'] = $week_headers;

        $first_date = new DateTime($start);
        $last_date = new DateTime($end);
        $date = $first_date;
        $wname_headers = array();
        while ($date <= $last_date)
        {
            $first_date = clone($date);
            $wname_headers[$first_date->format("y-m-d")] = $first_date->format("D");
            $date->modify("+1 day");
        }
        $filters['wname_headers'] = $wname_headers;
        $tpl->assign('filters', $filters);

        $sql = "SELECT t.id as 'tid', t.user_id, t.start_date, t.end_date, j.name FROM tasks t LEFT JOIN job j ON j.id = t.job_id $filter_sql";
        $task_list = $db->get_results($sql, ARRAY_A);
        $jobs = array();
        foreach ($task_list as $k => $v) {
            $user_ids = unserialize($v['user_id']);
            foreach($user_ids as $key => $value) {
                if($value == 0 || $value != $filters['usrselect'])
                    continue;

                $jname = $v['name'];
                if(!array_key_exists($jname, $jobs)) {
                    $first_date = new DateTime($start);
                    $last_date = new DateTime($end);
                    $date = $first_date;
                    $worker_schedule = array();
                    while ($date <= $last_date)
                    {
                        $first_date = clone($date);
                        $uStartDate = new DateTime($v['start_date']);
                        $uEndDate = new DateTime($v['end_date']);
                        if($first_date >= $uStartDate && $first_date <= $uEndDate)
                            $worker_schedule[$first_date->format("Y-m-d")] = 1;
                        else
                            $worker_schedule[$first_date->format("Y-m-d")] = 0;
                        $date->modify("+1 day");
                    }
                    $jobs[$jname] = $worker_schedule;
                } else {
                    foreach($jobs[$jname] as $scheduleKey => $scheduleValue) {
                        $uStartDate = new DateTime($v['start_date']);
                        $uEndDate = new DateTime($v['end_date']);
                        $keyDate = new DateTime($scheduleKey);
                        if($keyDate >= $uStartDate && $keyDate <= $uEndDate)
                            $jobs[$jname][$scheduleKey] = 1;
                    }
                }
            }
        }
        $tpl->assign('jobs', $jobs);

        $selected_name = "";
        $timeoff_headers = array();
        if($filters['usrselect']){
            $workerId = $filters['usrselect'];
            $user_data = User::getUserBy('id', $workerId);
            $selected_name = $user_data['first_name']." ".$user_data['last_name'];

            $timeoff_data = $db->get_row("SELECT start_date, end_date FROM timeoff WHERE worker_id='$workerId'", ARRAY_A);
            if($user_data && $user_data['id']) {
                $first_date = new DateTime($start);
                $last_date = new DateTime($end);
                $date = $first_date;
                while ($date <= $last_date)
                {
                    $first_date = clone($date);
                    $tStartDate = new DateTime($timeoff_data['start_date']);
                    $tEndDate = new DateTime($timeoff_data['end_date']);
                    if($first_date >= $tStartDate && $first_date <= $tEndDate)
                        $timeoff_headers[$first_date->format("Y-m-d")] = 1;
                    else
                        $timeoff_headers[$first_date->format("Y-m-d")] = 0;
                    $date->modify("+1 day");
                }
            }
        }
        $tpl->assign('timeoff_headers', $timeoff_headers);
        $tpl->assign('selected_user', $selected_name);

        $sql = "SELECT r.id as 'rid', r.user_id, r.start_date, r.end_date, e.equipment_name FROM reservations r LEFT JOIN equipment e ON r.equipment_id = e.id WHERE r.end_date >= '$start' AND r.start_date <= '$end' AND r.user_id={$filters['usrselect']}";
        $reservation_result = $db->get_results($sql, ARRAY_A);
        $reservations = array();
        foreach ($reservation_result as $k => $v) {
            if(!array_key_exists($v['equipment_name'], $reservations)) {
                $first_date = new DateTime($start);
                $last_date = new DateTime($end);
                $date = $first_date;
                $rSchedule = array();
                while ($date <= $last_date)
                {
                    $first_date = clone($date);
                    $uStartDate = new DateTime($v['start_date']);
                    $uEndDate = new DateTime($v['end_date']);
                    if($first_date >= $uStartDate && $first_date <= $uEndDate) {
                        $rSchedule[$first_date->format("Y-m-d")] = 1;
                    } else {
                        $rSchedule[$first_date->format("Y-m-d")] = 0;
                    }
                    $date->modify("+1 day");
                }
                $reservations[$v['equipment_name']] = $rSchedule;
            } else {
                foreach($reservations[$v['equipment_name']] as $scheduleKey => $scheduleValue) {
                    $uStartDate = new DateTime($v['start_date']);
                    $uEndDate = new DateTime($v['end_date']);
                    $keyDate = new DateTime($scheduleKey);
                    if($keyDate >= $uStartDate && $keyDate <= $uEndDate)
                        $reservations[$v['equipment_name']][$scheduleKey] = 1;
                }
            }
        }
        $tpl->assign('reservations', $reservations);
    }
        break;

    case 'calendar-details':
    {

        if (!empty($_POST)) {

            $type = !empty($_POST['calendar']) ? $_POST['calendar'] : '';

            $cat = !empty($_POST['category']) ? $_POST['category'] : 0;

            $job = !empty($_POST['job']) ? $_POST['job'] : 0;

            $usr = !empty($_POST['user']) ? $_POST['user'] : 0;

            $veo = !empty($_POST['view_equip_option']) ? $_POST['view_equip_option'] : 'user';

            $job_id = !empty($_POST['job_id']) ? $_POST['job_id'] : 0;

            $usr_id = !empty($_POST['user_id']) ? $_POST['user_id'] : 0;

            $equip_id = !empty($_POST['equip_id']) ? $_POST['equip_id'] : 0;

            $udate = !empty($_POST['use_date']) ? $_POST['use_date'] : 0;

            $sdate = !empty($_POST['start_date']) ? $_POST['start_date'] : 0;

            $edate = !empty($_POST['end_date']) ? $_POST['end_date'] : 0;


            if (!in_array($type, array('category', 'job', 'user'))) {

                $errors[] = 'Please select calendar type';

            } else {


                if ($udate) {

                    if (

                        (

                            $sdate && !preg_match('/^[\d]{4}-[\d]{2}-[\d]{2}$/', $sdate)

                        ) ||

                        (

                            $edate && !preg_match('/^[\d]{4}-[\d]{2}-[\d]{2}$/', $edate)

                        )

                    ) {

                        $errors[] = 'Incorrect Date Format';

                    }

                }


                $order_by = '';


                switch ($type) {

                    // equipment

                    case 'category':
                    {


                        $cat_name = $db->get_var("SELECT category_name FROM categories WHERE id='$cat'");

                        $pageName = 'Category Calendar: ' . $cat_name;


                        if (!$cat || !$cat_name) {

                            $errors[] = 'Please select category';

                        }


                        if ('single' == $veo) {


                            if (!$equip_id) {

                                $errors[] = 'Please select category';

                            } else {

                                $equip_name = $db->get_var("SELECT equipment_name FROM equipment WHERE id='$equip_id'");

                                $order_by = '`user_name` ASC, ';

                                $pageName .= ' - ' . $equip_name;

                            }


                        } else {

                            $order_by = 'user' == $veo ? ' `user_name` ASC, ' : ' j.name ASC, ';

                        }


                    }
                        break;

                    case 'job':
                    {


                        $veo = 'job';


                        $job_name = $db->get_var("SELECT name FROM job WHERE id='$job'");


                        if (!$job) {

                            $errors[] = 'Please select job';

                        } else {

                            $job_id = $job;

                        }


                        $pageName = 'Job Calendar: ' . $job_name;


                    }
                        break;

                    case 'user':
                    {


                        $veo = 'user';


                        $user_name = $db->get_var("SELECT CONCAT( first_name,' ', last_name ) as 'user_name' FROM users WHERE id='$usr'");


                        if (!$usr) {

                            $errors[] = 'Please select user';

                        } else {

                            $usr_id = $usr;

                        }


                        $pageName = 'User Calendar: ' . $user_name;


                    }
                        break;

                }


                if (empty($errors)) {


                    $date_period = $udate && ($sdate || $edate) ? ' AND ' . (("r.start_date >= '$sdate'") . ($sdate && $edate ? ' AND ' : '') . ("r.end_date <= '$edate'")) : '';

                    $date_period = !$udate ? " AND r.start_date >= '" . date('Y-m-d') . "'" : $date_period;

                    $equipm_filter = $veo && $usr_id ? " AND r.user_id = '$usr_id'" : '';

                    $equipm_filter = $veo && $equip_id ? " AND e.id = '$equip_id'" : $equipm_filter;

                    $equipm_filter = !$equipm_filter && $veo && $job_id ? " AND r.job_id = '$job_id'" : $equipm_filter;


                    $categr_filter = $cat ? " AND c.id = '$cat' " : '';


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


                    $results = $db->get_results($sql, ARRAY_A);


                    //$veo = 'single' == $veo ? 'user' : $veo;


                    $tpl->assign('results', $results);

                    $tpl->assign('veo', 'category' == $type ? $veo : false);

                    $tpl->assign('type', $type);

                    $tpl->assign('indexColor', 0);


                } else {

                    $tpl->assign($_POST);

                    $page = 'calendar';

                }


            }


        }

    }
        break;


    case 'edit-account':
    {


        $pageName = 'Edit Account';


        //$tpl->assign( 'errors', $errors );

        //$tpl->assign( $user_data );

    }
        break;


    case 'test':
    {


        /*for( $user_id = 1; $user_id < 121; $user_id++ ){

            User::deleteMetaById( $user_id, 'showmanship_class' );

            User::updateMetaById( $user_id, 'showmanship_class', getShowmanshipClass( User::getMetaById( $user_id, 'birth_date', true ), User::getMetaById( $user_id, 'yearprogram', true ) ) );

        }*/


        break;

    }

    default:
        $tpl->assign('page', $page);

}


if ($currentUser->is_logged) {

    $tpl->assign(

        'currentUser',

        array(

            'id' => $currentUser->id,

            'fname' => $currentUser->fname,

            'is_admin' => 'admin' == $currentUser->role

        )

    );

}


$tpl->assign('page', $page);

$tpl->assign('breadcrumbs', $breadcrumbs);

$tpl->assign('current_time', date('M d, Y g:ia') . ' EST');

$tpl->assign('page_name', stripslashes($pageName));

$tpl->assign('homeUrl', $site_url);

$tpl->assign('siteUrl', $site_url);

$tpl->assign('adminUrl', $site_url . 'admin/');

$tpl->display('index.tpl');

?>
