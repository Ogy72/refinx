<!DOCTYPE html>
<html lang="en">

<div class="label-menu">Refill</div>
<hr>

<body>
<div class="input-group-calender">
  <input type="text" name="pil-tgl" class="form-calender datepicker" id="pil_tgl" placeholder="Lihat Berdasarkan Tanggal">
  <i class="far fa-calendar icon-calender"></i>
</div>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th width="13.7%">No Cartridge</th>
            <th width="12%">Tanggal Masuk</th>
            <th width="11.5%">Tipe</th>
            <th width="9.5%">Jumlah isi</th>
            <th width="14.5%">Hasil Test</th>
            <th width="15.5%">Keterangan</th>
            <th width="">Teknisi</th>
            <th style="padding-left:25px">Options</th>
        </tr>
    </thead>
</table>

<div class="table-scroll_cartridge">
<table class="table table-striped">
    <tbody id="table-refill"></tbody>
</table>
</div>
    
</body>
</html>

<!--modal refill-->
<div class="modal fade modal-refill" id="modal-refill" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header"><!--div header-->
        <h5 class="modal-title">Refill Cartridge</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--close div header-->
      <div class="modal-body"><!--modal body-->
      <form class="input-refill">
            <div id="form-refill"></div>			
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Simpan" class="btn_refill btn btn-simpan" data-dismiss="modal">    
        <input type="button" value="Close" class="btn_tutup btn btn-simpan btn-danger" data-dismiss="modal">    
      </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

    data_refill();

    function data_refill(){
        $.ajax({
            url:"view/view_refill.php",
            method:"POST",
            success:function(data)
            {
                $('#table-refill').html(data);
            }
        })
    }

    function data_bydate(){
      var pil_tgl = $('.form-calender').val();
      $.ajax({
        url:"view/view_refill.php",
        method:"POST",
        data:{pil_tgl:pil_tgl},
        success:function(data)
        {
          $('#table-refill').html(data);
        }
      })
    }

     /*datetimepicker*/
     $(function(){
      $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        clearBtn:true,
      });
    });

    /*ajax lihat data berdasarkan tanggal*/
    $('#pil_tgl').change(function(){
      var pil_tgl = $('#pil_tgl').val();
      if($('#pil_tgl').val() == '')
      {
        data_refill();
      }
      else{
      $.ajax({
        url:"view/view_refill.php",
        method:"POST",
        data:{pil_tgl:pil_tgl},
        success:function(data){
          $('#table-refill').html(data);
        }
      });
      }
    });

    /*js menampilkan data dan modal*/
    $(document).on('click','.refill', function(){
        var idrefill = $(this).attr("id");
        $('#modal-refill').modal('show');
        $.ajax({
          url:"view/input_refill.php",
          method:"POST",
          data:{idrefill:idrefill},
          success:function(data){
            $('#form-refill').html(data);
          }
        });
    });

    /*js menampilkan data dan modal untuk edit*/
    $(document).on('click','.edit-refill', function(){
        var idrefill = $(this).attr("id");
        $('#modal-refill').modal('show');
        $.ajax({
          url:"view/edit_refill.php",
          method:"POST",
          data:{idrefill:idrefill},
          success:function(data){
            $('#form-refill').html(data);
          }
        });
    });

    /*ajax simpan data*/
    $('.btn_refill').click(function(){
      if($('.teknisi').val() == "Pilih Teknisi")
      {
            alert("Harap Pilih Teknisi");
            return false;
      }
      else if($('.hasil').val() == "")
      {
            alert("Harap isi hasil test cartridge");
            return false;
      }
      else{
      $.ajax({
        url:"controller/controller_refill.php",
        method:"POST",
        data:$('.input-refill').serialize(),
        success:function(data){
          if($('.form-calender').val() == ""){
            data_refill();
          }
          else{data_bydate();}
        }
      });
    }
    });
})
</script>