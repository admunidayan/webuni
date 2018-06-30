<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends CI_Controller {
  public function __construct()
  {
    parent:: __construct();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('admin/Admin_m');
    $this->load->library('resize');
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
        $data['title'] = 'Daftar Link - '.$this->Admin_m->info_pt(1)->nama_info_pt;
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['users'] = $this->ion_auth->user()->row();
        $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
        $data['aside'] = 'nav/nav';
        $data['page'] = 'admin/daftar-link-v';
        // pagging setting
        $config['base_url'] = base_url('index.php/admin/link/index');
        $config['total_rows'] = $this->Admin_m->count_data_link(@$post['string']); //total row
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
        $data['hasil'] = $this->Admin_m->select_all_data_link($config['per_page'],$offset,@$post['string']);
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
        $data['title'] = 'Tambah Link';
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
        $data['users'] = $this->ion_auth->user()->row();
        $data['aside'] = 'nav/nav';
        $data['page'] = 'admin/tambah-link-v';
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
          'nama_link'       => $post['nama_link'],
          'ket_link'    => $post['ket_link']
        );
        if (!empty($_FILES["img_artikel"]["tmp_name"])) {
          $config['file_name'] = strtolower(url_title('link'.'-'.$post['nama_link'].'-'.date('Y-m-d').'-'.time('H-i-s')));
          $config['upload_path'] = './asset/img/link/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size'] = 2048;
          $config['max_width'] = '';
          $config['max_height'] = '';

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('img_artikel')){
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('errors', $error );
            redirect(base_url('index.php/admin/link/create'));
          }
          else{
            $img = $this->upload->data('file_name');
            $data['img_link'] = $img;
              //file yang akan di resize
            $file = "asset/img/link/$img";
              //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
            $resizedFile = "asset/img/link/$img";
            $this->resize->smart_resize_image(null , file_get_contents($file), 200 , 200 , false , $resizedFile , true , false ,90 );
          }
        }else{
          $data['img_link'] = 'default.jpg';
        }
        $this->Admin_m->create('link',$data);
        $pesan = 'link '.$post['nama_link'].' Berhasil dibuat';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/link/'));
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
        $data['title'] = 'Edit - '.$this->Admin_m->detail_data_order('link','id_link',$id)->nama_link;
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['users'] = $this->ion_auth->user()->row();
        $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
        $data['aside'] = 'nav/nav';
        $data['detail'] = $this->Admin_m->detail_data_order('link','id_link',$id);
        $data['page'] = 'admin/edit-link-v';
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
        $id=$post['id_link'];
        $data = array(
          'nama_link'       => $post['nama_link'],
          'ket_link'    => $post['ket_link']
        );
        if (!empty($_FILES["img_artikel"]["tmp_name"])) {
          $config['file_name'] = strtolower(url_title('link'.'-'.$post['nama_link'].'-'.date('Y-m-d').'-'.time('H-i-s')));
          $config['upload_path'] = './asset/img/link/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size'] = 2048;
          $config['max_width'] = '';
          $config['max_height'] = '';

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('img_artikel')){
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('errors', $error );
            redirect(base_url('index.php/admin/link/edit/'.$id));
          }
          else{
            $file = $this->Admin_m->detail_data_order('link','id_link',$id)->img_link;
            if ($file != "default.jpg") {
              unlink("asset/img/link/$file");
            }
            $img = $this->upload->data('file_name');
            $data['img_link'] = $img;
              //file yang akan di resize
            $file = "asset/img/link/$img";
              //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
            $resizedFile = "asset/img/link/$img";
            $this->resize->smart_resize_image(null , file_get_contents($file), 200 , 200 , false , $resizedFile , true , false ,90 );
          }
        }
        $this->Admin_m->update('link','id_link',$id,$data);
        $pesan = 'link '.$post['nama_link'].' Berhasil diedit';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/link/'));
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
      $file = $this->Admin_m->detail_data_order('link','id_link',$id)->img_link;
      if ($file != "default.jpg") {
        unlink("asset/img/link/$file");
      }
      $this->Admin_m->delete('link','id_link',$id);
      $this->session->set_flashdata('message', 'artikel berhasil di hapus');
      redirect(base_url('index.php/admin/link/'));
    }
  }
}
