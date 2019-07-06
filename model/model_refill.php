<?
include "database.php";

class model_refill{
    public $date;
    public $isi;
    public $new_isi;
    public $jumlah_isi;
    public $hasil_test;
    public $biaya;
    public $hrg_jual;
    public $ket;
    public $idrefill;
    public $userid;
    public $kd_tinta;
    public $stok_tinta;
    public $restock;
    public $new_stok;
    public $merek;
    public $jenis;
    public $warna;
    public $no_cartridge;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function read_refill(){
        $query = "SELECT refill.*, cartridge.* FROM refill, cartridge WHERE cartridge.no_cartridge=refill.no_cartridge AND refill.date='$this->date' ORDER BY refill.user_id ASC";
        return mysql_query($query);
    }

    public function select_refill(){
        $query = "SELECT refill.*, cartridge.*, pelanggan.* FROM refill, cartridge, pelanggan WHERE refill.no_cartridge=cartridge.no_cartridge AND cartridge.no_telp=pelanggan.no_telp AND refill.idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function select_riwayat(){
        $query = "SELECT refill.*, cartridge.* FROM refill, cartridge WHERE refill.no_cartridge=cartridge.no_cartridge AND refill.no_cartridge='$this->no_cartridge' AND user_id!='' ORDER BY refill.date DESC";
        return mysql_query($query);
    }

    public function select_tinta(){
        $query = "SELECT * FROM stok_tinta WHERE merek='$this->merek' AND jenis='$this->jenis' AND warna='$this->warna'";
        return mysql_query($query);
    }

    public function select_user(){
        $query = "SELECT * FROM user WHERE level='Teknisi'";
        return mysql_query($query);
    }

    public function select_teknisi(){
        $query = "SELECT refill.user_id, user.* FROM refill, user WHERE refill.user_id=user.id AND idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function select_edit(){
        $query = "SELECT pelanggan.*, cartridge.*, refill.*, penggunaan_tinta.*, stok_tinta.* FROM pelanggan, cartridge, refill, penggunaan_tinta, stok_tinta WHERE pelanggan.no_telp=cartridge.no_telp AND cartridge.no_cartridge=refill.no_cartridge AND refill.idrefill=penggunaan_tinta.idrefill AND penggunaan_tinta.kd_tinta=stok_tinta.kd_tinta AND refill.idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function jumlah_isi(){
        $query = "SELECT SUM(isi) AS jumlah_isi FROM penggunaan_tinta WHERE idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function satuan(){
        $query = "SELECT penggunaan_tinta.*, stok_tinta.* FROM penggunaan_tinta, stok_tinta WHERE penggunaan_tinta.kd_tinta=stok_tinta.kd_tinta AND idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function input_refill(){
        $query = "UPDATE refill SET hasil_test='$this->hasil_test',ket='$this->ket',user_id='$this->userid' WHERE idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function hitung_biaya(){
        $this->biaya = $this->hrg_jual * $this->isi;
    }

    public function hitung_stok(){
        $this->new_stok = $this->stok_tinta - $this->isi;
    }

    public function penggunaan_tinta(){
        $this->hitung_biaya();
        $query = "INSERT INTO penggunaan_tinta VALUES('$this->idrefill','$this->kd_tinta','$this->isi','$this->biaya')";
        return mysql_query($query);
    }

    public function update_stok(){
        $this->hitung_stok();
        $query ="UPDATE stok_tinta SET stok='$this->new_stok' WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function update_refill(){
        $query = "UPDATE refill SET hasil_test='$this->hasil_test', ket='$this->ket', user_id='$this->userid' WHERE idrefill='$this->idrefill'";
        return mysql_query($query);
    }

    public function update_penggunaan(){
        $this->biaya = $this->new_isi * $this->hrg_jual;
        $query = "UPDATE penggunaan_tinta SET isi='$this->new_isi', biaya='$this->biaya' WHERE idrefill='$this->idrefill' AND kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function restock_tinta(){
        $this->restock = ($this->isi+$this->stok_tinta)-$this->new_isi;
        $query = "UPDATE stok_tinta SET stok='$this->restock' WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

}
?>