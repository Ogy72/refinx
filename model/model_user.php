<?php
include "database.php";

class model_user{
    public $nama;
    public $username;
    public $password;
    public $level;
    public $id;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function read_user(){
        $query = "SELECT * FROM user";
        return mysql_query($query);
    }

    public function select_user(){
        $query = "SELECT * FROM user WHERE id='$this->id'";
        return mysql_query($query);
    }

    public function input_user(){
        $query = "INSERT INTO user VALUES('','$this->nama','$this->username','$this->password','$this->level')";
        return mysql_query($query);
    }

    public function edit_user(){
        $query = "UPDATE user SET nama='$this->nama',username='$this->username',password='$this->password',level='$this->level' WHERE id='$this->id'";
        return mysql_query($query);
    }

    public function hapus_user(){
        $query = "DELETE FROM user WHERE id='$this->id'";
        return mysql_query($query);
    }
}
?>