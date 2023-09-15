<?php
    class Crypter {
        private $crypt_key;
        private $crypt_iv;
        private $crypt_allowed = false;

        function __construct()
        {
            global  $security_settings,
                    $current_config;

            $setting = $security_settings[$current_config];

            if( !empty( $setting['crypt_on'] ) && !empty( $setting['crypt_iv'] ) && !empty( $setting['crypt_key'] ) ){
                $this->crypt_allowed = $setting['crypt_on'];
                $this->crypt_iv = $setting['crypt_iv'];
                $this->crypt_key = $setting['crypt_key'];
            }

        }

        function encrypt_text( $text='' ){
            if( !$this->crypt_allowed ) return $text;
            if( $this->crypt_key && $text ){
                $td = mcrypt_module_open('tripledes', '', 'cfb', '');
                $iv = $this->crypt_iv?$this->crypt_iv:'12345678';
                mcrypt_generic_init($td, $this->crypt_key, $iv);
                $encrypted = mcrypt_generic($td, $text);
                mcrypt_generic_deinit($td);
                mcrypt_module_close($td);
                return utf8_encode($encrypted);
            }
            return false;
        }

        function decrypt_text( $text='' ){
            if( !$this->crypt_allowed ) return $text;
            if( $this->crypt_key && $text ){
                $td = mcrypt_module_open('tripledes', '', 'cfb', '');
                $iv = $this->crypt_iv?$this->crypt_iv:'12345678';
                mcrypt_generic_init($td, $this->crypt_key, $iv);
                $decrypted = mdecrypt_generic($td, utf8_decode($text));
                mcrypt_generic_deinit($td);
                mcrypt_module_close($td);
                return $decrypted;
            }
            return false;
        }
    }
?>
