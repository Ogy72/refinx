<?
include "../model/model_refill.php";
$main = new model_refill();

if(!empty($_POST)){
    $action = $_POST['action'];
    $idrefill = $_POST['idrefill'];
    $userid = $_POST['teknisi'];
    $hasil_test = $_POST['hasil_test'];
    $ket = $_POST['ket'];
    $kd_tinta = $_POST['kd_tinta'];
    $stok_tinta = $_POST['stok_tinta'];
    $isi = $_POST['isi'];
    $new_isi = $_POST['new_isi'];
    $hrg_jual = $_POST['harga'];

    if($action == "insert"){
        $main->kd_tinta = $kd_tinta;
        $main->idrefill = $idrefill;
        $main->isi = $isi;
        $main->userid = $userid;
        $main->hasil_test = $hasil_test;
        $main->ket = $ket;
        $main->stok_tinta = $stok_tinta;
        $main->hrg_jual = $hrg_jual;
        $main->input_refill();
        $main->penggunaan_tinta();
        $main->update_stok();
    }
    elseif($action == "insert2"){
        $main->userid = $userid;
        $main->hasil_test = $hasil_test;
        $main->ket = $ket;
        $main->idrefill = $idrefill;
        $main->input_refill();
        foreach($isi as $key =>$val){
            $main->kd_tinta = $kd_tinta[$key];
            $main->stok_tinta = $stok_tinta[$key];
            $main->isi = $isi[$key];
            $main->hrg_jual = $hrg_jual[$key];
            $main->penggunaan_tinta();
            $main->update_stok();
        }
        
    }
    elseif($action == "edit"){
        $main->idrefill = $idrefill;
        $main->kd_tinta = $kd_tinta;
        $main->stok_tinta = $stok_tinta;
        $main->hrg_jual = $hrg_jual;
        $main->isi = $isi;
        $main->new_isi = $new_isi;
        $main->userid = $userid;
        $main->hasil_test = $hasil_test;
        $main->ket = $ket;
        $main->update_refill();
        $main->update_penggunaan();
        $main->restock_tinta();
    }
    elseif($action == "edit2" ){
        $main->idrefill = $idrefill;
        $main->hasil_test = $hasil_test;
        $main->ket = $ket;
        $main->userid = $userid;
        $main->update_refill();
        foreach($isi as $key =>$val){
            $main->kd_tinta = $kd_tinta[$key];
            $main->hrg_jual = $hrg_jual[$key];
            $main->stok_tinta = $stok_tinta[$key];
            $main->isi = $isi[$key];
            $main->new_isi = $new_isi[$key];
            $main->update_penggunaan();
            $main->restock_tinta();
        }
    }

}
?>