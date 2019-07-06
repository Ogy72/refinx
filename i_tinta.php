<html>

<div class="label-menu">Stok Tinta</div>

<button type="button" class="btn btn-sm btn-input" id="btn-input">Input Stok Tinta</button>
<hr>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
        <th width="11%">Kode Tinta</th>
        <th width="11%">Warna</th>
        <th width="11%">Merek</th>
        <th width="10%">Stok</th>
        <th width="8%">Satuan</th>
        <th width="12%">Harga Beli</th>
        <th width="10%">Harga Jual</th>
        <th width="12%">Tanggal Masuk</th>
        <th width="14%">Options</th>
    </tr>
  </thead>
</table>
<div class="table-scroll">
  <table class="table table-striped">
    <tbody id="table-tinta"></tbody>
  </table>
</div>
</html>

<!--Modal Input-->
<div class="modal fade" id="modal-tinta" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title-input">Input Stok Tinta</h5><h5 class="modal-title title-edit">Edit Stok Tinta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!--modal body-->
		  <form class="post-tinta" method="post">
            <label id="kd-tinta">Kode Tinta</label>
                <input type="text" name="kd_tinta" class="form-control frm-tinta" placeholder="Kode Tinta">
                <div class="form-tinta"></div>			
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Simpan" class="submit btn btn-simpan" data-dismiss="modal">    
      </form>
      </div>
    </div>
  </div>
</div>

<!--modal hapus-->
<div class="modal fade modal-hapus" id="hapus-tinta" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header"><!--div header-->
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--close div header-->
      <div class="modal-body"><!--modal body-->
          <h5 class="modal-title">Hapus Data Tinta ?</h5>
          <input type="Hidden" name="kd-tinta" class="kd_tinta">
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Hapus" class="hapus_tinta btn btn-sm btn-danger" data-dismiss="modal">    
        <input type="submit" value="Batal" class="btn btn-sm btn-primary" data-dismiss="modal">
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

    $('.title-edit').hide();
    data_tinta(); /*load data tinta*/
    
    /*ajax load data*/
    function data_tinta()
    {
        $.ajax({
            url:"view/view_tinta.php",
            method:"POST",
            success:function(data)
            {
                $('#table-tinta').html(data)
            }
        })
    }

    /*menampilkan modal input dan tambah stok*/
    $('.btn-input').click(function(){
      $(".form-tinta").html(null).trigger("change");
      $(".frm-tinta").val(null).trigger("change");
      $('.title-input').show();
      $('.title-edit').hide();
      $('.frm-tinta').show();
      $('#kd-tinta').show();
      $('#modal-tinta').modal('show');
    });

    /*input kode tinta, jika stok tersedia form berubah menjadi tambah stok*/
    $('.frm-tinta').keyup(function(){
       var kd_tinta = $(".frm-tinta").val();
       $.ajax({
           url:"view/input_tinta.php",
           method:"POST",
           data:{kd_tinta:kd_tinta},
           success:function(data){
               $('.form-tinta').html(data);
           }
       });
    });

    /*ajax get data for edit*/
    $(document).on('click', '.edit-tinta', function(){
        var kd_tinta = $(this).attr("id");
        $('#kd-tinta').hide();
        $('.frm-tinta').hide();
        $('.title-input').hide();
        $('.title-edit').show();
        $('#modal-tinta').modal('show');
        $.ajax({
            url:"view/edit_tinta.php",
            method:"POST",
            data:{kd_tinta:kd_tinta},
            success:function(data){
                $('.form-tinta').html(data);
            }
        });
    });

    /*ajax delete data*/
    $(document).on('click', '.hapus-tinta', function(){
      var kd_tinta = $(this).attr("id");
      $('.kd_tinta').val(kd_tinta);
      $('#hapus-tinta').modal('show');
        $('.hapus_tinta').click(function(){
          var action = "hapus_stok";
          var kd_tinta = $('.kd_tinta').val();
            $.ajax({
              url:"controller/controller_tinta.php",
              method:"POST",
              data:{kd_tinta:kd_tinta, action:action},
              success:function(data){
                data_tinta();
              }
            });
        });
    });

    /*submit simpan,tambah,edit stok*/
    $('.submit').click(function(){
      if($('.frm-warna').val() == "")
      {
        alert("Harap isi form warna");
        return false;
      }
      else if($('.frm-merek').val() == "")
      {
        alert("Harap isi form merek");
        return false;
      }
      else if($('.frm-stok').val() == "")
      {
        alert("Stok tidak boleh kosong");
        return false;
      }
      else if($('.frm-satuan').val() == "")
      {
        alert("Harap isi form satuan");
        return false;
      }
      else if($('.frm-hrg_beli').val() == "")
      {
        alert("Harga beli tidak boleh kosong");
        return false;
      }
      else if($('.frm-hrg_jual').val() == "")
      {
        alert("Harga jual tidak boleh kosong");
        return false;
      }
      else{
        $.ajax({
            url:"controller/controller_tinta.php",
            method:"POST",
            data:$('.post-tinta').serialize(),
            success:function(data){
              data_tinta();
            }
        });
      }
    });

})
</script>