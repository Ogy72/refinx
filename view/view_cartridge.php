<?
include "../model/model_cartridge.php";
date_default_timezone_set('asia/singapore');

$main = new model_cartridge();
$output = '';


if(!empty($_POST)){
    $main->date_now = $_POST['pil_tgl'];
    $data = $main->read_cartridge();
    while($x = $main->fetch($data)){
        $output .='
            <tr>
                <td scope="row" width="10.6%">'.$x["no_cartridge"].'</td>
                <td width="15.7%">'.$x["nama"].'</td>
                <td width="11.1%">'.$x["tipe"].'</td>
                <td width="13.3%">'.date("d-m-Y", strtotime($x["date"])).'</td>
                <td width="11.1%">'.$x["warna"].'</td>
                <td width="13.2%">'.$x["hasil_test"].'</td>
                <td width="12.2%">'.$x["ket"].'</td>
                <td width="14.6%">
                    <input type="button" id="'.$x['no_cartridge'].'" name="edit" value="Edit" class="btn btn-edit btn-sm edit-cartridge">
                    <input type="button" id="'.$x['idrefill'].'" name="hapus" value="Hapus" class="btn btn-danger btn-sm hapus-cartridge">
                </td>
            </tr>';
        }
}
else{
$main->date_now = date('Y-m-d');
$data = $main->read_cartridge();
while($x = $main->fetch($data)){
$output .='
    <tr>
        <td scope="row" width="10.6%">'.$x["no_cartridge"].'</td>
        <td width="15.7%">'.$x["nama"].'</td>
        <td width="11.1%">'.$x["tipe"].'</td>
        <td width="13.3%">'.date("d-m-Y", strtotime($x["date"])).'</td>
        <td width="11.1%">'.$x["warna"].'</td>
        <td width="13.2%">'.$x["hasil_test"].'</td>
        <td width="12.2%">'.$x["ket"].'</td>
        <td width="14.6%">
            <input type="button" id="'.$x['no_cartridge'].'" name="edit" value="Edit" class="btn btn-edit btn-sm edit-cartridge">
            <input type="button" id="'.$x['idrefill'].'" name="hapus" value="Hapus" class="btn btn-danger btn-sm hapus-cartridge">
        </td>
    </tr>';
}
}
echo $output;
?>