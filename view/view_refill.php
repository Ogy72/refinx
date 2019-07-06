<?
include "../model/model_refill.php";
date_default_timezone_set('asia/singapore');

$main = new model_refill();
$output = '';

if(!empty($_POST)){
    $main->date = $_POST['pil_tgl'];
    $data = $main->read_refill();
    while($x = $main->fetch($data)){
        $output .='
            <tr>
                <td scope="row" width="14%">'.$x["no_cartridge"].'</td>
                <td width="12.2%">'.date("d-m-Y", strtotime($x["date"])).'</td>
                <td width="11.6%">'.$x["tipe"].'</td>';

            $main->idrefill = $x['idrefill'];
            $isi = $main->jumlah_isi();
            while($i = $main->fetch($isi)){
            $sat = $main->satuan();
            $s = $main->fetch($sat);
            $output .='
                    <td width="9.7%">'.$i["jumlah_isi"].''.$s['satuan'].'</td>';
                }
        $output .='
                <td width="14.7%">'.$x["hasil_test"].'</td>
                <td width="15.6%">'.$x["ket"].'</td>';
                $user = $main->select_teknisi();
                $t = $main->fetch($user);
        $output .='<td width="10.6%">'.$t['nama'].'</td>
                <td style="text-align:center">
                    <input type="button" id="'.$x['idrefill'].'" name="refill" value="Refill" class="btn btn-refill btn-sm refill">
                    <input type="button" id="'.$x['idrefill'].'" name="edit" value="Edit" class="btn btn-edit btn-sm edit-refill">
                </td>
            </tr>';
        }
}
else{
$main->date = date('Y-m-d');
$data = $main->read_refill();
while($x = $main->fetch($data)){
$output .='
    <tr>
        <td scope="row" width="14%">'.$x["no_cartridge"].'</td>
        <td width="12.2%">'.date("d-m-Y", strtotime($x["date"])).'</td>
        <td width="11.6%">'.$x["tipe"].'</td>';

    $main->idrefill = $x['idrefill'];
    $isi = $main->jumlah_isi();
    while($i = $main->fetch($isi)){
    $sat = $main->satuan();
    $s = $main->fetch($sat);
    $output .='
        <td width="9.7%">'.$i["jumlah_isi"].''.$s['satuan'].'</td>';
    }

$output .='
        <td width="14.7%">'.$x["hasil_test"].'</td>
        <td width="15.6%">'.$x["ket"].'</td>';
    $user = $main->select_teknisi();
    $t = $main->fetch($user);
$output .='<td width="10.6%">'.$t['nama'].'</td>
        <td style="text-align:center">
            <input type="button" id="'.$x['idrefill'].'" name="refill" value="Refill" class="btn btn-refill btn-sm refill">
            <input type="button" id="'.$x['idrefill'].'" name="edit" value="Edit" class="btn btn-edit btn-sm edit-refill">
        </td>
    </tr>';
}
}
echo $output;
?>