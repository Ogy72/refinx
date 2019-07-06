<!DOCTYPE html>
<html lang="en">

<div class="label-menu"> Data Cartridge</div>

<button type="button" class="btn btn-sm add-cartridge" id="btn-input">Tambah Data Cartridge</button>
<button type="button" class="btn btn-sm add-invoice" id="btn-invoice">Buat Invoice</button>
<hr>

<body>

<div class="input-group-calender">
  <input type="text" name="pil-tgl" class="form-calender datepicker form-tgl" id="pil-tgl" placeholder="Lihat Berdasarkan Tanggal">
  <i class="far fa-calendar icon-calender"></i>
</div>

<table class="table table-striped" >
    <thead class="thead-dark">
        <tr>
            <th width="10.5%">No Cartridge</th>
            <th width="15.5%">Pemilik</th>
            <th width="11%">Tipe</th>
            <th width="13%">Tanggal Masuk</th>
            <th width="11%">Warna</th>
            <th width="13%">Hasil Test</th>
            <th width="12%">keterangan</th>
            <th width="14.5%">Options</th>
        </tr>
    </thead>
</table>
<div class="table-scroll_cartridge">
<table class="table table-striped">
    <tbody id="table-cartridge" >
    </tbody>
</table>
</div>
</body>
</html>

<!--Modal Input-->
<div class="modal fade modal-cartridge" id="modal-cartridge" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header"><!--div header-->
        <h5 class="modal-title">Tambah Data Cartridge</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--close div header-->
      <div class="modal-body"><!--modal body-->
            <div id="form-cartridge"></div>			
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Simpan" class="btn-cart btn btn-simpan" data-dismiss="modal">    
      </div>
    </div>
  </div>
</div>

<!--Modal Edit-->
<div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-edt" role="document">
    <div class="modal-content">
      <div class="modal-header"><!--div header-->
        <h5 class="modal-title">Edit Data Cartridge</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--close div header-->
      <div class="modal-body"><!--modal body-->
            <div id="form-e_cartridge"></div>			
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Simpan" class="btn-e_cart btn btn-simpan" data-dismiss="modal">    
      </div>
    </div>
  </div>
</div>

<!--Modal Invoice-->
<div class="modal fade modal-invoice" id="modal-invoice" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-inv" role="document">
    <div class="modal-content">
      <div class="modal-header"><!--div header-->
        <h5 class="modal-title">Invoice Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--close div header-->
      <div class="modal-body"><!--modal body-->
      <form class="invoice-cartridge" method="post">
        <label>Nomor Telepon</label><label class="lbl-nama">Nama</label><label class="lbl-tgl">Pilih Tanggal</label>
        <div class="form-inline">
          <input type="hidden" name="action" value="insert">
          <input type="text" name="no_telp" class="form-control form-notelp" id="no_telp" placeholder="No Telepon">
          <input type="text" name="nama" class="form-control form-nama2" placeholder="Nama Pemilik">
          <input type="text" name="tgl-msuk" class="form-control datepicker frm-tgl" id="tgl" placeholder="Tanggal Masuk Cartridge">
        </div>
        <div class="tampil-invoice"></div>	
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Cetak Invoice" class="btn-invoice btn btn-simpan" data-dismiss="modal">    
      </form>	
      </div>
    </div>
  </div>
</div>

