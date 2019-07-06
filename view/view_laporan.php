<?
session_start();
include "../model/model_laporan.php";
$lap = new model_laporan();

if(!empty($_POST)){

    $output = '';
    $laopran = $_POST['laporan'];
    $tgl_start = $_POST['tgl_start'];
    $tgl_end = $_POST['tgl_end'];

    //laporan stok tinta
    if($laopran == 'laporan-stok'){
$output .='
        <div class="area-print_lap">
            <div class="head-hidden">
                <h3> Laporan Stok Tinta </h3>
                <h4> Refillo Samarinda </h4>
                <h5> Periode : '.date("d-m-Y", strtotime($tgl_start)).' - '.date("d-m-Y", strtotime($tgl_end)).' <h5> 
            </div>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th width="20%">Tanggal Masuk</th>
                    <th width="20%">Kode Tinta</th>
                    <th width="15%">Warna</th>
                    <th width="15%">Merek</th>
                    <th width="13%">Stok Tersedia</th>
                    <th>Stok Terpakai</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>';
    $lap->tgl_start = $tgl_start;
    $lap->tgl_end = $tgl_end;
    $data = $lap->laporan_stok();
    while($x = $lap->fetch($data)){
$output .='
            <tr>
                <td>'.date("d-m-Y", strtotime($x['date'])).'</td>
                <td>'.$x['kd_tinta'].'</td>
                <td>'.$x['warna'].'</td>
                <td>'.$x['merek'].'</td>
                <td>'.$x['stok'].'</td>';
    $lap->kd_tinta = $x['kd_tinta'];
    $terpakai = $lap->stok_terpakai();
    while($stp = $lap->fetch($terpakai)){
$output .='
                <td>'.$stp['stok_terpakai'].'</td>';
        }
$output .='
                <td>'.$x['satuan'].'</td>
            </tr>';
    }
$output .='
        </tbody>
        </table>
            <div class="foot-hidden">
                <h5> Samarinda '.date("d-m-Y").'</h5>
                <h5> ....................... </h5>
                <h5>'.$_SESSION['nama'].'<h5> 
            </div>
        </div>';
    }
    //laporan cartridge
    elseif($laopran == 'laporan-cartridge'){
$output .='
        <div class="area-print_lap">
            <div class="head-hidden">
                <h3> Laporan Cartridge Masuk </h3>
                <h4> Refillo Samarinda </h4>
                <h5> Periode : '.date("d-m-Y", strtotime($tgl_start)).' - '.date("d-m-Y", strtotime($tgl_end)).' <h5> 
            </div>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th width="20%">Pemilik</th>
                    <th width="15%">Tipe Cartridge</th>
                    <th width="10%">Merek</th>
                    <th width="10%">Warna</th>
                    <th width="15%">Jenis Cartridge</th>
                    <th width="15%">Jumlah Cartridge Masuk</th>
                </tr>
            </thead>
            <tbody>';
    $lap->tgl_start = $tgl_start;
    $lap->tgl_end = $tgl_end;
    $data = $lap->laporan_cartridge();
    while($x = $lap->fetch($data)){
$output .='
            <tr>
                <td>'.$x['nama'].'</td>
                <td>'.$x['tipe'].'</td>
                <td>'.$x['merek'].'</td>
                <td>'.$x['warna'].'</td>
                <td>'.$x['jenis'].'</td>
                <td>'.$x['cartin'].'</td>
            </tr>';
        }
        $lap->tgl_start = $tgl_start;
        $lap->tgl_end = $tgl_end;
        $tcart = $lap->count_tcart();
        while($t = $lap->fetch($tcart)){
$output .='
            <tr>
                <td colspan="5">Total Cartridge Masuk</td>
                <td>'.$t['total'].'</td>
            </tr>';
        }
$output .='
        </tbody>
        </table>
            <div class="foot-hidden">
                <h5> Samarinda '.date("d-m-Y").'</h5>
                <h5> ....................... </h5>
                <h5> '.$_SESSION['nama'].' <h5> 
            </div>
        <div>';
    }
    //laporan pendapatan
    elseif($laopran == 'laporan-pendapatan'){
        $output .='
                <div class="area-print_lap">
                    <div class="head-hidden">
                        <h3> Laporan Pendapatan </h3>
                        <h4> Refillo Samarinda </h4>
                        <h5> Periode : '.date("d-m-Y", strtotime($tgl_start)).' - '.date("d-m-Y", strtotime($tgl_end)).' <h5> 
                    </div>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th width="20%">Tanggal Masuk</th>
                            <th width="20%">Pemilik</th>
                            <th width="15%">Tipe Cartridge</th>
                            <th width="15%">Warna</th>
                            <th width="15%">Jenis Cartridge</th>
                            <th width="5%" colspan="2">isi</th>
                            <th width="15%">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>';
            $lap->tgl_start = $tgl_start;
            $lap->tgl_end = $tgl_end;
            $data = $lap->count_income();
            while($x = $lap->fetch($data)){
        $output .='
                    <tr>
                        <td>'.$x['date'].'</td>
                        <td>'.$x['nama'].'</td>
                        <td>'.$x['tipe'].'</td>
                        <td>'.$x['warna'].'</td>
                        <td>'.$x['jenis'].'</td>
                        <td>'.$x['total_isi'].'</td>
                        <td>'.$x['satuan'].'</td>
                        <td>Rp. '.$x['total_biaya'].'</td>
                    </tr>';
                }
                $lap->tgl_start = $tgl_start;
                $lap->tgl_end = $tgl_end;
                $tcart = $lap->cartridge_dibayar();
                while($t = $lap->fetch($tcart)){
        $output .='
                    <tr>
                        <td colspan="2">Total Cartridge</td>
                        <td>'.$t['total_cartridge'].'</td>';
                }
                $lap->tgl_start = $tgl_start;
                $lap->tgl_end = $tgl_end;
                $income = $lap->total_income();
                while($i = $lap->fetch($income)){
        $output .='
                        <td colspan="4">Total Pendapatan</td>
                        <td>Rp. '.$i['total_biaya'].'</td>
                    </tr>';
                }
        $output .='
                </tbody>
                </table>
                    <div class="foot-hidden">
                        <h5> Samarinda '.date("d-m-Y").'</h5>
                        <h5> ....................... </h5>
                        <h5> '.$_SESSION['nama'].' <h5> 
                    </div>
                <div>';
            }
echo $output;
}
?>

<script>
$(document).ready(function(){

    $('.head-hidden').hide();
    $('.foot-hidden').hide();

    $('.btn-print').click(function(){
        $('.head-hidden').show();
        $('.foot-hidden').show();
        $('.area-print_lap').printArea();
        $('.head-hidden').hide();
        $('.foot-hidden').hide();
    });
    
})
</script>