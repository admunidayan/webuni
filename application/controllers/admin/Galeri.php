<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galeri extends CI_Controller {
  public function __construct()
  {
    parent:: __construct();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('admin/Dashboard_m');
    $this->load->model('admin/Admin_m');
    $this->load->model('admin/Galeri_m');
    $this->load->library('resize');
  }

  public function index(){
    $data['title'] = 'Tambah Galeri'.$this->Admin_m->info_pt(1)->nama_info_pt;
    $data['page'] = 'admin/tambah-galeri-v';
    $data['dtuser'] = $this->Dashboard_m->getuser($this->session->userdata('c_id'));
    $this->load->view('admin/dashboard-v', $data);
  }
  public function daftargaleri($offset=0){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard'));
      }else{
        $post = $this->input->get();
        $data['title'] = 'Daftar Galeri - '.$this->Admin_m->info_pt(1)->nama_info_pt;
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['users'] = $this->ion_auth->user()->row();
        if ($this->ion_auth->in_group('admin')) {
          $data['aside'] = 'nav/nav-admin';
        }else{
          $data['aside'] = 'nav/nav-members';
        }
        $data['page'] = 'admin/daftar-galeri-v';
        // pagging setting
        $data['contoh'] =$this->Galeri_m->jumlah(@$post['string']);
        $jumlah = $this->Galeri_m->jumlah(@$post['string']);
        $config['base_url'] = base_url().'index.php/admin/galeri/';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = '20';
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
                // bootstap style
        $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative;'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
                //inisialisasi config
        $this->pagination->initialize($config);
                // pengaturan searching
        $data['nomor'] = $offset;
        $data['hasil'] = $this->Galeri_m->searcing_data($config['per_page'],$offset,@$post['string']);
        $data['pagging'] = $this->pagination->create_links();
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
        $data['title'] = 'Tambah Galeri';
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['users'] = $this->ion_auth->user()->row();
        if ($this->ion_auth->in_group('admin')) {
          $data['aside'] = 'nav/nav-admin';
        }else{
          $data['aside'] = 'nav/nav-members';
        }
        $data['page'] = 'admin/tambah-galeri-v';
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
          'nama_galeri'       => $post['nama_galeri'],
          'ket_galeri'    => $post['ket_galeri']
          );
        if (!empty($_FILES["img_artikel"]["tmp_name"])) {
          $config['file_name'] = strtolower(url_title('galeri'.'-'.$post['nama_galeri'].'-'.date('Y-m-d').'-'.time('H-i-s')));
          $config['upload_path'] = './asset/img/galeri/';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = 2048;
          $config['max_width'] = '';
          $config['max_height'] = '';

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('img_artikel')){
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('errors', $error );
            redirect(base_url('index.php/admin/galeri/create'));
          }
          else{
            $img = $this->upload->data('file_name');
            $data['isi_galeri'] = $img;
              //file yang akan di resize
            $file = "asset/img/galeri/$img";
              //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
            $resizedFile = "asset/img/galeri/$img";
            $this->resize->smart_resize_image(null , file_get_contents($file), 705 , 395 , false , $resizedFile , true , false ,60 );
          }
        }else{
          $data['isi_galeri'] = 'default.jpg';
        }
        $this->Galeri_m->Insert_galeri($data);
        $pesan = 'Galeri '.$post['nama_galeri'].' Berhasil dibuat';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/galeri/daftargaleri'));
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
        $data['title'] = 'Edit - '.$this->Galeri_m->detailgaleri($id)->nama_galeri;
        $data['infopt'] = $this->Admin_m->info_pt(1);
        $data['users'] = $this->ion_auth->user()->row();
        if ($this->ion_auth->in_group('admin')) {
          $data['aside'] = 'nav/nav-admin';
        }else{
          $data['aside'] = 'nav/nav-members';
        }
        $data['detail'] = $this->Galeri_m->detailgaleri($id);
        $data['page'] = 'admin/edit-galeri-v';
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
        $id=$post['id_galeri'];
        $data = array(
          'nama_galeri'       => $post['nama_galeri'],
          'ket_galeri'    => $post['ket_galeri']
          );
        if (!empty($_FILES["img_artikel"]["tmp_name"])) {
          $config['file_name'] = strtolower(url_title('galeri'.'-'.$post['nama_galeri'].'-'.date('Y-m-d').'-'.time('H-i-s')));
          $config['upload_path'] = './asset/img/galeri/';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = 2048;
          $config['max_width'] = '';
          $config['max_height'] = '';

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('img_artikel')){
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('errors', $error );
            redirect(base_url('index.php/admin/artikel/edit/'.$id));
          }
          else{
            $file = $this->Galeri_m->cek_galeri($id)->isi_galeri;
            if ($file != "default.jpg") {
              unlink("asset/img/galeri/$file");
            }
            $img = $this->upload->data('file_name');
            $data['isi_galeri'] = $img;
              //file yang akan di resize
            $file = "asset/img/galeri/$img";
              //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
            $resizedFile = "asset/img/galeri/$img";
            $this->resize->smart_resize_image(null , file_get_contents($file), 705 , 395 , false , $resizedFile , true , false ,60 );
          }
        }
        $this->Galeri_m->edit_galeri($id,$data);
        $pesan = 'Galeri '.$post['nama_galeri'].' Berhasil diedit';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/galeri/daftargaleri'));
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
      $this->Galeri_m->delete_galeri($id);
      $this->session->set_flashdata('message', 'artikel berhasil di hapus');
      redirect(base_url('index.php/admin/galeri/daftargaleri'));
    }
  }
  public function proses_add_galeri() {
    date_default_timezone_set("Asia/Jakarta");
    $post = $this->input->post();

    $data = array(
      'nama_galeri'       => $post['nama_galeri'],
      'ket_galeri'    => $post['ket_galeri']
      );
    $namafolder="asset/img/galeri/"; //folder tempat menyimpan file
    if (!empty($_FILES["tambahartikel"]["tmp_name"]))
    {
      $LastID = $this->Galeri_m->getLastIDgaleri()->id_galeri;
      $newID = ++$LastID;
      $namaExpl = explode('.', basename($_FILES['tambahartikel']['name']));
      $jmlArr = count($namaExpl);
      $namaFix = '';
      for ($i = 0; $i < $jmlArr-1; $i++) {
        $namaFix .= $namaExpl[$i];
      }

      $namafileOri = strtolower(url_title("stkiptgalek".'-'.$post['nama_galeri'].'-'.$newID.'-'.date('Ymd').'-'.time('Hms')).'.'.$namaExpl[$jmlArr-1]);
      // replace file name
      $_FILES['tambahartikel']['name'] = $namafileOri;
      $jenis_gambar=$_FILES['tambahartikel']['type'];
      if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/png" || $jenis_gambar=="image/x-png")
      {
        $gambar = $namafolder . basename($_FILES['tambahartikel']['name']);
        if (move_uploaded_file($_FILES['tambahartikel']['tmp_name'], $gambar)) {
          //echo "Gambar yang di upload: ".basename($_FILES['epsimage']['name']);
          $data['isi_galeri'] = basename($_FILES['tambahartikel']['name']);
        } else {
          $data['isi_galeri'] = 'default.jpg';
        }
      } else {
        $data['isi_galeri'] = 'default.jpg';
      }
    } else {
      $data['isi_galeri'] = 'default.jpg';
    }
    $a = basename($_FILES['tambahartikel']['name']);
    //file yang akan di resize
    $file = "asset/img/galeri/$a";
    //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
    $resizedFile = "asset/img/galeri/$a";
    $this->resize->smart_resize_image(null , file_get_contents($file), 705 , 395 , false , $resizedFile , true , false ,60 );

    $this->Galeri_m->insert_galeri ($data);
    $this->session->set_flashdata('message', 'gambar baru berhasil di tambahkan');

    redirect(base_url('daftar-galeri'));
  }
  public function delete_galeri($id){
    if(!$this->Account->validate_cookie()){
      show_404();
    }else{
      $file = $this->Galeri_m->cek_galeri($id)->row('isi_galeri');
      if ($file != "default.jpg") {
        unlink("asset/img/galeri/$file");
      }
      $this->Galeri_m->delete_galeri($id);
      $this->session->set_flashdata('message', 'Gambar berhasil di hapus');
      redirect(base_url('daftar-galeri'));
    }
  }
  public function detailgaleri($id){
    $data['title'] = 'Detail Galeri';
    $data['page'] = 'admin/edit-galeri-v';
    $data['detailgaleri'] = $this->Galeri_m->detailgaleri($id);
    $data['dtuser'] = $this->Dashboard_m->getuser($this->session->userdata('c_id'));
    $this->load->view('admin/dashboard-v', $data);
  }
  public function proses_edit_galeri() {
    date_default_timezone_set("Asia/Jakarta");
    $post = $this->input->post();

    $data = array(
      'nama_galeri'       => $post['nama_galeri'],
      'ket_galeri'    => $post['ket_galeri']
      );

    $id = $this->input->post('id_galeri');
    $post = $this->input->post();
    $file = $this->Galeri_m->cek_galeri($id)->row('isi_galeri');

    if (!empty($_FILES["tambahartikel"]["tmp_name"])) {
            if ($file != "default.jpg") {
                unlink("asset/img/galeri/$file");
            }
        }
    $namafolder="asset/img/galeri/"; //folder tempat menyimpan file
    if (!empty($_FILES["tambahartikel"]["tmp_name"]))
    {
      $LastID = $this->Galeri_m->getLastIDGaleri()->id_galeri;
      $newID = ++$LastID;
      $namaExpl = explode('.', basename($_FILES['tambahartikel']['name']));
      $jmlArr = count($namaExpl);
      $namaFix = '';
      for ($i = 0; $i < $jmlArr-1; $i++) {
        $namaFix .= $namaExpl[$i];
      }

      $namafileOri = strtolower(url_title("stkiptgalek".'-'.$post['nama_galeri'].'-'.$newID.'-'.date('Ymd').'-'.time('Hms')).'.'.$namaExpl[$jmlArr-1]);
      // replace file name
      $_FILES['tambahartikel']['name'] = $namafileOri;
      $jenis_gambar=$_FILES['tambahartikel']['type'];
      if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/png" || $jenis_gambar=="image/x-png")
      {
        $gambar = $namafolder . basename($_FILES['tambahartikel']['name']);
        if (move_uploaded_file($_FILES['tambahartikel']['tmp_name'], $gambar)) {
          //echo "Gambar yang di upload: ".basename($_FILES['epsimage']['name']);
          $data['isi_galeri'] = basename($_FILES['tambahartikel']['name']);
        } else {
          $data['isi_galeri'] = $this->input->post('profilsaatini');
        }
      } else {
        $data['isi_galeri'] = $this->input->post('profilsaatini');
      }
    } else {
      $data['isi_galeri'] = $this->input->post('profilsaatini');
    }
    $a = basename($_FILES['tambahartikel']['name']);
    //file yang akan di resize
    $file = "asset/img/galeri/$a";
    //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
    $resizedFile = "asset/img/galeri/$a";
    $this->resize->smart_resize_image(null , file_get_contents($file), 705 , 395 , false , $resizedFile , true , false ,60 );

    $this->Galeri_m->edit_galeri ($id, $data);
    $this->session->set_flashdata('message', 'Gambar berhasil di perbarui');

    redirect(base_url('edit-galeri/'.$_POST['id_galeri']));
  }
}
