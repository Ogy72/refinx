<?
include "../model/model_cartridge.php";
$main = new model_cartridge();

if(!empty($_POST)){
    $action = $_POST['action'];
    $main->nama = $_POST['nama'];
    $main->no_telp = $_POST['no_telp'];

    $kd_head = $_POST['chr_year'];
    $nomor = $_POST['nomor'];
    $tipe = $_POST['tipe'];
    $merek = $_POST['merek'];
    $jenis = $_POST['jenis'];
    $warna = $_POST['warna'];
    $date = $_POST['date'];
    $main->no_cartridge = $_POST['nocart'];
    $main->id = $_POST['id_pelanggan'];
    
    $idrefill = $_POST['idrefill'];
    $kdtinta = $_POST['kd_tinta'];
    $isi = $_POST['isi'];
    $stok_tinta = $_POST['stok_tinta'];

    if($action == "insert"){
        $main->input_pelanggan();
        foreach ($nomor as $key => $n){
            $main->no_cartridge = "$kd_head[$key].$nomor[$key]";
            $main->tipe = $tipe[$key];
            $main->merek = $merek[$key];
            $main->jenis = $jenis[$key];
            $main->warna = $warna[$key];
            $main->date = $date[$key];
            $main->input_cartridge();
            $main->input_refill();
        }
    }
    elseif($action == "editCartridge"){
        $main->no_cartridge2 = "$kd_head.$nomor";
        $main->tipe = $tipe;
        $main->merek = $merek;
        $main->jenis = $jenis;
        $main->warna = $warna;
        $main->edit_pelanggan();
        $main->edit_cartridge();
    }
    elseif($action == "hapus_cartridge_berisi"){
        foreach($idrefill as $key =>$i){
            $main->idrefill = $idrefill[$key];
            $main->kd_tinta = $kdtinta[$key];
            $main->isi = $isi[$key];
            $main->stok_tinta = $stok_tinta[$key];
            $main->restock();
            $main->hapus_cartridge();
        }
    }
    elseif($action == "hapus_cartridge"){
        $main->idrefill = $idrefill;
        $main->hapus_cartridge();
    }
}
?>