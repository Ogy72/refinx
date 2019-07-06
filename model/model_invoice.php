<?
include "database.php";

class model_invoice{
    public $nama_pemilik;
    public $no_telp;
    public $no_cartridge;
    public $tipe;
    public $warna;
    public $isi;
    public $biaya;
    public $idrefill;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function read_invoice(){
        $query = "SELECT cartridge.*, pelanggan.*, refill.* FROM cartridge, pelanggan, refill WHERE cartridge.no_telp=pelanggan.no_telp AND cartridge.no_cartridge=refill.no_cartridge AND refill.date='$this->date' AND pelanggan.no_telp='$this->no_telp' AND refill.status=''";
        return mysql_query($query);
    }

    public function update_status(){
        $query = "UPDATE refill SET status='dibayar' WHERE idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function jumlah_isi(){
        $query = "SELECT SUM(isi) AS jumlah_isi, SUM(biaya) AS total_biaya FROM penggunaan_tinta WHERE idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function satuan(){
        $query = "SELECT stok_tinta.*, penggunaan_tinta.* FROM stok_tinta, penggunaan_tinta WHERE stok_tinta.kd_tinta=penggunaan_tinta.kd_tinta AND idrefill='$this->idrefill'";
        return mysql_query($query);
    }
}
?>