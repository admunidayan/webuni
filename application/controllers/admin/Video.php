<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
  public function __construct()
  {
    parent:: __construct();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('admin/Dashboard_m');
    $this->load->model('admin/Admin_m');
  }

  public function index($offset=0){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard'));
      }else{
        $post = $this->input->get();
        $data['title'] = 'Daftar Video - '.$this->Admin_m->info_pt(1)->nama_info_pt;
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
        $data['users'] = $this->ion_auth->user()->row();
        $data['aside'] = 'nav/nav';
        $data['page'] = 'admin/daftar-video-v';
        // pagging setting
        // pagging setting
        $config['base_url'] = base_url('index.php/admin/video/index');
        $config['total_rows'] = $this->Admin_m->count_data_video(@$post['string']); //total row
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
        // pengaturan searching
        $data['nomor'] = $data['offset'];
        $data['hasil'] = $this->Admin_m->select_all_data_video($config['per_page'],$offset,@$post['string']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('admin/dashboard-v',$data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/admin//login'));
    }
  }
  public function create(){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard'));
      }else{
        $post = $this->input->post();
        $data['title'] = 'Tambah Video';
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['users'] = $this->ion_auth->user()->row();
        $data['aside'] = 'nav/nav';
        $data['page'] = 'admin/tambah-video-v';
        $this->load->view('admin/dashboard-v',$data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/admin//login'));
    }
  }
  public function proses_create(){
    if ($this->ion_auth->logged_in()) {
      $level=array('admin');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard'));
      }else{
        $post = $this->input->post();
        $data = array(
          'judul_video'       => $post['judul_video'],
          'alias_video'        => strtolower(url_title($post['judul_video'])),
          'ket_video'       => $post['ket_video'],
          'isi_video'    => $post['isi_video'],
          'tgl_buat'    => date('Y-m-d')
        );
        $this->Admin_m->create('video',$data);
        $pesan = 'Video '.$post['judul_video'].' Berhasil dibuat';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/video'));
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/admin/login'));
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
        $data['title'] = 'Edit - '.$this->Admin_m->detail_data_order('video','id_video',$id)->judul_video;
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
        $data['users'] = $this->ion_auth->user()->row();
        $data['aside'] = 'nav/nav';
        $data['hasil'] = $this->Admin_m->detail_data_order('video','id_video',$id);
        $data['page'] = 'admin/edit-video-v';
        $this->load->view('admin/dashboard-v',$data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/admin//login'));
    }
  }
  public function proses_edit(){
    if ($this->ion_auth->logged_in()) {
      $level=array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard'));
      }else{
        $post = $this->input->post();
        $id=$post['id_video'];
        $data = array(
          'judul_video'       => $post['judul_video'],
          'alias_video'        => strtolower(url_title($post['judul_video'])),
          'ket_video'       => $post['ket_video'],
          'isi_video'    => $post['isi_video'],
          'tgl_buat'    => date('Y-m-d')
        );
        $this->Admin_m->update('video','id_video',$id,$data);
        $pesan = 'Video '.$post['judul_video'].' Berhasil diedit';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/video/'));
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/admin/login'));
    }
  }
  public function delete($id){
    if(!$this->ion_auth->logged_in()){
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/admin/login'));
    }else{
      $this->Admin_m->delete('video','id_video',$id);
      $this->session->set_flashdata('message', 'Video berhasil di hapus');
      redirect(base_url('index.php/admin/video/'));
    }
  }
}
