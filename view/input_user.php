<?
$output = "";

$output .='
    <label>Nama</label><label class="lbl-username">Username</label>
    <div class="form-inline">
        <input type="text" name="nama" class="form-control form-nuser" placeholder="Nama">
        <input type="text" name="username" class="form-control form-username" placeholder="Username">
    </div>
    <label>Password</label><label class="lbl-level">Level</label>
    <div class="form-inline">
        <input type="text" name="password" class="form-control form-password" placeholder="Password">
        <select class="custom-select form-level" id="level" name="level" >
            <option selected>Pilih Level</option>
            <option value="Admin">Admin</option>
            <option value="Teknisi">Teknisi</option>
        </select>
    </div>
    <input type="hidden" name="action" value="insert">';
echo $output;
?>