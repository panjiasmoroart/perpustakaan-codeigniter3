<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_pengembalian extends CI_Model {

    private $table_transaksi    = 'transaksi';
    private $table_pengembalian = 'pengembalian';
    private $table_anggota      = 'anggota';  
    private $table_buku         = 'buku';    

    public function SearchNis($nis)
    {
        $data = $this->db->query("SELECT * FROM $this->table_transaksi WHERE id_transaksi 
                                  NOT IN(SELECT id_transaksi FROM $this->table_pengembalian)
                                  AND nis LIKE '%$nis%' GROUP BY nis");
        return $data;
    }

    public function SearchTransaksi($no_transaksi)
    {
        $query = $this->db->query("SELECT a.*, b.nama FROM $this->table_transaksi a, $this->table_anggota                             b WHERE a.id_transaksi = '$no_transaksi' AND a.id_transaksi 
                                   NOT IN(SELECT c.id_transaksi FROM $this->table_pengembalian c)
                                   AND a.nis = b.nis");
        return $query;
    }

    public function showBook($no_transaksi)
    {
        $query = $this->db->query("SELECT a.*, b.judul,b.pengarang 
                                   FROM $this->table_transaksi a, $this->table_buku b 
                                   WHERE a.id_transaksi = '$no_transaksi' AND a.id_transaksi 
                                   NOT IN(SELECT c.id_transaksi FROM $this->table_pengembalian c)
                                   AND a.kode_buku = b.kode_buku");
        return $query;
    }

    public function insertPengembalian($data)
    {
        $this->db->insert($this->table_pengembalian, $data);
    }

    public function UpdateStatus($no_transaksi, $data)
    {
        $this->db->where("id_transaksi", $no_transaksi);
        $this->db->update($this->table_transaksi, $data);
        
    }


}

/* End of file Mod_pengembalian.php */
