<?php
    class User {

        var $id;
        var $username;
        var $fname = '';
        var $lname = '';
        var $userdata = array();
        var $is_logged = false;
        var $role = '';

        function __construct()
        {
            if( $this->isLogged() ){
                $this->is_logged = true;
                unset( $_SESSION['HTTP_REFERER'] );
            }

        }

        /** @return $db custom_wpdb */
        static function db()
        {
            global $db;
            return $db;
        }

        function isLogged()
        {
            $referer =  ( !empty( $_SERVER['HTTPS'] ) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

            if( !empty( $_SESSION["g0CjXkdp84_user"]["username"] ) && !empty( $_SESSION["g0CjXkdp84_user"]["password"] ) ){
                $sql = "
                    SELECT
                        id
                    FROM
                        users
                    WHERE
                        username = '".$_SESSION["g0CjXkdp84_user"]['username']."' AND
                        password = '".$_SESSION["g0CjXkdp84_user"]['password']."'
                ";

                $user_exit_id = User::db()->get_var($sql);
                if( !empty( $user_exit_id ) ){

                    $this->id       = $_SESSION["g0CjXkdp84_user"]['id'];
                    $this->username = $_SESSION["g0CjXkdp84_user"]['username'];
                    $this->fname    = $_SESSION["g0CjXkdp84_user"]['fname'];
                    $this->lname    = $_SESSION["g0CjXkdp84_user"]['lname'];
                    $this->role     = $_SESSION["g0CjXkdp84_user"]['role'];
                    $this->userdata = $_SESSION["g0CjXkdp84_user"];

                    return true;
                }
                else{
                    $_SESSION['HTTP_REFERER'] = $referer;
                    return false;
                }

            }
            else{
                $_SESSION['HTTP_REFERER'] = $referer;
                return false;
            }
        }

        function checkLogin( $username, $password )
        {
            $sql = "
                SELECT
                    id
                FROM
                    users
                WHERE
                    username = '$username' AND
                    password = '$password'
            ";
            $user_exist_id = User::db()->get_var($sql);
            if( !empty( $user_exist_id ) ){
                return true;
            }
            else{
                return false;
            }
        }

        static function getUserBy( $field, $value = '' )
        {
            if( !$field ) return false;

            $fields_allowed = array(
                'id',
                'username'
            ); // these are UNIQUE for all users

            if( !in_array( $field, $fields_allowed ) ){
                return false;
            }

            $sql = "
                SELECT
                    id,
                    username,
                    password,
                    first_name,
                    last_name,
                    role
                FROM
                    users
                WHERE
                    $field = %s
                LIMIT
                    1
            ";

            $sql = User::db()->prepare( $sql, $value );

            return User::db()->get_row( $sql, ARRAY_A );
        }

        static function isAlreadyExist( $username = '' )
        {

            if( !$username ) return false;

            $sql = "
                SELECT
                    id
                FROM
                    users
                WHERE
                    username = %s
                LIMIT
                    1
            ";
            $sql = User::db()->prepare( $sql, $username );

            return User::db()->get_var( $sql );
        }

        function updateSession(){
            $sql = "
                SELECT
                    id,
                    username,
                    first_name,
                    first_name as 'fname',
                    last_name,
                    last_name as 'lname',
                    password,
                    role
                FROM
                    users
                WHERE
                    id = '".$this->id."'
                LIMIT
                    1
            ";
            $user_data = User::db()->get_row( $sql, ARRAY_A );
            if( !$user_data ) return false;

            $_SESSION['user'] = $user_data;
        }

        function login( $username, $password  )
        {

            if( $this->checkLogin($username, $password ) ){

                $sql = "
                    SELECT
                        id,
                        username,
                        first_name,
                        first_name as 'fname',
                        last_name,
                        last_name as 'lname',
                        password,
                        role
                    FROM
                        users
                    WHERE
                        username = '$username' AND
                        password = '$password'
                    LIMIT
                        1
                ";
                $user_data = User::db()->get_row( $sql, ARRAY_A );
                if( !$user_data ) return false;

                $this->id       = $user_data['id'];
                $this->username = $user_data['username'];
                $this->role     = $user_data['role'];
                $this->fname    = $user_data['first_name'];
                $this->lname    = $user_data['last_name'];
                $this->userdata = $user_data;

                $_SESSION["g0CjXkdp84_user"] = $user_data;
                /*
                User::db()->update(
                    'users',
                    array(
                        'last_login'    =>  date("Y-m-d H:i:s"),
                        'last_login_ip' =>  $_SERVER['REMOTE_ADDR'],
                    ),
                    array(
                        'id'    =>  $_SESSION['user']['id']
                    )
                );
                */
                return true;
            }
            else{
                return false;
            }
        }

        function logout()
        {
            $this->id = null;
            $this->username = null;
            $this->is_logged = false;
            $this->userdata = null;
            $this->membership = 0;
            unset( $_SESSION["g0CjXkdp84_user"] );
        }

        function relogin( $email, $password )
        {
            $this->logout();
            return $this->login( $email, $password );
        }

        function getReferrer()
        {
            return !empty( $_SESSION['HTTP_REFERER'] ) ? $_SESSION['HTTP_REFERER'] : false ;
        }

    }
?>