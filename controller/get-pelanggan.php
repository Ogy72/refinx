<?
include "../model/model_cartridge.php";
$get = new model_cartridge();

if(!empty($_POST))
{
    $get->no_telp = $_POST['no_telp'];
    
    $x = $get->select_pelanggan();
    $data = $get->fetch($x);
    echo json_encode($data);
}
?>