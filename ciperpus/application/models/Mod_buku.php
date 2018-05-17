<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_buku extends CI_Model {

    private $table   = "buku";
    private $primary = "kode_buku";

    function searchBuku($cari, $limit, $offset)
    {
        $this->db->like($this->primary,$cari);
        $this->db->or_like("judul",$cari);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table);
    }

    function totalRows($table)
	{
		return $this->db->count_all_results($table);
    }

    
    function getAll()
    {
        $this->db->order_by('buku.kode_buku desc');
        return $this->db->get('buku');
    }

    function insertBuku($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function cekBuku($kode)
    {
        $this->db->where("kode_buku", $kode);
        return $this->db->get("buku");
    }

    function updateBuku($kode_buku, $data)
    {
        $this->db->where('kode_buku', $kode_buku);
		$this->db->update('buku', $data);
    }

    function getGambar($kode_buku)
    {
        $this->db->select('image');
        $this->db->from('buku');
        $this->db->where('kode_buku', $kode_buku);
        return $this->db->get();
    }

    function deleteBuku($kode, $table)
    {
        $this->db->where('kode_buku', $kode);
        $this->db->delete($table);
    }

    function BookSearch($judul)
    {
        $this->db->like($this->primary,$judul);
        $this->db->or_like("judul",$judul);
        $this->db->limit(10);
        return $this->db->get($this->table);
    }



}

/* End of file ModelName.php */