<!--modal hapus-->
<div class="modal fade modal-hapus" id="modal-hapus" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header"><!--div header-->
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--close div header-->
      <div class="modal-body"><!--modal body-->
          <h5 class="modal-title">Hapus Data Cartridge ?</h5>
      <form id="data-for-hapus" method="post">
            <div id="data-hapus"></div>
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Hapus" class="btn-hapus btn btn-sm btn-danger hide-btn" data-dismiss="modal">    
        <input type="submit" name="submit" value="Batal" class="btn-cancel btn btn-sm btn-primary" data-dismiss="modal">
      </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    
    data_cartridge();

    function data_cartridge(){
      $.ajax({
        url:"view/view_cartridge.php",
        method:"POST",
        success:function(data)
        {
          $('#table-cartridge').html(data);
        }
      })
    }

    function data_bydate(){
      var pil_tgl = $('.form-tgl').val();
      $.ajax({
        url:"view/view_cartridge.php",
        method:"POST",
        data:{pil_tgl:pil_tgl},
        success:function(data)
        {
          $('#table-cartridge').html(data);
        }
      })
    }
    
    /*ajax lihat data berdasarkan tanggal*/
    $('#pil-tgl').change(function(){
      var pil_tgl = $('#pil-tgl').val();
      if($('#pil-tgl').val() == '')
      {
        data_cartridge();
      }
      else{
      $.ajax({
        url:"view/view_cartridge.php",
        method:"POST",
        data:{pil_tgl:pil_tgl},
        success:function(data){
          $('#table-cartridge').html(data);
        }
      });
      }
    });

    /*datetimepicker*/
    $(function(){
      $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        clearBtn:true,
      });
    });

    /*menampilkan modal input*/
    $('.add-cartridge').click(function(){
        $.ajax({
            url:"view/input_cartridge.php",
            method:"POST",
            success:function(data){
               $('#form-cartridge').html(data) ;
               $('#modal-cartridge').modal('show');
            }
        });
    });

    /*ajax get data for edit*/
    $(document).on('click','.edit-cartridge', function(){
      var no_cart = $(this).attr("id");
      $('#modal-edit').modal('show');
      $.ajax({
        url:"view/edit_cartridge.php",
        method:"POST",
        data:{no_cart:no_cart},
        success:function(data){
          $('#form-e_cartridge').html(data);
        }
      });
    });

     /*menampilkan modal invoice*/
     $('.add-invoice').click(function(){
        $(".form-notelp").val(null).trigger("change");
        $(".form-nama2").val(null).trigger("change");
        $(".frm-tgl").val(null).trigger("change");
        $('#modal-invoice').modal('show');
      });

     /*get name pemilik by number*/
     $('#no_telp').keyup(function(){
      var no_telp = $('#no_telp').val();
      $.ajax({
        type:"POST",
        url:"controller/get-pelanggan.php",
        data:{no_telp:no_telp},
        dataType:"json",
        success:function(data){
          $('.form-nama2').val(data.nama);
        }
      });
    });

    /*get data cartridge by pemilik and date*/
    $("#tgl").change(function(){
      var tgl = $('#tgl').val();
      var nama = $('.form-nama2').val();
      var notelp = $('#no_telp').val();
      $.ajax({
        url:"view/invoice.php",
        method:"POST",
        data:{tgl:tgl, nama:nama, notelp:notelp},
        success:function(data){
          $('.tampil-invoice').html(data);
        }
      });
    });

    /*cetak invoice*/
    $(".btn-invoice").click(function(){
      var tgl = $('#tgl').val();
      var nama = $('.form-nama2').val();
      var notelp = $('#no_telp').val();
      $.ajax({
        url:"view/print-invoice.php",
        method:"POST",
        data:{tgl:tgl, nama:nama, notelp:notelp},
        success:function(data){
          $('.tampil-invoice').html(data);
        }
      });
    });

    /*ajax update data*/
    $('.btn-e_cart').click(function(){
      if($('.edit-notelp').val() == "")
        {
            alert("Harap isi nomor telepon");
            return false;
        }
      else if($('.edit-nama').val() == "")
        {
            alert("Harap isi nama");
            return false;
        }
      else if($('.edit-no_cart').val() == "")
        {
            alert("Harap isi nomor cartridge");
            return false;
        }
      else if($('.edit-tipe').val() == "")
        {
            alert("Harap isi tipe cartridge");
            return false;
        }
      else if($('.edit-merek').val() == "")
        {
            alert("Harap isi merek cartridge");
            return false;
        }
      else if($('.edit-warna').val() == "Pilih Warna")
        {
            alert("Harap pilih tipe warna");
            return false;
        }
        else{
          $.ajax({
            url:"controller/controller_cartridge.php",
            method:"POST",
            data:$('.editCartridge').serialize(),
            success:function(data){
              if($('.form-tgl').val() == ""){
              data_cartridge();
              }
              else{
                data_bydate();
              }
            }
          });
        }
    });

    /*ajax get data for delete*/
    $(document).on('click','.hapus-cartridge', function(){
      var idrefill = $(this).attr("id");
      $('#modal-hapus').modal('show');
      $.ajax({
        url:"view/hapus_cartridge.php",
        method:"POST",
        data:{idrefill:idrefill},
        success:function(data){
          $('#data-hapus').html(data);
          if($('.stat').val() == 'hidden-btn'){
            $('.hide-btn').hide();
            $('.modal-title').hide();
          }else{
            $('.hide-btn').show()
            $('.modal-title').show();
          };
        }
      });
    });

    /*delete and restock tinta*/
    $('.btn-hapus').click(function(){
      $.ajax({
        url:"controller/controller_cartridge.php",
        method:"POST",
        data:$('#data-for-hapus').serialize(),
        success:function(data){
        if($('.form-tgl').val() == ""){
            data_cartridge();
          }
          else{
            data_bydate();
          }
        }
      });
    });

    /*ajax simpan data*/
    $('.btn-cart').click(function(){
      if($('.form-notelp').val() == "")
        {
            alert("Harap isi nomor telepon");
            return false;
        }
      else if($('.form-nama').val() == "")
        {
            alert("Harap isi nama");
            return false;
        }
      else if($('.form-no_cart').val() == "")
        {
            alert("Harap isi nomor cartridge");
            return false;
        }
      else if($('.form-tipe').val() == "")
        {
            alert("Harap isi tipe cartridge");
            return false;
        }
      else if($('.form-merek').val() == "")
        {
            alert("Harap isi merek cartridge");
            return false;
        }
      else if($('.form-warna').val() == "Pilih Warna")
        {
            alert("Harap pilih tipe warna");
            return false;
        }
        else{
          $.ajax({
            url:"controller/controller_cartridge.php",
            method:"POST",
            data:$('.input-cartridge').serialize(),
            success:function(data){
            data_cartridge(); 
            var answer = confirm("Cetak tanda terima ?");
            if (answer == true){
              $.ajax({
                url:"view/tanda_terima.php",
                method:"POST",
                data:$('.input-cartridge').serialize(),
                success:function(data){
                  $('#form-cartridge').html(data);
                  $('#modal-cartridge').modal('hide');
                }
              });
            }
          }
        });
      }
    });
})
</script>