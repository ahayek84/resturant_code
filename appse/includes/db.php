<?php


class app
{

    private $_connection;
    private static $_instance;
    private $_host = "localhost";
    private $_username = "hostfarb";
    private $_password = "1441001003ASDasd";
    private $_database = "appa_pal";

    public static function getInstance()
    {

        if (!self:: $_instance) {
            self:: $_instance = new self();
        }
        return self:: $_instance;
    }

    private function __construct()
    {
        $this->_connection = new mysqli(
            $this->_host,
            $this->_username,
            $this->_password,
            $this->_database
        );


        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to Database: " . mysql_connect_error(), E_USER_ERROR);
        }
    }

    private function __clone()
    {

    }

    public function getConnection()
    {
        return $this->_connection;
    }
}

?>