<?
session_start();

include "../model/model_login.php";
$get = new model_login();

$get->username = $_POST['username'];
$get->password = $_POST['password'];

$login = $get->cek_user();
$cek = $get->count($login);

if($cek > 0){

    $user = $get->fetch($login);

    if($user['level'] == "Admin"){
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['level'] = "Admin";
        header("location:../halaman-admin.php");
    }
    elseif($user['level'] == "Teknisi"){
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['level'] = "Teknisi";
        header("location:../halaman-teknisi.php");
    }
    else{
        header("location:../index.php?pesan=gagal");
    }
}
else{
    header("location:../index.php?pesan=gagal");
}

?>