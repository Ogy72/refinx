<!DOCTYPE html>
<html lang="en">

<div class="label-menu"> Data User</div>

<button type="button" class="btn btn-sm add-user" id="btn-input">Tambah User</button>
<hr>

<body>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th width="14%">No</th>
            <th width="21%">Nama</th>
            <th width="19%">Username</th>
            <th width="17%">Password</th>
            <th width="15%">Level</th>
            <th>Options</th>
        </tr>
    </thead>
</table>
<div class="table-scroll">
    <table class="table table-striped">
        <tbody id="table-user"></tbody>
    </table>    
</div>
</body>
</html>

<!--Modal Input-->
<div class="modal fade modal-user" id="modal-user" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"><!--div header-->
        <h5 class="modal-title tambah">Tambah User</h5><h5 class="modal-title edit">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!--close div header-->
      <div class="modal-body"><!--modal body-->
	    <form class="input-user" method="post">
            <div id="form-user"></div>			
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Simpan" class="user btn btn-simpan" data-dismiss="modal">    
      </form>
      </div>
    </div>
  </div>
</div>

<!--modal hapus-->
<div class="modal fade modal-hapus" id="hapus-user" tabindex="-1" role="dialog">
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
          <input type="Hidden" name="iduser" class="iduser">
      </div><!--close modal body-->
      <div class="modal-footer">
        <input type="submit" name="submit" value="Hapus" class="hapus_user btn btn-sm btn-danger" data-dismiss="modal">    
        <input type="submit" value="Batal" class="btn btn-sm btn-primary" data-dismiss="modal">
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    
    data_user();

    function data_user()
    {
        $.ajax({
            url:"view/view_user.php",
            method:"POST",
            success:function(data)
            {
                $('#table-user').html(data);
            }
        })
    }

    /*menampilkan modal input*/
    $('.add-user').click(function(){
        $('.edit').hide();
        $('.tambah').show();
        $.ajax({
            url:"view/input_user.php",
            method:"POST",
            success:function(data){
               $('#form-user').html(data) ;
               $('#modal-user').modal('show');
            }
        });
    });

    /*ajax get data for edit*/
    $(document).on('click', '.edit-user', function(){
        $('.tambah').hide();
        $('.edit').show();
        var id = $(this).attr("id");
        $('#modal-user').modal('show');
        $.ajax({
            url:"view/edit_user.php",
            method:"POST",
            data:{id:id},
            success:function(data){
                $('#form-user').html(data);
            }
        });
    });

    /*ajax delete data*/
    $(document).on('click', '.hapus-user', function(){
      var id = $(this).attr("id");
      $('.iduser').val(id);
      $('#hapus-user').modal('show');
        $('.hapus_user').click(function(){
        var action = "hapus_user";
        var id = $('.iduser').val();
        $.ajax({
            url:"controller/controller_user.php",
            method:"POST",
            data:{id:id, action:action},
            success:function(data){
                data_user();
            }
        });
      });
    });

    $('.user').click(function(){
        if($('.form-nama').val() == "")
        {
            alert("Harap isi nama");
            return false;
        }
        else if($('.form-username').val() == "")
        {
            alert("Harap isi username");
            return false;
        }
        else if($('.form-password').val() == "")
        {
            alert("Harap masukkan password");
            return false;
        }
        else if($('.form-level').val() == "")
        {
            alert("Harap masukkan level");
            return false;
        }
        else{
            $.ajax({
                url:"controller/controller_user.php",
                method:"POST",
                data:$('.input-user').serialize(),
                success:function(data){
                    data_user();
                }
            });
        }
    });
})
</script>