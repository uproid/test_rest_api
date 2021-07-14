<?php
/**
 * By the MyDB Class we can connect to database and manage it,
 * in this tools we have more function for SqlInjection
 */
class MyDB {

    function __construct() {
        include_once('config.php');
        $this->db = new database();
        $this->un = $this->db->db_username;
        $this->ps = $this->db->db_password;
        $this->hst = $this->db->db_ip;
        $this->dbn = $this->db->db_name;
    }

    private $db;
    private $un;
    private $ps;
    private $hst;
    private $dbn;
    public $link;

    /*
     * this function used For Start DataBase
     */
    private function StartMySQLi() {
        $this->link = mysqli_connect($this->hst, $this->un, $this->ps, $this->dbn, 3306);
        mysqli_query($this->link, 'SET NAMES `utf8`;');
    }

    /*
     * by this function we cand close the connection to database
     */
    function CloseMySQLi() {
        mysqli_close($this->link);
    }

    /*
     * This funtion Used for SQL Injection
     * By this function we check all scape strings and we remove that
     */
    function mysqli_real_escape_string($value) {
        $this->StartMySQLi();
        $val = mysqli_real_escape_string($this->link, $value);
        $this->CloseMySQLi();
        return $val;
    }

    /**
     * by this function we get a SQL query and we return back result of them
     * @param String $sql is String of Sql query
     * @param Boolean do you want close connection to database after doing?
     * @return DB
     */
    function select($sql, $close = true) {
        $this->StartMySQLi();
        $dt = mysqli_query($this->link, $sql);
        if ($close)
            $this->CloseMySQLi();
        return $dt;
    }

    /**
     * by this function we get a SQL query
     * @param String $sql is String of Sql query
     * @param Boolean do you want close connection to database after doing?
     */
    function docommand($sql, $close = true) {
        $this->StartMySQLi();
        mysqli_query($this->link, $sql);
        if ($close)
            $this->CloseMySQLi();
    }

    /**
     * remove SQL Injection characters from the string query 
     * @param String $value
     * @return String
     */
    function sqi($value) {
        $this->StartMySQLi();
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        if (function_exists("mysqli_real_escape_string")) {
            $value = mysqli_real_escape_string($this->link, $value);
        } else {
            $value = addslashes($value);
        }
        $this->CloseMySQLi();
        return $value;
    }

    /**
     * remove SQL Injection characters from the integer 
     * @param Integer $number
     * @return Integer
     */
    function sqi_int($number) {
        $val = $this->sqi($number);
        if (is_numeric($val)) {
            return $val;
        }
        return 0;
    }

}

?>
