<?php

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
$tpl->assign('user_logged', $currentUser->is_logged);

$page = !empty($page) ? $page : 'dashboard';

$errors = array();
$breadcrumbs = array();

$pageName = 'Dashboard';

if (!$currentUser->is_logged && 'login' !== $page) {
    redirect('login');
}
if ($currentUser->is_logged && 'login' == $page || 404 == $page) {
    redirect();
}


//$block_ssl = !empty( $_POST['registration_confirmation'] );

/*if( !$force_block_ssl && !$block_ssl && $page !== 'registration' && $currentUser->is_logged && ( empty( $_SERVER["HTTPS"] ) || $_SERVER["HTTPS"] !== "on" ) ){
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}*/

$errors = array();

if (!empty($_POST)) {
    foreach ($_POST as $k => $v) {
        if (!is_array($v)) {
            $_POST[$k] = trim($v);
        }
    }
}

switch ($page) {

    case 'ajax':
    {

        $action = !empty($_POST['action']) ? $_POST['action'] : '';
        $status = false;
        $response = '';

        switch ($action) {
            case 'remove_nomination':
            {
                if ($currentUser->is_logged) {

                    $id = !empty($_POST['id']) ? $_POST['id'] : '';

                    $currentUser->removeCardAnimal($id);

                    if (!$result) {
                        $response = 'Error';
                    }
                }

                echo json_encode(array(
                    'response' => $response,
                    'status' => true,
                ));
            }
                break;
            case 'get-showmanship-class':
            {
                if (isset($_POST['birth_date']) && isset($_POST['best'])) {
                    $response = getShowmanshipClass($_POST['birth_date'], $_POST['best']);
                    if ($response) {
                        $status = true;
                    }
                } else {
                    $response = 'Missing parameter';
                }
                echo json_encode(array(
                    'response' => $response,
                    'status' => $status,
                ));
            }
                break;
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
        break;
    case 'login':
    {

        if ($currentUser->is_logged) {
            redirect('dashboard');
        }

        if (!empty($_POST)) {

            $username = !empty($_POST['username']) ? $_POST['username'] : '';
            $password = !empty($_POST['password']) ? $_POST['password'] : '';

            $currentUser->login($username, $password);

            if ($currentUser->login($username, $password)) {

                redirect();

            } else {
                $tpl->assign('login_failed', 1);
            }

            $tpl->assign('username', $username);
        }

        $tpl->assign('title', 'Login');

        if (!empty($_SESSION['user_message'])) {
            $tpl->assign('popup_message', $_SESSION['user_message']);
            $_SESSION['user_message'] = '';
        }

    }
        break;
    case 'logout':
    {
        $currentUser->logout();
        redirect();
    }
        break;

    case 'reserve-equipment':
    case 'view-equipment':
    {

        $pageName = 'view-equipment' == $page ? 'View Equipment' : 'Reserve Equipment';

        $cat_list = $db->get_results("SELECT id, category_name as 'name' FROM categories ORDER BY category_name ASC", ARRAY_A);
        $tpl->assign('categories', $cat_list);
        $quip_list = $db->get_results("SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment ORDER BY equipment_name ASC", ARRAY_A);
        $tpl->assign('equipment', $quip_list);


    }
        break;

    case 'calendar':
    case 'calendar-reservation':
    {

        $pageName = 'calendar' == $page ? 'Calendar' : 'Reservation Calendar';

        if (!empty($_POST)) {
            $equipment = !empty($_POST['equipment']) ? $_POST['equipment'] : '';

            if (!$equipment) {
                redirect('view-equipment');
            }

            $item = $db->get_row("SELECT id, equipment_name as 'name', category_id as 'cat_id' FROM equipment WHERE id = '$equipment'", ARRAY_A);
            if (!$item) {
                redirect('view-equipment');
            }

            $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : 0;
            $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : 0;

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
                            equipment_id = '$equipment' AND
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
                    $reservation_key = 'reservation_' . uniqid();
                    $_SESSION[$reservation_key] = array(
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'equipment' => $item,
                        'equipment_id' => $equipment,
                    );

                    redirect('save-reservation?id=' . $reservation_key);
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

            $reservations = $db->get_results($sql, ARRAY_A);

            $tpl->assign('equipment_id', $equipment);
            $tpl->assign('item', $item);
            $tpl->assign('reservations', $reservations);

        }

    }
        break;

    case 'save-reservation':
    {

        $pageName = 'Save Reservation';

        $sess_id = !empty($_GET['id']) ? $_GET['id'] : false;

        if ((!$sess_id || empty($_SESSION[$sess_id])) && empty($_POST)) {
            redirect('view-equipment');
        } elseif (!empty($_POST)) {
            $sess_id = !empty($_POST['reservation_id']) ? $_POST['reservation_id'] : '';
        }

        if ($sess_id) {

            $session_reservation = $_SESSION[$sess_id];

            $start_date = !empty($session_reservation['start_date']) ? $session_reservation['start_date'] : 0;
            $end_date = !empty($session_reservation['end_date']) ? $session_reservation['end_date'] : 0;
            $equipment_id = !empty($session_reservation['equipment_id']) ? $session_reservation['equipment_id'] : 0;
            $item = !empty($session_reservation['equipment']) ? $session_reservation['equipment'] : array();

            if (empty($item) || !$start_date || !$end_date || !$equipment_id) {
                redirect('view-equipment');
            }

            $temp_item = $db->get_var("SELECT 1 as 'result' FROM equipment WHERE id = '$equipment_id'");
            if (!$temp_item) {
                redirect('view-equipment');
            }

        }

        if (!empty($_POST)) {


            $job_id = !empty($_POST['job_id']) ? $_POST['job_id'] : 0;
            $job_name = !empty($_POST['job_name']) ? $_POST['job_name'] : '';

            if (!$job_name && !$job_id) {
                $errors [] = 'Please enter Job Name';
            }

            $exist_job_id = $db->get_var("SELECT id FROM job WHERE active='1' AND name = '$job_name' ");

            if ($exist_job_id && $exist_job_id !== $job_id) {
                $job_id = $exist_job_id;
            }

            if (!$job_id) {
                $result = $db->insert(
                    'job',
                    array(
                        'name' => $job_name,
                        'active' => '1',
                        'date_created' => date('Y-m-d H:i:s'),
                        'date_modified' => '0000-00-00 00:00:00'
                    )
                );
                if ($result) {
                    $job_id = $db->insert_id;
                } else {
                    $errors[] = 'Job was not created';
                }
            }

            if (empty($errors)) {
                $result = $db->insert(
                    'reservations',
                    array(
                        'user_id' => $currentUser->id,
                        'job_id' => $job_id,
                        'equipment_id' => $equipment_id,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'date_created' => date('Y-m-d H:i:s'),
                        'date_modified' => '0000-00-00 00:00:00',
                    )
                );

                if ($result) {
                    unset($_SESSION[$sess_id]);
                    redirect('my-reservations');
                }
            }


        }

        $job_list = $db->get_results("SELECT id, name FROM job ORDER BY name ASC", ARRAY_A);
        $tpl->assign('jobs', $job_list);

        $tpl->assign('item_name', $item['name']);
        $tpl->assign('start_date', $start_date);
        $tpl->assign('end_date', $end_date);
        $tpl->assign('reservation_id', $sess_id);
        if (!empty($errors)) {
            $tpl->assign('alert_message', $errors);
        }

    }
        break;

    case 'my-reservations':
    {
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
                    r.user_id = '" . $currentUser->id . "' AND
                    r.equipment_id = e.id AND
                    j.id = r.job_id
                ORDER BY
                    r.start_date ASC
            ";
        $reservations = $db->get_results($sql, ARRAY_A);
        $tpl->assign('reservations', $reservations);

    }
        break;

    case 'cancel-reservation':
    {

        $id = !empty($_GET['id']) ? $_GET['id'] : 0;

        if ($id) {
            $db->delete(
                'reservations',
                array(
                    'id' => $id,
                    'user_id' => $currentUser->id
                )
            );
        }

        redirect('my-reservations');

    }
        break;

    case 'timecard':
    {
        $pageName = 'Timecard';
        $last_week = !empty($_GET['add']) ? addslashes(trim($_GET['add'])) : "";
        $tpl->assign('last_week', $last_week);

        $temp_sunday = strtotime('sunday previous week');
        $temp_saturday = strtotime('saturday this week');
        if(date('N', strtotime("today")) == 7) {
            $temp_sunday = strtotime('sunday this week');
            $temp_saturday = strtotime('saturday next week');
        }
        $prev_sunday = $temp_sunday;
        $this_saturday = $temp_saturday;
        if($last_week != "") {
            $prev_sunday = strtotime("-7 day", $temp_sunday);
            $this_saturday = strtotime("-7 day", $temp_saturday);
        }

        $sunday = date('F jS', $prev_sunday);
        $saturday = date('F jS', $this_saturday);

        $tpl->assign('sunday', $sunday);
        $tpl->assign('saturday', $saturday);

        $last_week_sunday = date('Y-m-d', strtotime("-7 day", $temp_sunday));
        $last_week_saturday = date('Y-m-d', strtotime("-7 day", $temp_saturday));

        $sql = "
                SELECT
                    id,
                    job_id,
                    job_name,
                    description,
                    time_worked,
                    mask_time_worked,
                    timestamp,
                    finalize,
                    mask_req
                FROM
                    timecard
                WHERE
                    user_id = '" . $currentUser->id . "' AND
                    timestamp >= '". date("Y-m-d", $prev_sunday) ."' AND
                    timestamp <= '". date("Y-m-d", $this_saturday) ."'
                ORDER BY
                    timestamp DESC
            ";

        $timecard_data = $db->get_results($sql, ARRAY_A);
        $total_hours = 0;
        foreach ($timecard_data as $k => $v) {
            $job_id = $v['job_id'];
            if($v['mask_req'] == 0 && $v['time_worked'])
                $total_hours += $v['time_worked'];
            if($v['mask_req'] == 1 && $v['mask_time_worked'])
                $total_hours += $v['mask_time_worked'];
            $timecard_data[$k]['date_time'] = date('l, F jS', strtotime($v['timestamp']));
            if ($job_id != 0) {
                $job_data = $db->get_row("SELECT name FROM job WHERE id='$job_id'", ARRAY_A);
                $timecard_data[$k]['job_title'] = $job_data['name'];
            }
        }
        $hours = floor($total_hours);
        $minutes = ($total_hours - $hours) * 60;
        usort($timecard_data, function($a, $b){return $a['mask_req'] < $b['mask_req'];});
        $tpl->assign('total_hours', $hours." Hours ".$minutes." Minutes");
        $tpl->assign('tdata', $timecard_data);

        if($last_week == "") {
            $sql = "
                    SELECT
                        id,
                        job_id,
                        job_name,
                        description,
                        time_worked,
                        mask_time_worked,
                        timestamp,
                        finalize,
                        mask_req
                    FROM
                        timecard
                    WHERE
                        user_id = '" . $currentUser->id . "' AND
                        timestamp >= '". $last_week_sunday ."' AND
                        timestamp <= '". $last_week_saturday ."' AND
                        finalize = 0
                    ORDER BY
                        timestamp DESC
                ";

            $last_week_data = $db->get_results($sql, ARRAY_A);
            if ($last_week_data === false)
                $tpl->assign('canedit', false);
            else {
                $tpl->assign('canedit', true);
                $tpl->assign('lastedit', true);
            }
        } else {
            $tpl->assign('lastedit', false);
            $tpl->assign('canedit', true);
        }
    }
        break;

    case 'add-entry':
    {
        $pageName = 'Add Entry';
        $entry_id = !empty($_GET['id']) ? addslashes(trim($_GET['id'])) : 0;
        $last_week = !empty($_GET['add']) ? addslashes(trim($_GET['add'])) : "";
        $tpl->assign('last_week', $last_week);
        if ($entry_id) {

            $entry_data = $db->get_row("SELECT id, user_id, job_id, job_name, description, time_worked, mask_time_worked, timestamp, mask_req FROM timecard WHERE id='$entry_id'", ARRAY_A);

            if (!$entry_data) {

                redirect('timecard');

            } else {
                if($entry_data['job_id'] != 0) {
                    $jid = $entry_data['job_id'];
                    $job_data = $db->get_row("SELECT name FROM job WHERE id='$jid'", ARRAY_A);
                    $entry_data['job_title'] = $job_data['name'];
                }

                $tpl->assign($entry_data);

            }

        }
        $tpl->assign('entry_id', $entry_id);

        $sql = "
                SELECT
                    t.id as 'tid',
                    t.user_id,
                    t.job_id,
                    j.name,
                    t.start_date,
                    t.end_date
                FROM
                    tasks as t
                LEFT JOIN
                    job j
                ON
                    j.id = t.job_id
                ORDER BY t.id ASC

            ";

        $task_list = $db->get_results($sql, ARRAY_A);

        $prev_sunday = strtotime('sunday previous week');
        if(date('N', strtotime("today")) == 7) {
            $prev_sunday = strtotime('sunday this week');
        }
        $d = strtotime("today");
        $week_days = array();

        $this_saturday = strtotime('saturday this week');
        $last_week_sunday = strtotime("-7 day", $prev_sunday);
        $last_week_saturday = strtotime("-7 day", $this_saturday);

        if($last_week == ""){
            $today = date('F jS', $d);
            $week_days[] = array("time_string" => "Today - " . $today, "value" => date("Y-m-d", $d) );
            for ($i = 1; $i < 8; $i++) {
                $prev_day = strtotime("-$i day 00:00");
                if ($prev_day >= $prev_sunday) {
                    $week_days[] = array("time_string" => date('l - F jS', $prev_day), "value" => date("Y-m-d", $prev_day));
                }
            }
        } else {
            for ($i = 0; $i < 7; $i++) {
                $prev_day = strtotime("+$i day 00:00", $last_week_sunday);
                if ($prev_day <= $last_week_saturday) {
                    $week_days[] = array("time_string" => date('l - F jS', $prev_day), "value" => date("Y-m-d", $prev_day));
                }
            }
        }

        $tpl->assign('week_days', $week_days);

        $jobs_array = array();
        foreach ($task_list as $k => $v) {
            $user_ids = unserialize($v['user_id']);
            if (in_array($currentUser->id, $user_ids)) {
                $start_datetime = strtotime($v['start_date']);
                $end_datetime = strtotime($v['end_date']);
                if($last_week != "" && $start_datetime < $last_week_saturday && $end_datetime > $last_week_sunday)
                    $jobs_array[] = $v;
                else if($last_week == "" && $start_datetime < $this_saturday && $end_datetime >= $prev_sunday)
                    $jobs_array[] = $v;
            }
        }
        $tpl->assign('task_list', $jobs_array);

        if (!empty($_POST)) {
            if(!empty($_POST['job']) && $_POST['job'] != "new")
                $job_id = $_POST['job'];
            else
                $job_id = 0;
            $entry_id = !empty($_POST['entry_id']) ? $_POST['entry_id'] : 0;
            //$job_name = !empty($_POST['job-name']) ? $_POST['job-name'] : "";
            $job_name = "";
            $job_desc = !empty($_POST['job-desc']) ? $_POST['job-desc'] : "";
            $last_week = !empty($_POST['last_week']) ? $_POST['last_week'] : "";
            $hours = !empty($_POST['hours']) ? $_POST['hours'] : "";
            $mins = !empty($_POST['mins']) ? $_POST['mins'] : "";
            $timestamp = !empty($_POST['timestamp']) ? $_POST['timestamp'] : "";
            if($hours != "h" && $mins != "m")
                $total_hours = intval($hours) + intval($mins)/60;
            else
                $total_hours = 0;

            $mhours = !empty($_POST['mhours']) ? $_POST['mhours'] : "";
            $mmins = !empty($_POST['mmins']) ? $_POST['mmins'] : "";
            if($mhours != "hh" && $mmins != "mm")
                $total_mhours = intval($mhours) + intval($mmins)/60;
            else
                $total_mhours = 0;

            if($_POST['afp-check'] && $_POST['afp-check'] == "on")
                $mask_req = 1;
            else
                $mask_req = 0;

            if($entry_id) {
                $result = $db->update(
                    'timecard',
                    array(
                        'job_id' => $job_id,

                        'user_id' => $currentUser->id,

                        'job_name' => $job_name,

                        'time_worked' => $total_hours,

                        'mask_time_worked' => $total_mhours,

                        'timestamp' => $timestamp,

                        'description' => $job_desc,

                        'mask_req' => $mask_req
                    ),
                    array('id' => $entry_id)
                );
            } else {
                $result = $db->insert('timecard',
                    array(
                        'job_id' => $job_id,

                        'user_id' => $currentUser->id,

                        'job_name' => $job_name,

                        'time_worked' => $total_hours,

                        'mask_time_worked' => $total_mhours,

                        'timestamp' => $timestamp,

                        'description' => $job_desc,

                        'mask_req' => $mask_req
                    )
                );
            }

            if ($result === false) {

                $errors[] = 'Operation was failed, try again later or Contact siteowned about this issue.';

            } else {

                if($last_week != "")
                    redirect('timecard?add=last');
                else
                    redirect('timecard');

            }
        }
    }
        break;

    case 'schedule':
    {
        $pageName = 'Schedule';

        $delta = !empty($_POST['delta']) ? addslashes(trim($_POST['delta'])) : 0;
        $tpl->assign('delta', $delta);

        $today = date('l, F d, Y', strtotime($delta." days"));
        $tpl->assign('today', $today);

        $sql = "
                SELECT
                    t.id as 'tid',
                    t.job_id,
                    t.user_id,
                    t.alert,
                    t.alert_text,
                    t.description,
                    j.name,
                    j.mgr_id,
                    j.address1,
                    j.city,
                    j.state,
                    j.zip,
                    j.link,
                    j.contact,
                    j.phone,
                    j.notes
                FROM
                    tasks t
                LEFT JOIN
                    job j
                ON
                    j.id = t.job_id
                WHERE
                    hide_task = 0 AND
                    start_date <= (CURDATE() + INTERVAL ". $delta ." DAY) AND
                    end_date >= (CURDATE() + INTERVAL ". $delta ." DAY)
            ";

        $schedule_data = $db->get_results($sql, ARRAY_A);
        $jobs_array = array();
        foreach ($schedule_data as $k => $v) {
            $user_ids = unserialize($v['user_id']);
            if (in_array($currentUser->id, $user_ids)) {
                $uid = $v['mgr_id'];
                if($uid == 0) {
                    $user_name = "";
                } else {
                    $user_data = $db->get_row("SELECT first_name, last_name FROM users WHERE id='$uid'", ARRAY_A);
                    $user_name = $user_data['first_name']." ".$user_data['last_name'];
                }
                $link = $v['link'];
                if($link){
                    $file = basename($link);
                    $v['filename'] = $file;
                    if (strpos($link, 'drive/folders') !== false) {
                        $v['link'] = "https://drive.google.com/embeddedfolderview?id=".explode("?", $file)[0]."#grid";
                    }
                }

                $v['manager_name'] = $user_name;
                $jobs_array[] = $v;
            }
        }

        $tpl->assign('sdata', $jobs_array);
    }
        break;

    case 'coworker-schedule':
    {
        $pageName = 'Co-Worker Schedule';

        $delta = !empty($_POST['delta']) ? addslashes(trim($_POST['delta'])) : 0;
        $tpl->assign('delta', $delta);

        $today = date('l, F d, Y', strtotime($delta." days"));
        $tpl->assign('today', $today);

        $sql = "
                SELECT
                    t.id as 'tid',
                    t.job_id,
                    t.user_id,
                    t.description,
                    t.start_date,
                    t.end_date,
                    j.name,
                    j.mgr_id,
                    j.address1,
                    j.city,
                    j.state,
                    j.zip
                FROM
                    tasks t
                LEFT JOIN
                    job j
                ON
                    j.id = t.job_id
                WHERE
                    start_date <= (CURDATE() + INTERVAL ". $delta ." DAY) AND
                    end_date >= (CURDATE() + INTERVAL ". $delta ." DAY)
            ";

        $schedule_data = $db->get_results($sql, ARRAY_A);
        $jobs_array = array();
        foreach ($schedule_data as $k => $v) {
            $user_ids = unserialize($v['user_id']);
            foreach($user_ids as $ukey => $uid){
                if($uid == 0 || $uid == $currentUser->id) {
                    continue;
                } else {
                    $user_data = $db->get_row("SELECT first_name, last_name FROM users WHERE id='$uid'", ARRAY_A);
                    $user_name = $user_data['first_name']." ".$user_data['last_name'];
                }
                $v['user_name'] = $user_name;
                if (in_array($uid, $jobs_array)) {
                    array_push($jobs_array[$uid], $v);
                } else {
                    $jobs_array[$uid] = array($v);
                }
            }
        }
        $tpl->assign('sdata', $jobs_array);
    }
        break;
}

if ($currentUser->is_logged) {
    $tpl->assign('currentUser', array('fname' => $currentUser->fname));
}

$tpl->error_reporting = E_ALL & ~E_NOTICE;
$tpl->assign('page', $page);
$tpl->assign('pageName', $pageName);
$tpl->assign('breadcrumbs', $breadcrumbs);
$tpl->assign('siteUrl', $site_url);
$tpl->assign('homeUrl', $site_url);
$tpl->display('index.tpl');

?>