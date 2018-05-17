<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_peminjaman extends CI_Model 
{

    private $table = "transaksi";
    private $tmp   = "tmp";
    
    function AutoNumbering()
    {
        $today = date('Ymd');

        $data = $this->db->query("SELECT MAX(id_transaksi) AS last FROM $this->table ")->row_array();

        $lastNoFaktur = $data['last'];
        
        $lastNoUrut   = substr($lastNoFaktur,8,3);
        
        $nextNoUrut   = $lastNoUrut+1;
        
        $nextNoTransaksi = $today.sprintf('%03s',$nextNoUrut);
        
        return $nextNoTransaksi;
    }

    function getTmp()
    {
        return $this->db->get("tmp");
    }
    
    function cekTmp($kode)
    {
        $this->db->where("kode_buku",$kode);
        return $this->db->get("tmp");
    }

    function InsertTmp($data)
    {
        //$this->db->insert("transaksi",$info);
        $this->db->insert($this->tmp, $data);    
    }

    function InsertTransaksi($data)
    {
        $this->db->insert($this->table, $data);
    }

    function jumlahTmp()
    {
        return $this->db->count_all("tmp");
    }

    function deleteTmp($kode_buku)
    {
        $this->db->where("kode_buku",$kode_buku);
        $this->db->delete($this->tmp);
    }

    function getTransaksi()
    {
        return $this->db->get($this->table);
    }

}

/* End of file Mod_peminjaman.php */
