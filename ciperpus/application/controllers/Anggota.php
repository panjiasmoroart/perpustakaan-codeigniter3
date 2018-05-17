<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_anggota');
    }


    public function index()
    {
        $data['anggota']      = $this->Mod_anggota->getAll();
        // print_r($data['countanggota']); die();

        if($this->uri->segment(3)=="create-success") {
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Disimpan...!</p></div>";    
            $this->template->load('layoutbackend', 'anggota/anggota_data', $data); 
        }
        else if($this->uri->segment(3)=="update-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Update...!</p></div>"; 
            $this->template->load('layoutbackend', 'anggota/anggota_data', $data);
        }
        else if($this->uri->segment(3)=="delete-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Dihapus...!</p></div>"; 
            $this->template->load('layoutbackend', 'anggota/anggota_data', $data);
        }
        else{
            $data['message'] = "";
            $this->template->load('layoutbackend', 'anggota/anggota_data', $data);
        }
        
    }

    public function create()
    {
        $this->template->load('layoutbackend', 'anggota/anggota_create');
    }

    public function insert()
    {
        if(isset($_POST['save'])) {
            
            $this->_set_rules();

            //apabila user mengkosongkan form input
            if($this->form_validation->run()==true){
                // echo "masuk"; die();
                $nis = $this->input->post('nis');
                $cek = $this->Mod_anggota->cekAnggota($nis);
                //cek nis yg sudah digunakan
                if($cek->num_rows() > 0){
                    $data['message'] = "<div class='alert alert-block alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <p><strong><i class='icon-ok'></i>NIS</strong> Sudah Digunakan...!</p></div>"; 
                    $this->template->load('layoutbackend', 'anggota/anggota_create', $data); 
                }
                else{
                    $nama = slug($this->input->post('nama'));
                    $config['upload_path']   = './assets/img/anggota/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
                    $config['max_size']	     = '1000';
                    $config['max_width']     = '2000';
                    $config['max_height']    = '1024';
                    $config['file_name']     = $nama; 
                            
                    $this->upload->initialize($config);

                     //apabila ada gambar yg diupload
                    if ($this->upload->do_upload('userfile')){
                        
                        $image = $this->upload->data();

                        $save  = array(
                            'nis'   => $this->input->post('nis'),
                            'nama'  => $this->input->post('nama'),
                            'jk'    => $this->input->post('jenis'),
                            'ttl'   => $this->input->post('tgl_lahir'),
                            'kelas' => $this->input->post('kelas'),
                            'image' => $image['file_name']
                        );
                        $this->Mod_anggota->insertAnggota("anggota", $save);
                        // echo "berhasil"; die();
                        redirect('anggota/index/create-success');

                    }
                    //apabila tidak ada gambar yg diupload
                    else{
                        $data['message'] = "<div class='alert alert-block alert-danger'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <p><strong><i class='icon-ok'></i>Gambar</strong> Masih Kosong...!</p></div>"; 
                        $this->template->load('layoutbackend', 'anggota/anggota_create', $data);
                    } 
                }
            }
            //jika tidak mengkosongkan
            else{
                $data['message'] = "";
                $this->template->load('layoutbackend', 'anggota/anggota_create', $data);
            }
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        $data['edit']    = $this->Mod_anggota->cekAnggota($id)->row_array();
        // $data['anggota'] =  $this->Mod_anggota->getAll()->result_array();
        // print_r($data['edit']); die();
        $this->template->load('layoutbackend', 'anggota/anggota_edit', $data);
    }

    public function update()
    {
        if(isset($_POST['update'])) {

            //apabila ada gambar yg diupload
            if(!empty($_FILES['userfile']['name'])) {
                

                $this->_set_rules();

                //apabila user mengkosongkan form input
                if($this->form_validation->run()==true){
                    // echo "masuk"; die();
                    
                    $nis = $this->input->post('nis');
                    
                    $nama = slug($this->input->post('nama'));
                    $config['upload_path']   = './assets/img/anggota/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	     = '1000';
                    $config['max_width']     = '2000';
                    $config['max_height']    = '1024';
                    $config['file_name']     = $nama; 
                            
                    $this->upload->initialize($config);

                        //apabila ada gambar yg diupload
                    if ($this->upload->do_upload('userfile')){
                        
                        $image = $this->upload->data();

                        $save  = array(
                            'nis'   => $this->input->post('nis'),
                            'nama'  => $this->input->post('nama'),
                            'jk'    => $this->input->post('jenis'),
                            'ttl'   => $this->input->post('tgl_lahir'),
                            'kelas' => $this->input->post('kelas'),
                            'image' => $image['file_name']
                        );

                        $g = $this->Mod_anggota->getGambar($nis)->row_array();
                        
                        //hapus gambar yg ada diserver
                        unlink('assets/img/anggota/'.$g['image']);

                        $this->Mod_anggota->updateAnggota($nis, $save);
                        // echo "berhasil"; die();
                        redirect('anggota/index/update-success');

                    }
                    //apabila tidak ada gambar yg diupload
                    else{
                        $data['message'] = "<div class='alert alert-block alert-danger'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <p><strong><i class='icon-ok'></i>Gambar</strong> Masih Kosong...!</p></div>"; 
                        $this->template->load('layoutbackend', 'anggota/anggota_create', $data);
                    } 
                        
                    
                }
                //jika tidak mengkosongkan
                else{
                    $nis = $this->input->post('nis');
                    $data['edit']    = $this->Mod_anggota->cekAnggota($nis)->row_array();
                    $data['message']="";
                    $this->template->load('layoutbackend', 'anggota/anggota_edit', $data);
                }

            }else{
                $this->_set_rules();
                
                //apabila user mengkosongkan form input
                if($this->form_validation->run()==true){
                    // echo "masuk"; die();
                    
                    $nis = $this->input->post('nis');
                    
                    

                        $save  = array(
                            'nis'   => $this->input->post('nis'),
                            'nama'  => $this->input->post('nama'),
                            'jk'    => $this->input->post('jenis'),
                            'ttl'   => $this->input->post('tgl_lahir'),
                            'kelas' => $this->input->post('kelas')
                        );
                        $this->Mod_anggota->updateAnggota($nis, $save);
                        // echo "berhasil"; die();
                        redirect('anggota/index/update-success');

                   
                        
                    
                }
                //jika tidak mengkosongkan
                else{
                    $nis = $this->input->post('nis');
                    $data['edit']    = $this->Mod_anggota->cekAnggota($nis)->row_array();
                    $data['message']="";
                    $this->template->load('layoutbackend', 'anggota/anggota_edit', $data);
                }

            }    

        } //end post update

    }//end function update

    public function delete()
    {
        // $nis  = $this->uri->segment(3);

        $nis = $this->input->post('kode');

       

        $g = $this->Mod_anggota->getGambar($nis)->row_array();
        
        //hapus gambar yg ada diserver
        unlink('assets/img/anggota/'.$g['image']);

        $this->Mod_anggota->deleteAnggota($nis, 'anggota');
        // echo "berhasil"; die();
        redirect('anggota/index/delete-success');
        
    }

    //function global buat validasi input
    public function _set_rules()
    {
        $this->form_validation->set_rules('nis','NIS','required|max_length[10]');
        $this->form_validation->set_rules('nama','Nama','required|max_length[50]');
        $this->form_validation->set_rules('jenis','Jenis Kelamin','required|max_length[2]');
        $this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','required'); 
        $this->form_validation->set_rules('kelas','Kelas','required|max_length[10]');
        $this->form_validation->set_message('required', '{field} kosong, silahkan diisi');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>","</div>");
    }



}

/* End of file Anggota.php */
 