<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Refinx</title>

    <!--css-->
    <link rel="stylesheet" href="css/halaman-utama.css">
    <link rel="stylesheet" href="css/view.css">
    <link rel="stylesheet" href="css/print.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css">

    <!--JS-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/jquery.PrintArea.js"></script>
</head>

<!-- cek apakah sudah login -->
<?php 
	session_start();
	if($_SESSION['level'] !=="Admin"){
		header("location:index.php");
	}
?>

<body>
    <div id="panel">

        <div id="header">
            <?include "header-a.php";?>
        </div>

        <div id="content">
            <div id="isi-content"></div>
        </div>

        <div id="footer">
            <p class="footname">&copy; 2019 Created By : <a href="#" target="_blank"> <strong>Ogy Tirta <i class="fa fa-code"></i></strong></a>
            <strong class="footregion"> <i class="fa fa-map-marker-alt"></i> Indonesia</strong></p>
        </div>

    </div><!--Div Close Halaman-->
</body>
</html>

<script>
$(document).ready(function(){

    $('#isi-content').load('i_cartridge.php');

    $('#cartridge').click(function(){
        $('#isi-content').load('i_cartridge.php');
    });

    $('#tinta').click(function(){
        $('#isi-content').load('i_tinta.php');
    });

    $('#laporan').click(function(){
        $('#isi-content').load('i_laporan.php');
    });

    $('#user').click(function(){
        $('#isi-content').load('i_user.php');
    });

})
</script>

