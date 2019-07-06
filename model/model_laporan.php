<?
include "database.php";

class model_laporan{

    public $tgl_start;
    public $tgl_end;
    public $kd_tinta;
    public $no_cartridge;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function laporan_stok(){
        $query = "SELECT * FROM stok_tinta WHERE date BETWEEN '$this->tgl_start' AND '$this->tgl_end'";
        return mysql_query($query);
    }

    public function stok_terpakai(){
        $query = "SELECT SUM(isi) AS stok_terpakai FROM penggunaan_tinta WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function laporan_cartridge(){
        $query = "SELECT cartridge.*, refill.*, pelanggan.*, COUNT(refill.no_cartridge) AS cartin FROM cartridge, refill, pelanggan WHERE cartridge.no_cartridge=refill.no_cartridge AND cartridge.no_telp=pelanggan.no_telp AND refill.date BETWEEN '$this->tgl_start' AND '$this->tgl_end' GROUP BY refill.no_cartridge";
        return mysql_query($query);
    }

    public function count_tcart(){
        $query = "SELECT COUNT(no_cartridge) AS total FROM refill WHERE date BETWEEN '$this->tgl_start' AND '$this->tgl_end'";
        return mysql_query($query);
    }

    public function count_income(){
        $query = " SELECT pelanggan.*, cartridge.*, refill.*, penggunaan_tinta.*, stok_tinta.satuan, SUM(penggunaan_tinta.isi) AS total_isi, SUM(penggunaan_tinta.biaya) AS total_biaya
        FROM pelanggan, cartridge, refill, penggunaan_tinta, stok_tinta WHERE pelanggan.no_telp=cartridge.no_telp AND cartridge.no_cartridge=refill.no_cartridge AND refill.idrefill=penggunaan_tinta.idrefill
        AND penggunaan_tinta.kd_tinta=stok_tinta.kd_tinta AND refill.status='dibayar' AND refill.date BETWEEN '$this->tgl_start' AND '$this->tgl_end' GROUP BY refill.idrefill";
        return mysql_query($query);
    }

    public function total_income(){
        $query = "SELECT SUM(penggunaan_tinta.isi) AS total_isi, SUM(penggunaan_tinta.biaya) AS total_biaya FROM refill, penggunaan_tinta WHERE refill.idrefill=penggunaan_tinta.idrefill 
        AND refill.status='dibayar' AND refill.date BETWEEN '$this->tgl_start' AND '$this->tgl_end'";
        return mysql_query($query);
    }

    public function cartridge_dibayar(){
        $query = "SELECT COUNT(no_cartridge) AS total_cartridge FROM refill WHERE status='dibayar' AND date BETWEEN '$this->tgl_start' AND '$this->tgl_end'";
        return mysql_query($query);
    }
}
?>