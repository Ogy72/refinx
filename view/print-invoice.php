<?
session_start();
include "../model/model_invoice.php";
$get = new model_invoice();

if(!empty($_POST)){

    $output = '';
    $tgl = date('d-m-Y');
    $get->date = $_POST['tgl'];
    $get->nama = $_POST['nama'];
    $get->no_telp = $_POST['notelp'];
    $no = 1;
    $total_biaya = 0;

    $data = $get->read_invoice();
$output .='
    <div id="are-print_invoice" class="invoice">
        <div id="panel-invoice"><h1>INVOICE.</h1></div>
    
        <div id="panel-company">
            <p>Refillo Samarinda</p>
            <p>Jl. Ir. H Juanda No-6 Samarinda Kalimantan Timur</p>
            <p>Telepon : 0541-990077</p>
        </div>

        <div id="panel-pelanggan">
            <table>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>'.$tgl.'</td>
                </tr>
                <tr>
                    <td>Kepada</td>
                    <td></td>
                    <td>Yth.</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>'.$get->nama.'</td>
                </tr>
                <tr>
                    <td>No Telp</td>
                    <td>:</td>
                    <td>'.$get->no_telp.'</td>
                </tr>
            </table>
        </div>

        <div id="panel-table">
            <table class="table table-invoice">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Cartridge</th>
                        <th>Tipe</th>
                        <th>Hasil Test</th>
                        <th>isi</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>';
            while($x = $get->fetch($data)){
            $output .='
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$x["no_cartridge"].'</td>
                        <td>'.$x["tipe"].'</td>
                        <td>'.$x["hasil_test"].'</td>';
            $get->idrefill = $x['idrefill'];
            $isi = $get->jumlah_isi();
            while($i = $get->fetch($isi)){
            $sat = $get->satuan();
            $s = $get->fetch($sat);
            $output .='
                <td>'.$i["jumlah_isi"].''.$s["satuan"].'</td>
                <td>Rp.'.$i["total_biaya"].'</td>';
            $output .='</tr>';
            $total_biaya = ($total_biaya+$i["total_biaya"]);
            $get->idrefill = $x["idrefill"];
            $get->update_status();}}
            $total = $no-1;
            $output .='
                    <tr>
                        <td colspan="2">Total Cartridge</td>
                        <td>'.$total.'</td>
                        <td colspan="2">Total Biaya</td>
                        <td>Rp.'.$total_biaya.'</td>
                    </tr>
                </tbody>
            </table>
        </div>

            <div id="panel-pelanggan_ttd">
                <p>Pelanggan</p><br><br>
                <p>............</p>
            </div>

            <div id="panel-company_ttd">
                <p>Admin</p><br><br>
                <p>'.$_SESSION['nama'].'</p>
            </div>
    </div>';
echo $output;
}
?>

<script>
$(document).ready(function(){

    $('#are-print_invoice').printArea();
    
})
</script>