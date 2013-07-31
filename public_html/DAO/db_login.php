<?php

class db_login {
    //localhost test
    /*
    private $db_host = 'localhost';
    private $db_database = 'schema';
    private $db_username = 'root';
    private $db_password = '';
    */
    //server test
    private $db_host = 'localhost';
    private $db_database = 'jcarcam1_ImageUploadService';
    private $db_username = 'jcarcam1';
    private $db_password = '9IgnisV';

    public function getDbLocalHost() {
        return $this->db_host;
    }

    public function getDatabase() {
        return $this->db_database;
    }

    public function getDbUsername() {
        return $this->db_username;
    }

    public function getDbPassword() {
        return $this->db_password;
    }

}

?>
