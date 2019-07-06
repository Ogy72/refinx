<html lang="en">
<? session_start(); ?>
<body>

<div class="row">
<img class="bg-pict" src="img/Wall21.jpg">
<div class="panel-app">
    <h1 class="txt-app">Aplikasi Refinx</h1>
    <h5 class="txt-deskripsi">Stok tinta, Data cartridge dan Refill</h5>

    
    <h3 class="txt-welcome">Selamat Datang</h3>
    <div class="panel-user">
        <div class="col-6 logo-user">
            <i class="fa fa-user-check icon-user"></i>
        </div>
        <div class="col-6 info-user">
            <p class="txt-info">Username : <? echo $_SESSION['username'] ?> </p>
            <p class="txt-info">Nama : <? echo $_SESSION['nama'] ?> </p>
            <p class="txt-info">Level : <? echo $_SESSION['level'] ?> </p>
        </div>
    </div>
</div>
<div class="panel-info">
    <div class="col-6 info-alamat">
        <h3 class="txt-R">Refillo</h3>
        <p class="one-step">One Step to Original</p>
        <p class="txt-info">Jalan Ir Haji Juanda 8 Ruko Lama No.6</p>
        <p class="txt-info">Samarinda Kalimantan - Timur, Indoensia</p>
        <p class="txt-info">Telepon: 0541-77889900. Kode pos : 75124</p>
    </div>
    <div class="col-6 info-kontak">
        <p>The 1st Indonesian Inkjet and Refill Company</p>
        <p>Refillo. One Step to Original</p>
        <p class="txt-web"> <i class="fa fa-globe-asia web"></i> <a href="#">Refillo-Indonesia.com</a></p>
        <p class="txt-facebook"> <i class="fab fa-facebook facebook"></i> <a href="#">Refillo-Indonesia</a></p>
        <p class="txt-gmail"><i class="fab fa-google gmail"></i> <a href="#">Refillo.indonesia@gmail.com</a></p>
    </div>
</div>
</div>    
</body>
</html>