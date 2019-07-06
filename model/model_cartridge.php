<?
include "database.php";

class model_cartridge{
    public $nama;
    public $no_telp;
    public $no_cartridge;
    public $no_cartridge2;
    public $tipe;
    public $merek;
    public $jenis;
    public $warna;
    public $keterangan;
    public $date;
    public $id;
    public $idrefill;
    public $date_now;
    public $kd_tinta;
    public $isi;
    public $stok_tinta;
    public $new_stok;

    public function __construct(){
        $db = new database();
    }

    public function fetch($data){
        return mysql_fetch_array($data);
    }

    public function read_cartridge(){
        $query = "SELECT cartridge.*,pelanggan.*, refill.* FROM cartridge, pelanggan, refill WHERE cartridge.no_telp=pelanggan.no_telp AND cartridge.no_cartridge=refill.no_cartridge AND refill.date='$this->date_now' ORDER BY refill.user_id ASC";
        return mysql_query($query);
    }

    public function input_pelanggan(){
        $query = "INSERT INTO pelanggan VALUES('','$this->nama','$this->no_telp')";
        return mysql_query($query);
    }

    public function input_cartridge(){
        $query = "INSERT INTO cartridge VALUES('$this->no_cartridge','$this->tipe','$this->merek','$this->jenis','$this->warna','$this->no_telp')";
        return mysql_query($query);
    }

    public function input_refill(){
        $query = "INSERT INTO refill VALUES('','$this->date','','','$this->no_cartridge','','')";
        return mysql_query($query);
    }

    public function select_cartridge(){
        $query = "SELECT cartridge.*, pelanggan.nama, pelanggan.id, refill.date FROM cartridge, pelanggan, refill WHERE cartridge.no_telp=pelanggan.no_telp AND cartridge.no_cartridge=refill.no_cartridge AND cartridge.no_cartridge='$this->no_cartridge'";
        return mysql_query($query);
    }

    public function select_refill(){
        $query = "SELECT penggunaan_tinta.*, stok_tinta.* FROM penggunaan_tinta, stok_tinta WHERE penggunaan_tinta.kd_tinta=stok_tinta.kd_tinta AND penggunaan_tinta.idrefill='$this->idrefill'";
        return mysql_query($query);
    }
    public function select_pelanggan(){
        $query = "SELECT * FROM pelanggan WHERE no_telp='$this->no_telp'";
        return mysql_query($query);
    }

    public function select_status(){
        $query = "SELECT * FROM refill WHERE idrefill='$this->idrefill'";
        return mysql_query($query);
    }
    
    public function edit_pelanggan(){
        $query = "UPDATE pelanggan SET nama='$this->nama',no_telp='$this->no_telp' WHERE id='$this->id'";
        return mysql_query($query);
    }
    public function edit_cartridge(){
        $query = "UPDATE cartridge SET no_cartridge='$this->no_cartridge2',tipe='$this->tipe',merek='$this->merek',jenis='$this->jenis',warna='$this->warna' WHERE no_cartridge='$this->no_cartridge'";
        return mysql_query($query);
    }

    public function restock(){
        $this->new_stok = $this->stok_tinta + $this->isi;
        $query = "UPDATE stok_tinta SET stok='$this->new_stok' WHERE kd_tinta='$this->kd_tinta'";
        return mysql_query($query);
    }

    public function hapus_cartridge(){
        $query = "DELETE FROM refill WHERE idrefill='$this->idrefill'";
        return mysql_query($query);
    }

}
?>