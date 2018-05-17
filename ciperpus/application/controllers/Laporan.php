<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_laporan','Mod_buku','Mod_anggota'));
    }

    
    public function anggota()
    {
        $data['anggota']      = $this->Mod_anggota->getAll();
        $this->template->load('layoutbackend', 'laporan/anggota_data', $data);
    }

    public function buku()
    {
        $data['buku']      = $this->Mod_buku->getAll();
        $this->template->load('layoutbackend', 'laporan/buku_data', $data);
    }

    public function peminjaman()
    {
        $data['title']="Laporan Peminjaman";
        $this->template->load('layoutbackend', 'laporan/peminjaman_data', $data);
    }

    public function cari_pinjaman()
    {
        // $tanggal1 = '2018-04-11';
        // $tanggal2 = '2018-04-17';
        $tanggal1 = $this->input->post('tanggal1');
        $tanggal2 = $this->input->post('tanggal2');
        $data['hasil_search'] = $this->Mod_laporan->searchPinjaman($tanggal1,$tanggal2);
        $this->load->view('laporan/peminjaman_search', $data);
    }

    public function detail_pinjam()
    {
        //$id_transaksi = $this->uri->segment(3);
        $id_transaksi = $this->input->post('id_transaksi');
        
        $data['title']        = "Detail Peminjaman";
        $data['pinjam']       = $this->Mod_laporan->detailPinjaman($id_transaksi)->row_array(); 
        $data['detailpinjam'] = $this->Mod_laporan->detailPinjaman($id_transaksi)->result();
        $this->load->view('laporan/peminjaman_detail', $data);

        // $id_transaksi = $this->uri->segment(3);
        // $data['title']        = "Detail Peminjaman";
        // $data['pinjam']       = $this->Mod_laporan->detailPinjaman($id_transaksi)->row_array(); 
        // $data['detailpinjam'] = $this->Mod_laporan->detailPinjaman($id_transaksi)->result();
        // $this->template->load('layoutbackend', 'laporan/peminjaman_detail', $data);
    }

    public function pengembalian()
    {
        $data['title']="Laporan Pengembalian";
        $this->template->load('layoutbackend', 'laporan/pengembalian_data', $data);
    }

    public function cari_pengembalian()
    {
        // $tanggal1 = '2018-04-19';
        // $tanggal2 = '2018-04-21';
        $tanggal1 = $this->input->post('tanggal1');
        $tanggal2 = $this->input->post('tanggal2');
        $data['hasil_search'] = $this->Mod_laporan->searchPengembalian($tanggal1,$tanggal2);
        $this->load->view('laporan/pengembalian_search', $data);
        
    }

    public function detail_pengembalian()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        $data['title']               = "Detail Pengembalian";
        $data['pengembalian']        = $this->Mod_laporan->detailPengembalian($id_transaksi)->row_array(); 
        $data['detailjpengembalian'] = $this->Mod_laporan->detailPengembalian($id_transaksi)->result();
        $this->load->view('laporan/pengembalian_detail', $data);

        // $id_transaksi = $this->uri->segment(3);
        // $data['title']               = "Detail Pengembalian";
        // $data['pengembalian']        = $this->Mod_laporan->detailPengembalian($id_transaksi)->row_array(); 
        // $data['detailjpengembalian'] = $this->Mod_laporan->detailPengembalian($id_transaksi)->result();
        // $this->template->load('layoutbackend', 'laporan/pengembalian_detail', $data);
        // echo "<pre>";
        // print_r($data['detailjpengembalian']);
        // echo "</pre>";
    }

   

}

/* End of file Laporan.php */
