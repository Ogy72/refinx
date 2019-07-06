<?
include "database.php";

class model_login{
    public $username;
    public $password;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function count($data){
        return mysql_num_rows($data);
    }

    public function cek_user(){
        $query = "SELECT * FROM user WHERE username='$this->username' AND password='$this->password'";
        return mysql_query($query);
    }
}
?>