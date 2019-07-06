<?
include "../model/model_tinta.php";
$output = '';

$main = new model_tinta();
$data = $main->read_tinta();

while($x = $main->fetch($data)){
$output .='
        <tr>
            <td scope="row" width="11.3%">'.$x["kd_tinta"].'</td>
            <td width="11.2%">'.$x["warna"].'</td>
            <td width="11.3%">'.$x["merek"].'</td>
            <td width="10.2%">'.$x["stok"].'</td>
            <td width="8.4%">'.$x["satuan"].'</td>
            <td width="12.4%">Rp.'.$x["hrg_beli"].'</td>
            <td width="10%">Rp.'.$x["hrg_jual"].'</td>
            <td width="12.5%">'.date("d-m-Y", strtotime($x["date"])).'</td>
            <td>
                <input type="button" id="'.$x['kd_tinta'].'" name="edit" value="Edit" class="btn btn-edit btn-sm edit-tinta">
                <input type="button" id="'.$x['kd_tinta'].'" name="hapus" value="Hapus" class="btn btn-danger btn-sm hapus-tinta">
            </td>
        </tr>';
    }
echo $output;
?>