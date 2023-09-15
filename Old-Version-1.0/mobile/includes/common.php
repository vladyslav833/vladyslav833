<?php

function isMobile(){
    $mobile_browser = '0';

    if(isset($_SERVER['HTTP_USER_AGENT']))
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
    }

    if(isset($_SERVER['HTTP_ACCEPT']))
    if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
    }

    $mobile_ua = isset($_SERVER['HTTP_USER_AGENT'])?strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4)):'';
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-'
    );

    if(in_array($mobile_ua,$mobile_agents)) {
        $mobile_browser++;
    }

    if (strpos(strtolower(@$_SERVER['ALL_HTTP']),'operamini')>0) {
        $mobile_browser++;
    }

    if (strpos(strtolower(@$_SERVER['HTTP_USER_AGENT']),' ppc;')>0) {
        $mobile_browser++;
    }

    if (strpos(strtolower(@$_SERVER['HTTP_USER_AGENT']),'windows ce')>0) {
        $mobile_browser++;
    }
    else if (strpos(strtolower(@$_SERVER['HTTP_USER_AGENT']),'windows')>0) {
        $mobile_browser=0;
    }

    if (strpos(strtolower(@$_SERVER['HTTP_USER_AGENT']),'iemobile')>0) {
        $mobile_browser++;
    }

    return $mobile_browser;
}

function db_connect() {

    global  $current_config,
            $dbConfigs;


    /*$link = mysql_connect(
        $dbConfigs[$current_config]['dbHost'],
        $dbConfigs[$current_config]['dbUser'],
        $dbConfigs[$current_config]['dbPass']

    );
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }

    $db = mysql_select_db( $dbConfigs[$current_config]['dbName'], $link );

    if( !$db ) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_query ("SET NAMES utf8");
    mysql_query ("SET CHARACTER SET utf8");

    mysql_query ("set character_set_client='utf8'");
    mysql_query ("set character_set_results='utf8'");
    mysql_query ("set collation_connection='utf8_general_ci'");*/

    $db = new custom_db(
        $dbConfigs[$current_config]['dbUser'],
        $dbConfigs[$current_config]['dbPass'],
        $dbConfigs[$current_config]['dbName'],
        $dbConfigs[$current_config]['dbHost']
    );

    if( $current_config !== 'live' ){
        $db->show_errors();
    }

    return $db;
}

function redirect( $url = '' ){
    global $site_url;

    $url = strtolower($url);
    switch($url){
        case '': case 'home': $new_url = $site_url; break;
        default: {
            if(substr($url,0,4)=="http"){
                $new_url = $url;
            }
            else {
                $new_url = $site_url.$url;
            }
        }
    }
    header("location: ".$new_url);
    exit;
    ######### correct function
    $url = strtolower($url);
    switch($url){
        case '': case 'home': $new_url = $home_url; break;
        default: {
            if(substr($url,0,4)=="http"){
                $new_url = $url;
            }
            else {
                $new_url = $site_url.$url;
            }
        }
    }
    header("location: ".$new_url);
    exit;
}

function checkEmail( $email ){
    global $current_config;

    if( strlen($email) < 6) return false;
    if( preg_match("/[\s\/:,;]/", $email)) return false;

    $pos = strpos($email, "@");
    if($pos === false) return false;
    if(strpos($email, "@", $pos + 1)) return false;
    $pos = strpos($email, ".");
    if($pos === false) return false;
    if($pos + 3 > strlen($email)) return false;

    if( !preg_match('/^[_A-z0-9-]+((\.|\+)[_A-z0-9-]+)*@[A-z0-9-]+(\.[A-z0-9-]+)*(\.[A-z]{2,4})$/', $email) ){
        return false;
    }

    if( 'live' !== $current_config ){
        return $email;
    }
    list($name, $domain) = explode('@',$email);
    if(!checkdnsrr($domain,'MX')){
        // No MX record found
        return false;
    }
    else {
        // MX record found, return email
        return $email;
    }
}

