<?
include "../model/model_user.php";
$main = new model_user;

if(isset($_POST['id'])){
    $output = "";
    $main->id = $_POST['id'];
    $data = $main->select_user();
    $x = $main->fetch($data);
    
$output .='
    <label>Nama</label><label class="lbl-username">Username</label>
    <div class="form-inline">
        <input type="text" name="nama" class="form-control form-nuser" value='.$x["nama"].'>
        <input type="text" name="username" class="form-control form-username" value='.$x["username"].'>
    </div>
    <label>Password</label><label class="lbl-level">Level</label>
    <div class="form-inline">
        <input type="text" name="password" class="form-control form-password" value='.$x["password"].'>
        <select class="custom-select form-level" id="level" name="level">';
        if($x["level"] == "Admin" or $x["level"] == "admin" ){
        $output .='
                <option value='.$x["level"].' selected>Admin</option>
                <option value="Teknisi">Teknisi</option>';
        }
        elseif($x["level"] == "Teknisi" or $x["level"] == "teknisi"){
        $output .='
                <option value="Admin">Admin</option>
                <option value='.$x["level"].' selected>Teknisi</option>
        ';}
$output .='
        </select>
    </div>
    <input type="hidden" name="id" value='.$x["id"].'>
    <input type="hidden" name="action" value="edit_user">';
echo $output;
}
?>