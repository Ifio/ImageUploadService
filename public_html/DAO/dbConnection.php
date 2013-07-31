<?php

require_once('db_login.php');

class dbConnection {

    public static $connection;
    public $con;

    private function __construct() {
        $log = new db_login();
        $this->con = mysql_connect($log->getDbLocalHost(), $log->getDbUsername(), $log->getDbPassword()) or die("Could not connect to the database: <br />" . mysql_error());

        mysql_select_db($log->getDatabase(), $this->con) or die("Could not select the data base: <br />" . mysql_error());
    }

    public function getConnection() {
        return $this->con;
    }

    public static function instance() {

        if (!isset(self::$connection)) {
            self::$connection = new dbConnection();
            return self::$connection;
        } else {
            return self::$connection;
        }
    }

}

?>
