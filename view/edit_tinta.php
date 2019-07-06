<?
include "../model/model_tinta.php";
$main = new model_tinta;

if(isset($_POST['kd_tinta'])){
    $output = "";
    $main->kd_tinta = $_POST['kd_tinta'];
    $data = $main->select_tinta();
    $x = $main->fetch($data);
    $stok = $x['stok'];

$output .='
    <label for="kd-tinta">Kode Tinta</label>
        <input type="text" name="kd_tinta2" class="form-control frm-tinta" value='.$x["kd_tinta"].'>
        <input type="hidden" name="kd_tinta" value='.$x["kd_tinta"].'>
    <label for="warna">Warna</label><label for="merek" id="lbl-merek">Merek</label>
    <div class="form-inline">
        <input type="text" name="warna" class="form-control frm-warna" value='.$x["warna"].'>
        <input type="text" name="merek" class="form-control frm-merek" value='.$x["merek"].'>
    </div>
    <label id="stok-masuk">Stok & Satuan</label><label id="lbl-jenis"">Jenis Tinta</label>
    <div class="form-inline">
        <input type="text" name="stok_edit" class="form-control frm-stok2" value='.$stok.'>
        <select class="custom-select frm-satuan" style="width:18.3%" id="satuan" name="satuan">';
        if($x['satuan'] == 'ml'){
        $output .='
                <option value='.$x["satuan"].' selected>ml</option>
                <option value="gr">gr</option>';
        }
        elseif($x['satuan'] == 'gr'){
        $output .='
                <option value="ml">ml</option>
                <option value='.$x["satuan"].' selected>gr</option>
        ';}
$output .='</select>
        <select class="custom-select frm-jenis" style="width:49%" id="jenis" name="jenis">';
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
    </div>
    <label for="hrg">Harga Beli</label><label for="hrg" id="lbl-hrg_jual">Harga Jual</label>
    <div class="form-inline">
        <input type="text" name="hrg_beli" class="form-control frm-hrg_beli" value='.$x["hrg_beli"].'>
        <input type="text" name="hrg_jual" class="form-control frm-hrg_jual" value='.$x["hrg_jual"].'>
    </div>
    <label for="date">Tanggal Masuk</label>
            <input type="text" name="date_msuk" class="form-control datepicker frm-date" value='.$x["date"].'>
            <input type="hidden" name="action" value="edit_stok">';

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