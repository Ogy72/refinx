<html>
<body>
<?
date_default_timezone_set('asia/singapore');
$now = date('Y-m-d');
$char = "CR";
$year = date('y');
$chr_year = "$char.$year";
$output = "";

$output .='
<form class="input-cartridge" method="post">
    <label>Nomor Telepon</label><label class="lbl-nama">Nama</label>
    <div class="form-inline">
        <input type="hidden" name="action" value="insert">
        <input type="text" name="no_telp" class="form-control form-notelp" placeholder="No Telepon">
        <input type="text" name="nama" class="form-control form-nama" placeholder="Nama Pemilik">
        <button class="add-more btn-more" type="button">Tambah Form Cartridge</button>
    </div>
    <div class="input-group control-group after-add-more"></div>
</form>';
echo $output;
?>

    <!--Copy Field -->
    <div class="copy hide">
    <div class="control-group input-group" style="margin-top:10px">
        <div class="form-inline">
            <input type="text" name="chr_year[]" class="form-control form-char" value="<? echo $chr_year ?>" readonly="readonly">
            <input type="text" name="nomor[]" class="form-control form-no_cart" placeholder="No Cartridge">
            <input type="text" name="tipe[]" class="form-control form-tipe" placeholder="Tipe">
            <input type="text" name="merek[]" class="form-control form-merek" placeholder="Merek">
            <select name="jenis[]" class="custom-select form-jenis">
                <option selected>Jenis Cartridge</option>
                <option value="Inkjet">Inkjet</option>
                <option value="Laserjet">Laserjet</option>
            </select>
            <select name="warna[]" class="custom-select form-warna">
                <option selected>Pilih Warna</option>
                <option value="Black">Black</option>
                <option value="C/M/Y">C/M/Y</option>
                <option value="Cyan">Cyan</option>
                <option value="Magenta">Magenta</option>
                <option value="Yellow">Yellow</option>
            </select>
            <input type="hidden" name="date[]" value="<? echo $now ?>">
        <div class="input-group-btn">
            <button class="btn-remove remove" type="button">Hapus</button>
        </div>
        </div>
    </div>
    </div>

<script>
$(document).ready(function() {

    $('.hide').hide();

    $(".add-more").click(function(){
        var html = $(".copy").html();
        $(".after-add-more").after(html);
    });
    $("body").on("click",".remove", function(){
        $(this).parents(".control-group").remove();
    });

     /*get name pemilik by number*/
     $(document).on('keyup','.form-notelp', function(){
      var no_telp = $('.form-notelp').val();
      $.ajax({
        type:"POST",
        url:"controller/get-pelanggan.php",
        data:{no_telp:no_telp},
        dataType:"json",
        success:function(data){
          $('.form-nama').val(data.nama);
        }
      });
    });

})
</script>
</body>
</html>
