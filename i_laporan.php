<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/select2.min.css">
    <script src="js/select2.min.js"></script>
</head>

<div class="label-menu"> Laporan </div>

<div class="form-inline">
    <div class="group-calender cal-1">
        <input type="text" name="pil-tgl" class="cald-control datepicker tgl1" id="tgl_start" placeholder="Pilih Tanggal Awal">
        <i class="far fa-calendar icon-calender2"></i>
    </div>

    <div class="group-calender cal-2">
        <input type="text" name="pil-tgl" class="cald-control datepicker tgl2" id="tgl_end" placeholder="Pilih Tangaal Akhir">
        <i class="far fa-calendar icon-calender2"></i>
    </div>

    <div class="cal-3">
    <select id="select-lap" name="select-lap" style="width:200px" class="select-lap">
        <option value=""></option>
        <option value="laporan-stok">Laporan Stok</option>
        <option value="laporan-cartridge">Laporan Data Cartridge</option>
        <option value="laporan-pendapatan">Laporan Pendapatan</option>
    </select>
    </div>
</div>
<hr>

<body>
    <div class="table-scroll_print">
        <div id="table-laporan"></div>
    </div> 
<hr>
<input type="submit" name="submit" value="Cetak Laporan" class="btn btn-print btn-sm" style="padding:5px; font-size:15px">   
</body>
</html>

<script>
$(document).ready(function(){

    $('.btn-print').hide();

    /*datetimepicker*/
    $(function(){
      $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        clearBtn:true,
      });
    });

    /*Select2 Pilih Laporan */
    $("#select-lap").select2({
        placeholder: 'Pilih Laporan',
        minimumResultsForSearch: Infinity,
        allowClear:true,
    });

    $('.select-lap').change(function(){
        var laporan = $('.select-lap').val();
        var tgl_start = $('.tgl1').val();
        var tgl_end = $('.tgl2').val();
        $.ajax({
            url:"view/view_laporan.php",
            method:"POST",
            data:{laporan:laporan, tgl_start:tgl_start, tgl_end:tgl_end},
            success:function(data){
                $('#table-laporan').html(data);
                $('.btn-print').show();
                if((laporan) == ""){
                    $('.btn-print').hide();
                }
            }
        })
    })
    
})
</script>