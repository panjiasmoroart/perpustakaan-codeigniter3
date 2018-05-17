<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_peminjaman','Mod_anggota','Mod_buku'));
    }

    public function index()
    {
        $data['tglpinjam']  = date('Y-m-d');
        $data['tglkembali'] = date('Y-m-d', strtotime('+7 day', strtotime($data['tglpinjam'])));
        $data['autonumber'] = $this->Mod_peminjaman->AutoNumbering();
        $data['anggota']    = $this->Mod_anggota->getAnggota()->result();
        $this->template->load('layoutbackend', 'peminjaman/peminjaman_data', $data);
    }

    public function tampil_tmp()
    {
        $data['tmp']       = $this->Mod_peminjaman->getTmp()->result();
        $data['jumlahTmp'] = $this->Mod_peminjaman->jumlahTmp();
        $this->load->view('peminjaman/peminjaman_tampil_tmp',$data);
    }

    public function cari_anggota()
    {
        $nis = $this->input->post('nis');
        $cari = $this->Mod_anggota->cekAnggota($nis);
        //jika ada data anggota
        if($cari->num_rows() > 0) {
            $danggota = $cari->row_array();
            echo $danggota['nama'];
        }
    }

    public function cari_buku()
    {
        $caribuku = $this->input->post('caribuku');
        $data['buku'] = $this->Mod_buku->BookSearch($caribuku);
        $this->load->view('peminjaman/peminjaman_searchbook', $data);
        // foreach($data['buku'] as $d) {
        //     print_r($d); die();
        // }
    }

    public function cari_kode_buku()
    {
        //$kode_buku = 7611;
        $kode_buku = $this->input->post('kode_buku');
        $hasil = $this->Mod_buku->cekBuku($kode_buku);
        //jika ada buku dalam database
        if($hasil->num_rows() > 0) {
            $dbuku = $hasil->row_array();
            echo $dbuku['judul']."|".$dbuku['pengarang'];
        }
    }

    public function save_tmp()
    {
        // $kode = $this->Mod_peminjaman->getTransaksi()->result_array();
        
        // if($kode->num_rows()==1) {
        //     echo "sudah ada";
        // }
        // else{

            $kode_buku = $this->input->post('kode_buku');
            // echo $kode_buku; die();
            $cek = $this->Mod_peminjaman->cekTmp($kode_buku);
            //cek apakah data masih kosong di tabel tmp
            if($cek->num_rows() < 1) {
                $data = array(
                    'kode_buku' => $this->input->post('kode_buku'),
                    'judul'     => $this->input->post('judul'),
                    'pengarang' => $this->input->post('pengarang')
                );
                $this->Mod_peminjaman->InsertTmp($data);
            }
    
        //}


    }

    public function hapus_tmp()
    {
        $kode_buku = $this->input->post('kode_buku');
        $this->Mod_peminjaman->deleteTmp($kode_buku);
    }

    public function simpan_transaksi()
    {
        $id_petugas = $this->session->userdata['id_petugas'];
        //ambil data tmp lakukan looping . setelah looping lakukan insert ke table transaksi
        $table_tmp = $this->Mod_peminjaman->getTmp()->result();
        foreach($table_tmp as $data){

            $kode_buku = $data->kode_buku; 
            
            $data = array(
                'id_transaksi'     => $this->input->post('no_transaksi'),
                'nis'              => $this->input->post('nis'),
                'kode_buku'        => $data->kode_buku,
                'tanggal_pinjam'   => $this->input->post('tgl_pinjam'),
                'tanggal_kembali'  => $this->input->post('tgl_kembali'),
                'status'           => "N",
                'id_petugas'       => $id_petugas
            );
           // print_r($data);
           
            //insert data ke table transaksi
            $this->Mod_peminjaman->InsertTransaksi($data); 


            //hapus table tmp
            $this->Mod_peminjaman->deleteTmp($kode_buku);
           
        }
    }


}

/* End of file Peminjaman.php */
