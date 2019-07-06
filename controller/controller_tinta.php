<?
include "../model/model_tinta.php";
$main = new model_tinta();

if(!empty($_POST)){
    $action = $_POST['action'];
    $main->kd_tinta = $_POST['kd_tinta'];
    $main->warna = $_POST['warna'];
    $main->merek = $_POST['merek'];
    $main->jenis = $_POST['jenis'];
    $main->stok_ini = $_POST['stok_ini'];
    $main->satuan = $_POST['satuan'];
    $main->hrg_beli = $_POST['hrg_beli'];
    $main->hrg_jual = $_POST['hrg_jual'];
    $main->date = $_POST['date_msuk'];
    $main->stok_edit = $_POST['stok_edit'];
    $main->kd_tinta2 = $_POST['kd_tinta2'];

    if($action == "insert"){
        $main->input_tinta();
    }
    elseif($action == "tambah_stok"){
        $main->tambah_stok();
    }
    elseif($action == "edit_stok"){
        $main->edit_tinta();
    }
    elseif($action == "hapus_stok"){
        $main->hapus_tinta();
    }
    
}
?>