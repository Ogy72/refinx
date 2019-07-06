<?
date_default_timezone_set('asia/singapore');
include "../model/model_cartridge.php";
$main = new model_cartridge();

if(isset($_POST['no_cart'])){
    $output = '';
    $char = "CR";
    $year = date('y');
    $chr_year = "$char.$year";
    $main->no_cartridge = $_POST['no_cart'];
    $dat = $main->select_cartridge();
    $x = $main->fetch($dat);
    $nocart = $x["no_cartridge"];
    $nomor = substr($nocart,-4);

$output .='
<form class="editCartridge" method="post">
    <label>Nomor Telepon</label><label id="lbl-nama">Nama</label>
    <div class="form-inline">
        <input type="hidden" name="action" value="editCartridge">
        <input type="hidden" name="id_pelanggan" value='.$x["id"].'>
        <input type="text" name="no_telp" class="form-control edit-notelp" value='.$x["no_telp"].'>
        <input type="text" name="nama" class="form-control edit-nama" value="'.$x['nama'].'">
    </div>
    <label>No Cartridge</label><label class="lbl-etipe">Tipe</label><label class="lbl-emerek">Merek</label><label class="lbl-ejenis">Jenis</label><label class="lbl-ewarna">Warna</label>
    <div class="form-inline">
            <input type="hidden" name="nocart" value="'.$x["no_cartridge"].'">
            <input type="text" name="chr_year" class="form-control edit-char" value="'.$chr_year.'" readonly="readonly">
            <input type="text" name="nomor" class="form-control edit-no_cart" value="'.$nomor.'">
            <input type="text" name="tipe" class="form-control edit-tipe" value="'.$x["tipe"].'">
            <input type="text" name="merek" class="form-control edit-merek" value="'.$x["merek"].'">
            <select class="custom-select edit-jenis" id="jenis" name="jenis">';
                if($x['jenis'] == 'Inkjet'){
        $output .='
                <option value='.$x["jenis"].' selected>Inkjet</option>
                <option value="Laserjet">Laserjet</option>';
                }
                elseif($x['jenis'] == 'Laserjet'){
        $output .='
                <option value="Inkjet">Inkjet</option>
                <option value='.$x["jenis"].' selected>Laserjet</option>
                ';}
        $output .='
            </select>
            <select name="warna" class="custom-select edit-warna">';
            if($x['warna'] == "Black"){
            $output .='
                    <option value='.$x["warna"].' selected>Black</option>
                    <option value="C/M/Y">C/M/Y</option>
                    <option value="Cyan">Cyan</option>
                    <option value="Magenta">Magenta</option>
                    <option value="Yellow">Yellow</option>';
            }
            elseif($x['warna'] == "C/M/Y"){
            $output .='
                    <option value="Black">Black</option>
                    <option value='.$x["warna"].' selected>C/M/Y</option>
                    <option value="Cyan">Cyan</option>
                    <option value="Magenta">Magenta</option>
                    <option value="Yellow">Yellow</option>';
            }
            elseif($x['warna'] == "Cyan"){
            $output .='
                    <option value="Black">Black</option>
                    <option value="C/M/Y">C/M/Y</option>
                    <option value='.$x["warna"].' selected>Cyan</option>
                    <option value="Magenta">Magenta</option>
                    <option value="Yellow">Yellow</option>';
            }
            elseif($x['warna'] == "Magenta"){
            $output .='
                    <option value="Black">Black</option>
                    <option value="C/M/Y">C/M/Y</option>
                    <option value="Cyan">Cyan</option>
                    <option value='.$x["warna"].' selected>Magenta</option>
                    <option value="Yellow">Yellow</option>';
            }
            elseif($x['warna'] == "Yellow"){
            $output .='
                    <option value="Black">Black</option>
                    <option value="C/M/Y">C/M/Y</option>
                    <option value="Cyan">Cyan</option>
                    <option value="Magenta">Magenta</option>
                    <option value='.$x["warna"].' selected>Yellow</option>';
            }
$output .='
            </select>
    </div>
</form>';
echo $output;
}
?>