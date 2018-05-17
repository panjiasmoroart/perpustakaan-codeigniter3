<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_buku');
    }


    public function index()
    {
        $data['buku']      = $this->Mod_buku->getAll();
        
        
        if($this->uri->segment(3)=="create-success") {
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Disimpan...!</p></div>";    
            $this->template->load('layoutbackend', 'buku/buku_data', $data); 
        }
        else if($this->uri->segment(3)=="update-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Update...!</p></div>"; 
            $this->template->load('layoutbackend', 'buku/buku_data', $data);
        }
        else if($this->uri->segment(3)=="delete-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Dihapus...!</p></div>"; 
            $this->template->load('layoutbackend', 'buku/buku_data', $data);
        }
        else{
            $data['message'] = "";
            $this->template->load('layoutbackend', 'buku/buku_data', $data);
        }
        
    }

    public function create()
    {
        $this->template->load('layoutbackend', 'buku/buku_create');
    }

    public function insert()
    {
        if(isset($_POST['save'])) {

            //function validasi
            $this->_set_rules();

            //apabila user mengkosongkan form input
            if($this->form_validation->run()==true){
                // echo "masuk"; die();
                $kode_buku = $this->input->post('kode_buku');
                $cek = $this->Mod_buku->cekBuku($kode_buku);
                //cek nis yg sudah digunakan
                if($cek->num_rows() > 0){
                    $data['message'] = "<div class='alert alert-block alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <p><strong><i class='icon-ok'></i>Kode Buku</strong> Sudah Digunakan...!</p></div>"; 
                    $this->template->load('layoutbackend', 'buku/buku_create', $data); 
                }
                else{
                    $judul = slug($this->input->post('judul'));
                    $config['upload_path']   = './assets/img/buku/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	     = '1000';
                    $config['max_width']     = '2000';
                    $config['max_height']    = '1024';
                    $config['file_name']     = $judul; 
                            
                    $this->upload->initialize($config);

                     //apabila ada gambar yg diupload
                    if ($this->upload->do_upload('userfile')){
                        
                        $image = $this->upload->data();

                        $save  = array(
                            'kode_buku'   => $this->input->post('kode_buku'),
                            'judul'       => $this->input->post('judul'),
                            'pengarang'   => $this->input->post('pengarang'),
                            'klasifikasi' => $this->input->post('klasifikasi'),
                            'image'       => $image['file_name']
                        );
                        $this->Mod_buku->insertBuku("buku", $save);
                        // echo "berhasil"; die();
                        redirect('buku/index/create-success');

                    }
                    //apabila tidak ada gambar yg diupload
                    else{
                        $data['message'] = "<div class='alert alert-block alert-danger'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <p><strong><i class='icon-ok'></i>Gambar</strong> Masih Kosong...!</p></div>"; 
                        $this->template->load('layoutbackend', 'buku/buku_create', $data);
                    } 
                }
            
            }
            //jika tidak mengkosongkan form
            else{
                $data['message'] = "";
                $this->template->load('layoutbackend', 'buku/buku_create', $data);
            }

        }
    }

    public function edit()
    {
        $kode_buku = $this->uri->segment(3);
        
        $data['edit']    = $this->Mod_buku->cekBuku($kode_buku)->row_array();
        // $data['anggota'] =  $this->Mod_anggota->getAll()->result_array();
        // print_r($data['edit']); die();
        $this->template->load('layoutbackend', 'buku/buku_edit', $data);
    }

    public function update()
    {
        if(isset($_POST['update'])) {

            // echo "proses update"; die();
            //apabila ada gambar yg diupload
            if(!empty($_FILES['userfile']['name'])) {

                $this->_set_rules();

                //apabila user mengkosongkan form input
                if($this->form_validation->run()==true){
                    // echo "masuk"; die();
                    
                    $kode_buku = $this->input->post('kode_buku');
                    
                    $judul = slug($this->input->post('judul'));
                    $config['upload_path']   = './assets/img/buku/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	     = '1000';
                    $config['max_width']     = '2000';
                    $config['max_height']    = '1024';
                    $config['file_name']     = $judul; 
                            
                    $this->upload->initialize($config);

                        //apabila ada gambar yg diupload
                    if ($this->upload->do_upload('userfile')){
                        
                        $image = $this->upload->data();

                        $save  = array(
                            'kode_buku'   => $this->input->post('kode_buku'),
                            'judul'       => $this->input->post('judul'),
                            'pengarang'   => $this->input->post('pengarang'),
                            'klasifikasi' => $this->input->post('klasifikasi'),
                            'image'       => $image['file_name']
                        );

                        $g = $this->Mod_buku->getGambar($kode_buku)->row_array();
                        
                        //hapus gambar yg ada diserver
                        unlink('assets/img/buku/'.$g['image']);

                        $this->Mod_buku->updateBuku($kode_buku, $save);
                        // echo "berhasil"; die();
                        redirect('buku/index/update-success');

                    }
                    //apabila tidak ada gambar yg diupload
                    else{
                        $data['message'] = "<div class='alert alert-block alert-danger'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <p><strong><i class='icon-ok'></i>Gambar</strong> Masih Kosong...!</p></div>"; 
                        $this->template->load('layoutbackend', 'buku/buku_edit', $data);
                    } 
                        
                    
                }
                //jika tidak mengkosongkan
                else{

                    $kode_buku = $this->input->post('kode_buku');
                    $data['edit']    = $this->Mod_buku->cekBuku($kode_buku)->row_array();
                    $data['message'] = "";
                    $this->template->load('layoutbackend', 'buku/buku_edit', $data);
                }
            
            }
            //jika tidak ada gambar yg diupload
            else{
                $this->_set_rules();
                
                //apabila user mengkosongkan form input
                if($this->form_validation->run()==true){
                    // echo "masuk"; die();
                    
                    $kode_buku = $this->input->post('kode_buku');
                    
                    $save  = array(
                        'kode_buku'   => $this->input->post('kode_buku'),
                        'judul'       => $this->input->post('judul'),
                        'pengarang'   => $this->input->post('pengarang'),
                        'klasifikasi' => $this->input->post('klasifikasi')
                    );
                    $this->Mod_buku->updateBuku($kode_buku, $save);
                    // echo "berhasil"; die();
                    redirect('buku/index/update-success');      
                }
                //jika tidak mengkosongkan
                else{
                    $kode_buku = $this->input->post('kode_buku');
                    $data['edit']    = $this->Mod_buku->cekBuku($kode_buku)->row_array();
                    $data['message'] = "";
                    $this->template->load('layoutbackend', 'buku/buku_edit', $data);
                }

            } //end empty $_FILES

        } // end $_POST['update']
    
    }

    public function delete()
    {
        // $nis  = $this->uri->segment(3);

        $kode_buku = $this->input->post('kode_buku');
          
        $g = $this->Mod_buku->getGambar($kode_buku)->row_array();
        
        //hapus gambar yg ada diserver
        unlink('assets/img/buku/'.$g['image']);

        $this->Mod_buku->deleteBuku($kode_buku, 'buku');
        // echo "berhasil"; die();
        redirect('buku/index/delete-success');
    }

    //function global buat validasi input
    public function _set_rules()
    {
        $this->form_validation->set_rules('kode_buku','Kode Buku','required|max_length[5]');
        $this->form_validation->set_rules('judul','Judul Buku','required|max_length[100]');
        $this->form_validation->set_rules('pengarang','Pengarang','required|max_length[50]');
        $this->form_validation->set_rules('klasifikasi','Klasifikasi','required|max_length[200]'); 
        $this->form_validation->set_message('required', '{field} kosong, silahkan diisi');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>","</div>");
    }

}

/* End of file Buku.php */
