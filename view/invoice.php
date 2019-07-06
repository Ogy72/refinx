<?
include "../model/model_invoice.php";
$get = new model_invoice();

if(!empty($_POST)){
    
    $output = '';
    $tgl = $_POST['tgl'];
    $get->date = $_POST['tgl'];
    $get->nama = $_POST['nama'];
    $get->no_telp = $_POST['notelp'];
    $no = 1;
    $total_biaya = 0;
    if($tgl == ''){
        $output ='Silahkan isi Semua Form';
    }
    else{
        $data = $get->read_invoice();
        $output .='
        <table class="table table-bordered">
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
        while ($x = $get->fetch($data)){
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
        $total_biaya = ($total_biaya+$i["total_biaya"]);}}
        $total = $no-1;
        $output .='
            <tr>
                <td colspan="2">Total Cartridge</td>
                <td>'.$total.'</td>
                <td colspan="2">Total Biaya</td>
                <td>Rp.'.$total_biaya.'</td>
            </tr>
        </tbody>
        </table>';
    }
echo $output;
}
?>