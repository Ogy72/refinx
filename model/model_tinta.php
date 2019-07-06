<?php

include "database.php";

class model_tinta{
    
    public $kd_tinta;
    public $warna;
    public $merek;
    public $jenis;
    public $stok;
    public $satuan;
    public $hrg_beli;
    public $hrg_jual;
    public $date;
    public $stok_msuk;
    public $new_stok;
    public $stok_ini;
    public $stok_edit;
    public $kd_tinta2;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function read_tinta(){
        $query = "SELECT * FROM stok_tinta";
        return mysql_query($query);
    }

    public function select_tinta(){
        $query = "SELECT * FROM stok_tinta WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function input_tinta(){
        $this->hitung_stok();
        $query = "INSERT INTO stok_tinta VALUES('$this->kd_tinta','$this->warna','$this->merek','$this->jenis','$this->stok','$this->satuan','$this->hrg_beli','$this->hrg_jual','$this->date')";
        return mysql_query($query);
    }

    public function tambah_stok(){
        $this->hitung_stok();
        $this->new_stok =  $this->stok+$this->stok_ini;
        $query = "UPDATE stok_tinta SET warna='$this->warna',merek='$this->merek',jenis='$this->jenis',stok='$this->new_stok',hrg_beli='$this->hrg_beli',hrg_jual='$this->hrg_jual',date='$this->date' WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function edit_tinta(){
        $query = "UPDATE stok_tinta SET kd_tinta='$this->kd_tinta2',warna='$this->warna',merek='$this->merek',jenis='$this->jenis',stok='$this->stok_edit',satuan='$this->satuan',hrg_beli='$this->hrg_beli',hrg_jual='$this->hrg_jual',date='$this->date' WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function hapus_tinta(){
        $query = "DELETE FROM stok_tinta WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function hitung_stok(){
        $this->stok = $this->stok_msuk*1000;       
    }

    public function konversi($data){
        $hasil_konversi = $data/1000;
        return $hasil_konversi;
    }

    public function __destruct(){

    }

}
?>