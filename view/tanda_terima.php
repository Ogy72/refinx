<?
session_start();
if(!empty($_POST)){
    $output = '';
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $kd_head = $_POST['chr_year'];
    $nomor = $_POST['nomor'];
    $tipe = $_POST['tipe'];
    $merek = $_POST['merek'];
    $jenis = $_POST['jenis'];
    $warna = $_POST['warna'];
    $date = date('d-m-Y');
    $no = 1;


$output .='
<div id="print-area" class="tanda-terima">
    <div class="label">
        <h3>TANDA TERIMA.</h3>
        <p>Refillo-Samarinda : 0541-990077</p>
        <p>Jl. Ir H Juanda No-6 Samarinda Kal-Tim</p>
    </div>
    <div class="label-tanggal"><h5>Tanggal : '.$date.'</h5></div>
    <div class="label-nama"><h5>Sudah terima dari : '.$nama.'</h5></div>
    <div class="label-notelp"><h5>Nomor Telepon : '.$no_telp.'</h5></div>

    <table class="table tabel-tanda_terima">
    <thead>
        <tr>
            <th>No</th>
            <th>No Cartridge</th>
            <th>Tipe</th>
            <th>Merek</th>
            <th>Jenis</th>
            <th>Warna</th>
        </tr>
    </thead>
    <tbody>';
    foreach ($nomor as $key => $n){
        $no_cartridge = "$kd_head[$key].$nomor[$key]";
$output .='
        <tr>
            <td>'.$no++.'</td>
            <td>'.$no_cartridge.'</td>
            <td>'.$tipe[$key].'</td>
            <td>'.$merek[$key].'</td>
            <td>'.$jenis[$key].'</td>
            <td>'.$warna[$key].'</td>        
        </tr>';}
$total = $no-1;
$output .='
    <tr>
        <td colspan="5">Total Cartridge</td>
        <td>'.$total.'</td>        
    </tr>
    </tbody>
    </table>
    <div class="penerima">Penerima</div>
    <div class="dot">'.$_SESSION['nama'].'</div>';

echo $output;
}?>

<script>
$(document).ready(function(){

    $('#print-area').printArea();
    
})
</script>