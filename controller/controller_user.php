<?
include "../model/model_user.php";
$main = new model_user();

if(!empty($_POST)){
    $action = $_POST['action'];
    $main->nama = $_POST['nama'];
    $main->username = $_POST['username'];
    $main->password = $_POST['password'];
    $main->level = $_POST['level'];
    $main->id = $_POST['id'];

    if($action == "insert"){
        $main->input_user();
    }
    elseif($action == "edit_user"){
        $main->edit_user();
    }
    elseif($action == "hapus_user"){
        $main->hapus_user();
    }
    
}
?>