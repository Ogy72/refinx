<?php
class database{
    
    public $host = "localhost";
    public $uname = "root";
    public $pass = "";
    public $db = "db_refinx";

    public function __construct(){
        $connect = mysql_connect($this->host, $this->uname, $this->pass);
        mysql_select_db($this->db);
    }
}
?>