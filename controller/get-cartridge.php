<?
include "../model/model_cartridge.php";
$get = new model_cartridge();

if(!empty($_POST))
{
    $kd_head = $_POST['chr_year'];
    $no_cart = $_POST['no_cart'];
    $get->no_cartridge = "$kd_head.$no_cart";

    $x = $get->select_cartridge2();
    $data = $get->fetch($x);
    echo json_encode($data);
}
?>