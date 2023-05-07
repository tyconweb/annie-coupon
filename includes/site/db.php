<?php
 
if( class_exists( 'mysqli' ) ) {
    try {
        $db = new mysqli( 'localhost', 'u725979659_coupondb', '?oX$=YIq3', 'u725979659_coupondb' );
    }

    catch( \Exception $e ) {
        if( !isset( $db ) ) {
            if( is_dir( 'install' ) ) {
                require_once 'install/index.php';
                die;
            }
            die( 'Failed to connect to MySQL' );
        } else if( ( !( $db_conn = $db->connect_errno ) ) && is_dir( 'install' ) ) {
            require_once 'install/index.php';
            die;
        } else if( $db_conn ) {
            die('Failed to connect to MySQL (' . $db->connect_errno . ') ' . $db->connect_error);
        }
    }
}