function base_encript( $array ){
    $data = base64_encode( serialize( $order_array ) );
    $data = base64_encode( strrev( $data ) );

    $total = strlen( $data );
    $f_part = ceil( $total/2 );
    $s_part = $total - $f_part;

    return base64_encode( substr( $data, $f_part, $s_part ).substr( $data, 0 , $f_part ) );
}

function base_decript( $cripted_line ){
    $data = base64_decode($cripted_line);

    $total = strlen($data);
    $f_part = ceil($total/2);
    $s_part = $total - $f_part;

    $data = substr($data,$f_part,$s_part).substr($data,0,$f_part);

    return unserialize(base64_decode(strrev(base64_decode($data))));
}

/**
 * getMemcacheKeys()
 *
 *  get all keys from Memcache
 *
 * @author         Roman Kutsy
 * @version        2.0.20090708
 *
 * @return    array     $keys
 */
function getMemcacheKeys(){
    $s = @fsockopen('127.0.0.1',11211);
    // SLABS //
    fwrite($s, 'stats slabs'."\r\n");
    $slabs = array();
    while(!feof($s)){
        $temp = fgets($s, 256);
        preg_match('/^STAT\s([0-9]*)(.*)/', $temp, $slab_temp);
        if(isset($slab_temp['1']) && strlen($slab_temp['1'])>0){
            $slabs[] = $slab_temp['1'];
        }
        unset($slab_temp);
        if(trim($temp)=='END'){
            break;
        }
    }
    unset($temp);
    // ITEMS //
    fwrite($s, 'stats items'."\r\n");
    $items = array();
    while( !feof($s) ){
        $temp = fgets($s, 256);
        preg_match('/^STAT\sitems\:([0-9]*)(.*)/', $temp, $item_temp);
        if(isset($item_temp['1']) && strlen($item_temp['1'])>0){
            $items[] = $item_temp['1'];
        }
        unset($item_temp);
        if(trim($temp)=='END'){
            break;
        }
    }
    unset($temp);
    $slabs = array_unique($slabs);
    $items = array_unique($items);
    // CACHEDUMP //
    $keys = array();
    foreach($slabs as &$slab){
        foreach($items as &$item){
            fwrite($s, 'stats cachedump '.$slab.' '.$item."\r\n");
            while(!feof($s)){
                $temp = fgets($s, 256);
                // ITEM cd3aec8b1dd7ef828267408e68b6d961:user_1_status [1 b; 1247043297 s]
                // or
                // ITEM sql_custom_photos_showphoto_11 [1379 b; 1247064083 s]
                preg_match('/^ITEM\s([a-f0-9]{32}\:)?([A-Za-z0-9\_\-\.]*)\s\[[0-9]*\sb\;\s([0-9]*)\s.*/', $temp, $key_temp);
                if(isset($key_temp['2']) && strlen($key_temp['2'])>0){
                  $keys[] = $key_temp['2'];
                }
                unset($key_temp);
                if(trim($temp)=='END'){
                    break;
                }
            }
        }
    }
    unset($temp,$slabs,$items);
    fclose($s);
    $keys_temp = array_unique($keys);
    unset($keys);
    asort($keys_temp);
    $keys = array();
    foreach($keys_temp as &$k){
        $keys[] = $k;
    }

    return $keys;
}

function isLocal( $param = '###!!!###~~~%~' ){

    global  $local_ips,
            $memcache;

    ini_set('show_errors', 1);
    error_reporting(E_ALL);

    $test_ip = $_SERVER['REMOTE_ADDR'];

    if(
        preg_match( '/^193\.110\.11[0-9]\.[0-9]{1,3}$/' , $test_ip )
        || preg_match( '/^87\.76\.23[0-9]\.[0-9]{1,3}$/' , $test_ip )
        || preg_match( '/^141\.105\.13[0-9]\.[0-9]{1,3}$/' , $test_ip )
        || '127.0.0.1' == $test_ip
    ){
        if( '###!!!###~~~%~' === $param){
            return true;
        }
        @header('Content-Type:text/plain');
        var_dump($param);
        exit;
    }
    return false;

    /*$local_ips = $GLOBALS['local_ips'];
    $local = in_array($_SERVER['REMOTE_ADDR'],$local_ips);
    if($local && $param != '###!!!###'){
        var_dump($param);
        exit;
    }
    return $local;*/
}

