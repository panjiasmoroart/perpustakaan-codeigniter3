<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_anggota extends CI_Model {

    function getAnggota()
    {
        return $this->db->get('anggota');
    }

    function getAll()
    {
        $this->db->order_by('anggota.nis desc');
        return $this->db->get('anggota');
    }

    function insertAnggota($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function cekAnggota($kode)
    {
        $this->db->where("nis", $kode);
        return $this->db->get("anggota");
    }

    function updateAnggota($nis, $data)
    {
        $this->db->where('nis', $nis);
		$this->db->update('anggota', $data);
    }

    function getDataAnggota($limit, $offset)
    {
        // return $this->db->get_where('post', array('category_id' => $category_id));
        $this->db->select('*');
        $this->db->from('anggota a');
        // $this->db->where('a.nis', $nis);
        $this->db->limit($limit, $offset);
        $this->db->order_by('a.nis desc');
        return $this->db->get();
    }

    function getGambar($nis)
    {
        $this->db->select('image');
        $this->db->from('anggota');
        $this->db->where('nis', $nis);
        return $this->db->get();
    }

    function totalRows($table)
	{
		return $this->db->count_all_results($table);
    }

    // function getTotalRows()
    // {
    //     return $this->db->get('anggota')->num_rows();
    // }

    
    function searchAnggota($cari, $limit, $offset)
    {
        $this->db->like("nis",$cari);
        $this->db->or_like("nama",$cari);
        $this->db->limit($limit, $offset);
        return $this->db->get('anggota');
    }

    function deleteAnggota($kode, $table)
    {
        $this->db->where('nis', $kode);
        $this->db->delete($table);
    }

}

/* End of file ModelName.php */
