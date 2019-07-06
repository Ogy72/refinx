<?
include "../model/model_refill.php";
$main = new model_refill();

if(isset($_POST['idrefill'])){
    $output = '';
    $main->idrefill = $_POST['idrefill'];

    //Read refill//
    $data_cartridge = $main->select_refill();
    $x = $main->fetch($data_cartridge);
    
    //cek from//
    $warna = $x['warna'];

    //cek refill//
    $refill = $main->select_refill();
    $cek = $main->fetch($refill);

    if($cek['status'] == "dibayar"){
    $output .='
        <h4> Data Refill Tidak Dapat Ubah Karena Cartridge Sudah dibayar </h4>
        <script>
            $(document).ready(function(){
            $(".btn_refill").hide();
            $(".btn_tutup").show();
            })
        </script>';
    }
elseif($warna !== "C/M/Y"){    
    // Form edit tinta hitam//

    //Read satu Tinta//
    $main->merek = $x['merek'];
    $main->jenis = $x['jenis'];
    $main->warna = $x['warna'];
    $data_tinta = $main->select_tinta();
    $t = $main->fetch($data_tinta);

    //read data penggunaan tinta//
    $use = $main->select_edit();
    $u = $main->fetch($use);
$output .='
<div class="input-group all-grp">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">Nama Pemilik</span>
    </div>
    <input type="text" class="form-control" readonly="readonly" value="'.$u['nama'].'">
</div>

<div class="input-group all-grp">
    <input type="text" class="form-control l-cart" readonly="readonly" value="No Cartridge">
    <input type="text" name="no_cartridge" class="form-control i-cart" id="no_cartridge" readonly="readonly" value="'.$u['no_cartridge'].'">
    <input type="hidden" name="idrefill" value="'.$u['idrefill'].'">

    <input type="text" class="form-control l-tipe" readonly="readonly" value="Tipe">
    <input type="text" name="tipe" class="form-control i-tipe" readonly="readonly" value="'.$u['tipe'].'">

    <input type="text" class="form-control l-warna" readonly="readonly" value="Warna">
    <input type="text" name="warna" class="form-control i-warna" readonly="readonly" value="'.$u['warna'].'">
</div>

<label>Tinta</label>
<div class="input-group all-grp">
    <input type="text" name="kd_tinta" class="form-control l-kdtinta"  id="kd_tinta" readonly="readonly" value="'.$t['kd_tinta'].'">
    <input type="text" name="warna" class="form-control i-wrtinta" readonly="readonly" value="'.$t['warna'].'">
  
    <input type="text" class="form-control l-stok" readonly="readonly" value="Stok">
    <input type="text" name="stok_tinta" class="form-control i-stok" readonly="readonly" value="'.$t['stok'].'">
    <input type="text" class="form-control i-sat" value="'.$u['satuan'].'" readonly="readonly">
    <input type="hidden" name="harga" value="'.$t['hrg_jual'].'">

    <input type="text" class="form-control l-isi" readonly="readonly" value="isi">
    <input type="hidden" name="isi" value="'.$u['isi'].'">
    <input type="text" name="new_isi" class="form-control i-isi" value="'.$u['isi'].'">
    <input type="text" class="form-control i-sat" value="'.$u['satuan'].'" readonly="readonly">
  
    <select name="teknisi" class="custom-select teknisi">
        <option selected>Pilih Teknisi</option>';
        //Read user//
        $data_user = $main->select_user();
        while($usr = $main->fetch($data_user)){
            $output .='
                <option value="'.$usr['id'].'">'.$usr['nama'].'</option>';
        }
$output .='
    </select>
</div>

<div class="input-group all-grp">
    <div class="input-group-prepend">
        <span class="input-group-text" id="lbl-htest">Hasil Test</span>
    </div>
        <input type="text" name="hasil_test" class="form-control hasil" value="'.$u['hasil_test'].'">
    </div>

<div class="input-group all-grp">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">Keterangan</span>
    </div>
        <select name="ket" class="custom-select">';
        if($u['ket'] == "isi"){
        $output .='
            <option value='.$u["ket"].' selected>isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($u['ket'] == "Cartridge Non Ori"){
        $output .='
            <option value="isi">isi</option>
            <option value="'.$u['ket'].'" selected>Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($u['ket'] == "MAT"){
        $output .='
            <option value="isi">isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="'.$u['ket'].'" selected>MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($u['ket'] == "Cancel"){
        $output .='
            <option value="isi">isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="'.$u['ket'].'" selected>Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($u['ket'] == "Head Rusak"){
        $output .='
            <option value="isi">isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="'.$u['ket'].'" selected>Head Rusak</option>';
        }
    $output .='
        </select>
        <input type="hidden" name="action" value="edit">
</div>

<p style="text-align:right">
        <button class="btn btn-riwayat btn-primary" type="button" data-toggle="collapse" data-target="#riwayat-refill"> Riwayat Refill </button>
</p>
<div class="collapse" id="riwayat-refill">
        <div class="card card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal Refill</th>
                        <th>Tipe Cartridge</th>
                        <th>Warna</th>
                        <th>isi</th>
                        <th>Hasil Test</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>';
            $main->no_cartridge = $x['no_cartridge'];
            $riwayat = $main->select_riwayat();
            while($r = $main->fetch($riwayat)){
        $output .='
                <tr>
                    <td>'.$r['date'].'</td>
                    <td>'.$r['tipe'].'</td>
                    <td>'.$r['warna'].'</td>';
        $main->idrefill = $r['idrefill'];
        $isi = $main->jumlah_isi();
        while($i = $main->fetch($isi)){
        $output .='
                    <td>'.$i['jumlah_isi'].'</td>';
            }
        $output .='
                    <td>'.$r['hasil_test'].'</td>
                    <td>'.$r['ket'].'</td>
                </tr>';
            }
        $output .='
            </tbody>
            </table>
    </div>
</div>

<script>
$(document).ready(function(){
    $(".btn_refill").show();
    $(".btn_tutup").hide();
})
</script>
';}
else{ //Form edit tinta warna//

    $output .='
    <div class="input-group all-grp">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Nama Pemilik</span>
        </div>
            <input type="text" class="form-control" readonly="readonly" value="'.$x['nama'].'">
    </div>

    <div class="input-group all-grp">
        <input type="text" class="form-control l-cart" readonly="readonly" value="No Cartridge">
        <input type="text" class="form-control i-cart" id="no_cartridge" readonly="readonly" value="'.$x['no_cartridge'].'">
        <input type="hidden" name="idrefill" value="'.$x['idrefill'].'">

        <input type="text" class="form-control l-tipe" readonly="readonly" value="Tipe">
        <input type="text" class="form-control i-tipe" readonly="readonly" value="'.$x['tipe'].'">

        <input type="text" class="form-control l-warna" readonly="readonly" value="Warna">
        <input type="text" class="form-control i-warna" readonly="readonly" value="'.$x['warna'].'">
    </div>

    <label class="lbl-space"> Stok Tinta Tersedia </label>
    <div class="input-group all-grp">';
    //Read multiple Tinta//
    $merek = array($x['merek'],$x['merek'],$x['merek']);
    $jenis = array($x['jenis'],$x['jenis'],$x['jenis']);
    $color = array("Cyan", "Magenta", "Yellow");
    foreach($color as $key => $val){
        $main->merek = $merek[$key];
        $main->jenis = $jenis[$key];
        $main->warna = $color[$key];
        $data_tinta = $main->select_tinta();
        $t = $main->fetch($data_tinta);
    
$output .='
        <div class="space"></div>
        <input type="text" class="form-control form-wrn" readonly="readonly" value="'.$t['warna'].'">  
        <input type="hidden" name="kd_tinta[]" value="'.$t['kd_tinta'].'">
        <input type="text" name="stok_tinta[]"  class="form-control form-cyan" readonly="readonly" value="'.$t['stok'].'">
        <input type="text" class="form-control i-sat" value="'.$t['satuan'].'" readonly="readonly">
        <input type="hidden" name="harga[]" value="'.$t['hrg_jual'].'">
        <div class="space"></div>';
}
$output .='
    </div>
    <label class="lbl-space">Masukan Jumlah isi</label>
    <div class="input-group all-grp">';
    $isi = $main->select_edit();
    while($i = $main->fetch($isi)){
    $output .='
        <div class="space"></div>
        <input type="text" class="form-control form-wrn" readonly="readonly" value="'.$i['warna'].'">  
        <input type="hidden" name="isi[]" class="form-control" value="'.$i['isi'].'">
        <input type="text" name="new_isi[]" class="form-control form-cyan" value="'.$i['isi'].'">
        <input type="text" class="form-control i-sat" value="'.$i['satuan'].'" readonly="readonly">
        <div class="space"></div>';
    }

$output .='
    </div>
    <div class="input-group all-grp"> 
            <input type="text" class="form-control label-test" readonly="readonly" value="Hasil Test">
            <input type="text" name="hasil_test" class="form-control hasil_test hasil" value="'.$x['hasil_test'].'">
        <select name="teknisi" class="custom-select selc-teknisi teknisi">
            <option selected>Pilih Teknisi</option>';
            //Read user//
            $data_user = $main->select_user();
            while($u = $main->fetch($data_user)){
            $output .='
                <option value="'.$u['id'].'">'.$u['nama'].'</option>';
            }
$output .='
        </select>
    </div>
    <div class="input-group all-grp">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">Keterangan</span>
        </div>
        <select name="ket" class="custom-select">';
        if($x['ket'] == "isi"){
        $output .='
            <option value='.$x["ket"].' selected>isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($x['ket'] == "Cartridge Non Ori"){
        $output .='
            <option value="isi">isi</option>
            <option value="'.$x['ket'].'" selected>Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($x['ket'] == "MAT"){
        $output .='
            <option value="isi">isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="'.$x['ket'].'" selected>MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($x['ket'] == "Cancel"){
        $output .='
            <option value="isi">isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="'.$x['ket'].'" selected>Cancel</option>
            <option value="Head Rusak">Head Rusak</option>';
        }
        elseif($x['ket'] == "Head Rusak"){
        $output .='
            <option value="isi">isi</option>
            <option value="Cartridge Non Ori">Cartridge Non Ori</option>
            <option value="MAT">MAT</option>
            <option value="Cancel">Cancel</option>
            <option value="'.$x['ket'].'" selected>Head Rusak</option>';
        }
    $output .='
        </select>
            <input type="hidden" name="action" value="edit2">
</div>

<p style="text-align:right">
        <button class="btn btn-riwayat btn-primary" type="button" data-toggle="collapse" data-target="#riwayat-refill"> Riwayat Refill </button>
</p>
<div class="collapse" id="riwayat-refill">
        <div class="card card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal Refill</th>
                        <th>Tipe Cartridge</th>
                        <th>Warna</th>
                        <th>isi</th>
                        <th>Hasil Test</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>';
            $main->no_cartridge = $x['no_cartridge'];
            $riwayat = $main->select_riwayat();
            while($r = $main->fetch($riwayat)){
        $output .='
                <tr>
                    <td>'.$r['date'].'</td>
                    <td>'.$r['tipe'].'</td>
                    <td>'.$r['warna'].'</td>';
        $main->idrefill = $r['idrefill'];
        $isi = $main->jumlah_isi();
        while($i = $main->fetch($isi)){
        $output .='
                    <td>'.$i['jumlah_isi'].'</td>';
            }
        $output .='
                    <td>'.$r['hasil_test'].'</td>
                    <td>'.$r['ket'].'</td>
                </tr>';
            }
        $output .='
            </tbody>
            </table>
    </div>
</div>


    <script>
    $(document).ready(function(){
        $(".btn_refill").show();
        $(".btn_tutup").hide();
    })
    </script>
';}
echo $output;
}
?>
