<?php

/**
 * Description of Database
 *
 * @author Halim Lardjane
 */
class Database {
    private $db_driver          = "";
    private $db_host            = "";
    private $db_name            = "";
    private $db_port            = "";
    private $db_user            = "";
    private $db_pass            = "";
    public  $db                 = null;
    
    public function __construct($db_host, $db_user, $db_pass, $db_name, $db_port = '3306', $db_driver = 'mysql') {
        $this->db_driver = $db_driver;
        $this->db_host   = $db_host;
        $this->db_user   = $db_user;
        $this->db_pass   = $db_pass;
        $this->db_port   = $db_port;
        $this->db_name   = $db_name;
        $this->connect();
    }
    
    /**
     * 
     */
    private function connect() {
        try {
            $db_params = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $dsn = "$this->db_driver:host=$this->db_host;dbname=$this->db_name;port=$this->db_port";
            $this->db = new PDO($dsn, $this->db_user, $this->db_pass, $db_params);
        }
        catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    /**
     * close the connection
     */
    public function close() {
        $this->db = null;
    }
    
}