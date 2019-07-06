<?
include "../model/model_tinta.php";
$main = new model_tinta;

if(isset($_POST['kd_tinta'])){
    $output = "";
    $main->kd_tinta = $_POST['kd_tinta'];
    $data = $main->select_tinta();
    $x = $main->fetch($data);

    $cek = mysql_num_rows($data);

if ($cek == 0){

$output .='
    <label for="warna">Warna</label><label for="merek" id="lbl-merek">Merek</label>
    <div class="form-inline">
        <input type="text" name="warna" class="form-control frm-warna" placeholder="Warna">
        <input type="text" name="merek" class="form-control frm-merek" placeholder="Merek">
    </div>
    <label id="stok-masuk">Stok Masuk</label><label class="lbl-jenis">Jenis Tinta</label>
    <div class="form-inline">
        <input type="text" name="stok_msuk" class="form-control frm-stok" placeholder="Stok Masuk">
        <select class="custom-select frm-satuan" id="satuan" name="satuan" >
            <option selected>Satuan</option>
            <option value="ml">ml</option>
            <option value="gr">gr</option>
        </select>
        <select class="custom-select frm-jenis" style="width:49.5%" id="jenis" name="jenis" >
            <option selected>Jenis Tinta</option>
            <option value="Inkjet">Inkjet</option>
            <option value="Laserjet">Laserjet</option>
        </select>
    </div>
    <label for="hrg">Harga Beli</label><label for="hrg" id="lbl-hrg_jual">Harga Jual</label>
    <div class="form-inline">
        <input type="text" name="hrg_beli" class="form-control frm-hrg_beli" placeholder="Harga Beli">
        <input type="text" name="hrg_jual" class="form-control frm-hrg_jual" placeholder="Harga Jual">
    </div>
    <label for="date">Tanggal Masuk</label>
            <input type="text" name="date_msuk" class="form-control datepicker frm-date" placeholder="Tanggal Masuk">
        <input type="hidden" name="action" value="insert">
';

}
else{
$output .='
    <label for="warna">Warna</label><label for="merek" id="lbl-merek">Merek</label>
    <div class="form-inline">
        <input type="text" name="warna" class="form-control frm-warna" value='.$x["warna"].' readonly="readonly">
        <input type="text" name="merek" class="form-control frm-merek" value='.$x["merek"].' readonly="readonly">
    </div>
    <label id="stok-masuk">Stok tersedia</label><label class="lbl-jenis2">Jenis Tinta</label>
    <div class="form-inline">
        <input type="text" name="stok_ini" class="form-control frm-stok2" value='.$x["stok"].' readonly="readonly">
        <input type="text" name="satuan" class="form-control frm-satuan" value='.$x["satuan"].' readonly="readonly">
        <input type="text" name="jenis" class="form-control frm-jenis" value='.$x["jenis"].' readonly="readonly">
    </div>
    <label for="hrg">Harga Beli</label><label for="hrg" id="lbl-hrg_jual">Harga Jual</label>
    <div class="form-inline">
        <input type="text" name="hrg_beli" class="form-control frm-hrg_beli" value='.$x["hrg_beli"].'>
        <input type="text" name="hrg_jual" class="form-control frm-hrg_jual" value='.$x["hrg_jual"].'>
    </div>
    <label for="date">Tanggal Masuk</label>
            <input type="text" name="date_msuk" class="form-control datepicker frm-date" placeholder="Tanggal Masuk">
    <label>Tambah Stok</label>
        <input type="text" name="stok_msuk" class="form-control frm-tambah_stok" placeholder="Tambah Stok">
        <input type="hidden" name="action" value="tambah_stok">';
}
echo $output;
}
?>

<script>
$(function(){
    $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
    });
});
</script>