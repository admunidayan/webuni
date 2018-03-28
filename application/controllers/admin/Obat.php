<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->helper('form');
    }
    public function index(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->post();
                $data['title'] = 'Daftar Obat - '.$this->Admin_m->info_pt(1)->nama_info_pt;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['kategori'] =$this->Admin_m->select_all_data('kategori');
                // config paging
                $config['base_url'] = base_url('index.php/admin/obat/index');
                $config['total_rows'] = $this->Admin_m->count_data_menu(@$post['string'],@$post['kategori']); //total row
                $config['per_page'] = 10;  //show record per halaman
                $config["uri_segment"] = 4;  // uri parameter
                // style pagging
                $config['first_link']       = 'Pertama';
                $config['last_link']        = 'Terakhir';
                $config['next_link']        = 'Selanjutnya';
                $config['prev_link']        = 'Sebelumnya';
                $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
                $config['full_tag_close']   = '</ul></nav></div>';
                $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
                $config['num_tag_close']    = '</span></li>';
                $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
                $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
                $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
                $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['prev_tagl_close']  = '</span>Next</li>';
                $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
                $config['first_tagl_close'] = '</span></li>';
                $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['last_tagl_close']  = '</span></li>';
                $this->pagination->initialize($config);
                $data['offset'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $data['katgor'] = $this->Admin_m->select_all_data('kategori');
                $data['hasil'] = $this->Admin_m->select_all_data_menu($config["per_page"], $data['offset'],@$post['string'],@$post['kategori']);
                $data['page'] = 'admin/daftar-obat-v';
                $data['pagination'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function edit($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Edit Obat - '.$this->Admin_m->info_pt(1)->nama_info_pt;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['kategori'] =$this->Admin_m->select_all_data('kategori');
                $data['hasil'] = $this->Admin_m->detail_obat($id);
                $data['page'] = 'admin/edit-obat-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function input_menu(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post=$this->input->post();
                $data = array(
                    'nama_menu' =>$post['nama_menu'],
                    'id_kategori' =>$post['id_kategori'],
                    'kode_menu' =>$post['kode_menu'],
                    'stok' =>$post['stok'],
                    'harga_satuan' =>$post['harga_satuan'],
                    'harga_member' =>$post['harga_member'],
                    'diskon' =>$post['diskon'],
                    'ket_menu' =>$post['ket_menu'],
                );
                $this->Admin_m->create('menu',$data);
                $pesan = 'Obat '.$post['nama_menu'].' Berhasil ditambahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/obat/'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function update($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post=$this->input->post();
                $data = array(
                    'nama_menu' =>$post['nama_menu'],
                    'id_kategori' =>$post['id_kategori'],
                    'kode_menu' =>$post['kode_menu'],
                    'stok' =>$post['stok'],
                    'harga_satuan' =>$post['harga_satuan'],
                    'harga_member' =>$post['harga_member'],
                    'diskon' =>$post['diskon'],
                    'ket_menu' =>$post['ket_menu'],
                );
                $this->Admin_m->update('menu','id_menu',$id,$data);
                $pesan = 'Obat '.$post['nama_menu'].' Berhasil di ubah';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/obat/edit/'.$id));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function delete($id){
        $this->Admin_m->delete('menu','id_menu',$id);
        $pesan = 'Order berhasil dihapus';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/obat/'));
    }
}
?>