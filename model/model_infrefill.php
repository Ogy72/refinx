<?
include "database.php";

class model_infrefill{
    public $month;
    public $merek;
    public $warna;
    public $jumlah_isi;
    public $tipe;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function count($data){
        return mysql_num_rows($data);
    }

    public function color(){
        $query = "SELECT refill.date, penggunaan_tinta.*, SUM(penggunaan_tinta.isi) AS total_isi, stok_tinta.warna, stok_tinta.merek FROM refill, penggunaan_tinta, stok_tinta WHERE refill.idrefill=penggunaan_tinta.idrefill AND penggunaan_tinta.kd_tinta=stok_tinta.kd_tinta AND stok_tinta.merek='$this->merek' AND stok_tinta.warna='$this->warna' AND MONTH(refill.date) = '$this->month'";
        return mysql_query($query);
    }

    public function get_cartridge(){
        $query = "SELECT cartridge.tipe, refill.*, COUNT(cartridge.tipe) AS jumlah FROM cartridge, refill WHERE cartridge.no_cartridge=refill.no_cartridge AND MONTH(refill.date) = '$this->month' GROUP BY cartridge.tipe";
        return mysql_query($query);
    }

    public function count_refill(){
        $query = "SELECT user.nama, refill.user_id, refill.date, COUNT(refill.user_id) AS jumlah_refill FROM user, refill WHERE user.id=refill.user_id AND MONTH(refill.date) = '$this->month' GROUP BY user.nama";
        return mysql_query($query);
    }
}
?>
