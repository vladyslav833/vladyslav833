<?php
    class Ajax {

        var $query;
        var $error_code = 0;
        var $response = '';
        var $status = true;

        function __construct()
        {
            $this->query = $_POST;
            foreach($this->query as $k=>$v){
                $this->query[$k] = trim($v);
            }
        }

        function registration(){

            $step = !empty( $this->query['step'] ) ? $this->query['step'] : false ;

            if( !$step ){
                $this->status   = false;
                $this->response = 'Undefined \'step\' for registraion process';
            }

            switch( $step ){
                case 1:{

                    break;
                }
                case 2:{

                    break;
                }
                case 3:{

                    break;
                }
                case 4:{

                    break;
                }
                default:{
                    $this->status   = false;
                    $this->response = 'Incorrect \'step\' value for registraion process';
                }
            }

            $this->return_response();
        }

        function return_response(){

            echo json_encode(
                array(
                    'response'  =>  $this->response,
                    'status'    =>  $this->status,
                    'error_code'=>  $this->error_code,
                )
            );
            exit;

        }
    }
?>
