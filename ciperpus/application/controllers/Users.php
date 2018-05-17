<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_users');
    }


    public function index()
    {
        $data['users'] = $this->Mod_users->getAll()->result();

        if($this->uri->segment(3)=="create-success") {
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Disimpan...!</p></div>";    
            $this->template->load('layoutbackend', 'users/users_data', $data);
        }
        else if($this->uri->segment(3)=="update-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Update...!</p></div>"; 
            $this->template->load('layoutbackend', 'users/users_data', $data);
        }
        else if($this->uri->segment(3)=="delete-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Dihapus...!</p></div>"; 
            $this->template->load('layoutbackend', 'users/users_data', $data);
        }
        else{
            $this->template->load('layoutbackend', 'users/users_data', $data);
        }

       
    }

    public function create()
    {
        $this->template->load('layoutbackend', 'users/users_create');
    }

    public function insert()
    {
        if(isset($_POST['save'])) {
        
            //function validasi
            $this->_set_rules();

            //apabila users mengisi form
            if($this->form_validation->run()==true){
                $username = $this->input->post('username');
                $cek = $this->Mod_users->cekUsername($username);
                //cek nis yg sudah digunakan
                if($cek->num_rows() > 0){
                    $data['message'] = "<div class='alert alert-block alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <p><strong><i class='icon-ok'></i>Username</strong> Sudah Digunakan...!</p></div>"; 
                    $this->template->load('layoutbackend', 'users/users_create', $data); 
                }
                //kalo blm digunakan lakukan insert data kedatabase
                else{
                    
                    $save  = array(
                        'username'   => $this->input->post('username'),
                        'full_name'  => $this->input->post('full_name'),
                        'password'   => get_hash($this->input->post('password'))
                    );
                    $this->Mod_users->insertUsers("petugas", $save);
                    // echo "berhasil"; die();
                    redirect('users/index/create-success');
                }
            }
            //jika users mengkosongkan form input
            else{
                $this->template->load('layoutbackend', 'users/users_create');
            } 

        } //end $_POST['save']
    }

    public function edit($id)
    {
         
        $data['edit']    = $this->Mod_users->getUsers($id)->row_array();
        // $data['anggota'] =  $this->Mod_anggota->getAll()->result_array();
        // print_r($data['edit']); die();
        $this->template->load('layoutbackend', 'users/users_edit', $data);
    }

    public function update()
    {
        if(isset($_POST['update'])) {
        
            $this->_set_rules();

            //apabila user apabila user mengisi form input
            if($this->form_validation->run()==true){

                //apabila password diganti
                if($this->input->post('password') != "") {
                    $id_petugas      = $this->input->post('id_petugas');
                    
                    $save  = array(
                        'id_petugas' => $this->input->post('id_petugas'),
                        'username'   => $this->input->post('username'),
                        'full_name'  => $this->input->post('full_name'),
                        'password'   => get_hash($this->input->post('password'))
                    );
                    $this->Mod_users->updateUsers($id_petugas, $save);
                    // echo "berhasil"; die();
                    redirect('users/index/update-success'); 

                //jika password tidak diganit    
                }
                else{
                    $id_petugas      = $this->input->post('id_petugas');
                    
                    $save  = array(
                        'id_petugas' => $this->input->post('id_petugas'),
                        'username'   => $this->input->post('username'),
                        'full_name'  => $this->input->post('full_name')
                    );
                    $this->Mod_users->updateUsers($id_petugas, $save);
                    // echo "berhasil"; die();
                    redirect('users/index/update-success'); 
                }
                
                
                 

            }
            //jika mengkosongkan
            else{
                $id_petugas      = $this->input->post('id_petugas');
                $data['edit']    = $this->Mod_users->getUsers($id_petugas)->row_array();
                $this->template->load('layoutbackend', 'users/users_edit', $data);
            }
        
        }
    }

    public function delete()
    {
        $id_petugas = $this->input->post('id_petugas');

        $this->Mod_users->deleteUsers($id_petugas, 'petugas');
        // echo "berhasil"; die();
        redirect('users/index/delete-success');
    }

    public function _set_rules(){
        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('full_name','Full Name','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_message('required', '{field} kosong, silahkan diisi');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>","</div>");
    }

}

/* End of file Users.php */
