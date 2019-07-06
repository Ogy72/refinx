<?
include "../model/model_cartridge.php";
$get = new model_cartridge();

if(!empty($_POST)){
    $output = '';
    $idrefill = $_POST['idrefill'];
    $get->idrefill = $_POST['idrefill'];

    $data = $get->select_refill();
    $x = $get->fetch($data);
    $cek = $x['isi'];

    $status = $get->select_status();
    $s = $get->fetch($status);
    $stat = $s['status'];
    

    if($stat == 'dibayar'){
        $output = 'Cartridge Sudah Dibayar, Data Cartridge Tidak Bisa di Hapus!
                    <input type="hidden" class="stat" value="hidden-btn">';
    }
    elseif($cek > 0 ){
    $data = $get->select_refill();
    while($x = $get->fetch($data)){
        $output .=' 
        <input type="hidden" name="idrefill[]" value="'.$x['idrefill'].'">
        <input type="hidden" name="kd_tinta[]" value="'.$x['kd_tinta'].'">
        <input type="hidden" name="isi[]" value="'.$x['isi'].'">
        <input type="hidden" name="stok_tinta[]" value="'.$x['stok'].'">';
    }
    $output .=' <input type="hidden" name="action" value="hapus_cartridge_berisi">';
    }
    else{
    $output .=' 
        <input type="hidden" name="idrefill" value="'.$idrefill.'">
        <input type="hidden" name="action" value="hapus_cartridge">';
    }
echo $output;
}
?>