function clean_from_tags($text){
    $text = preg_replace('/<a.*?href=[\"\']([^\'\"]*?)[\"\'][^>]*?>(.*?)<\/a>/ims',"$2 ($1)",$text);
    $text = preg_replace('/<span[^>]*?>(.*?)<\/span>/ims',"$1",$text);
    $text = preg_replace('/<strong[^>]*?>(.*?)<\/strong>/ims',"$1",$text);
    $text = preg_replace('/<i[^>]*?>(.*?)<\/i>/ims',"$1",$text);
    $text = preg_replace('/<b[^>]*?>(.*?)<\/b>/ims',"$1",$text);
    $text = preg_replace('/<em[^>]*?>(.*?)<\/em>/ims',"$1",$text);
    $text = preg_replace('/<sub[^>]*?>(.*?)<\/sub>/ims',"$1",$text);
    $text = preg_replace('/<sup[^>]*?>(.*?)<\/sup>/ims',"$1",$text);
    return $text;
}

function setDefaultTemplateVariables(){
    global $tpl, $default_settings, $current_config;
    $settings = $default_settings[$current_config];
    foreach( $settings as $k=>$v){
        $k = in_array( $k, array( 'homeurl' ) ) ? $k : 'default_'.$k;
        $tpl->assign( $k, $v );
    }
}

function sendEmail( $to, $subject, $html, $headers, $attachments = '' ){

    global $email_settings, $current_config;
    $url = 'http://sendgrid.com/';

    if( empty( $email_settings[$current_config]['user'] ) || empty( $email_settings[$current_config]['pass'] ) ){
        return false;
    }

    if( !$to || !checkEmail($to) || !$subject || !$html ){
        return false;
    }

    $data = array(
        'api_user'  => $email_settings[$current_config]['user'],
        'api_key'   => $email_settings[$current_config]['pass'],
        'to'        => $to,
        'from'      => !empty( $headers['from'] ) ? $headers['from'] : '',
        'fromname'  => !empty( $headers['from_name'] ) ? $headers['from_name'] : '',
        'subject'   => $subject,
        'html'      => $html,
        'bcc'       => !empty( $headers['bcc'] ) ? $headers['bcc'] : '',
    );

    if( !empty( $attachments ) ){
        foreach( $attachments as $file => $path ){
            $data['files['.$file.']'] = $path;
        }
    }

    $request = $url.'api/mail.send.json';

    // Generate curl request
    $session = curl_init($request);

    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);

    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $data);

    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    $response = curl_exec($session);
    curl_close($session);

    // print everything out
    $response = json_decode($response, true);

    return $response['message'] == 'success' ? true : $response['errors'] ;
}

function mbstring_binary_safe_encoding( $reset = false ) {
    static $encodings = array();
    static $overloaded = null;

    if ( is_null( $overloaded ) )
        $overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 );

    if ( false === $overloaded )
        return;

    if ( ! $reset ) {
        $encoding = mb_internal_encoding();
        array_push( $encodings, $encoding );
        mb_internal_encoding( 'ISO-8859-1' );
    }

    if ( $reset && $encodings ) {
        $encoding = array_pop( $encodings );
        mb_internal_encoding( $encoding );
    }
}

/**
 * Reset the mbstring internal encoding to a users previously set encoding.
 */
function reset_mbstring_encoding() {
    mbstring_binary_safe_encoding( true );
}

?>