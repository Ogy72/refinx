<?
include "../model/model_user.php";
$output = '';

$main = new model_user();
$data = $main->read_user();
$no = 1;

while ($x = $main->fetch($data)) {
$output .='
    <tr>
        <td scope="row" width="14.3%">'.$no++.'</td>
        <td width="21.2%">'.$x["nama"].'</td>
        <td width="19.2%">'.$x["username"].'</td>
        <td width="17.3%">'.$x["password"].'</td>
        <td width="15.3%">'.$x["level"].'</td>
        <td>
            <input type="button" id="'.$x['id'].'" name="edit" value="Edit" class="btn btn-edit btn-sm edit-user">
            <input type="button" id="'.$x['id'].'" name="hapus" value="Hapus" class="btn btn-danger btn-sm hapus-user">
        </td>
    </tr>';
}
echo $output;
?>