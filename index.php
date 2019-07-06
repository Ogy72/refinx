<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>

    <!--css-->
    <link rel="stylesheet" href="css/halaman-utama.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <!--JS-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <div id="panel-login">
        <img src="img/R.png" alt="" class="box-img">
        <h1> Selamat Datang </h1>
    <?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<h4> Username dan Password tidak sesuai !</h4>";
        }
    }
    else
    {
        echo "<h4> Silahkan Login </h4>";
    }
	?>
    
    <form action="controller/controller_login.php" method="POST">
        <input type="text" name="username" class="form-login" placeholder="Username">
        <input type="password" name="password" class="form-login" placeholder="Password">

        <input type="submit" value="Login" class="btn btn-login">
    </form>

    </div>
</body>
</html>

