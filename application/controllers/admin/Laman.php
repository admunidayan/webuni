<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laman extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Admin_m');
		$this->load->model('admin/Laman_m');
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
				$data['title'] = 'Daftar Laman - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				if ($this->ion_auth->in_group('admin')) {
					$data['aside'] = 'nav/nav-admin';
				}else{
					$data['aside'] = 'nav/nav-members';
				}
				$data['page'] = 'admin/daftar-laman-v';
				// pagging setting
                $data['contoh'] =$this->Laman_m->jumlah(@$post['string']);
                $jumlah = $this->Laman_m->jumlah(@$post['string']);
                $config['base_url'] = base_url().'index.php/admin/laman/index';
                $config['total_rows'] = $jumlah;
                $config['per_page'] = '10';
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
                $data['hasil'] = $this->Laman_m->searcing_data($config['per_page'],$offset,@$post['string']);
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
				$data['title'] = 'Tambah Laman - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				if ($this->ion_auth->in_group('admin')) {
					$data['aside'] = 'nav/nav-admin';
				}else{
					$data['aside'] = 'nav/nav-members';
				}
				$data['page'] = 'admin/tambah-laman-v';
				$data['alllaman'] = $this->Laman_m->all_laman();
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
			$level=array('admin','members');

			$post = $this->input->post();
			$data = array(
				'judul_laman' => $post['judul_laman'],
				'alias_laman' => strtolower(url_title($post['judul_laman'])),
				'status_laman' => $post['status_laman'],
				's_laman' => $post['s_laman'],
				'deskripsi_laman' => $post['deskripsi_laman'],
				'isi_laman' => $post['isi_laman'],
				'id_user' => $this->ion_auth->user()->row()->id,
				);
			if (!empty($post['link'])) {
				$data['link'] = $post['link'];
			}
				// upload file
			if (!empty($_FILES["img_laman"]["tmp_name"])) {
				$config['file_name'] = strtolower(url_title('laman'.'-'.$post['judul_laman'].'-'.date('Ymd').'-'.time('Hms')));
				$config['upload_path'] = './asset/img/laman/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2048;
				$config['max_width'] = '';
				$config['max_height'] = '';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('img_laman')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('message', $error );
					redirect(base_url('index.php/admin/laman/create'));
				}
				else{
					$data['img_laman'] = $this->upload->data('file_name');
				}
			}else{
				$data['img_laman'] = 'default.jpg';
			}
			$this->Laman_m->Insert_laman($data);
			$pesan = 'Laman '.$post['img_laman'].' Berhasil dibuat';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/laman'));
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}
	}
	public function edit($alias){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$data['title'] = 'Edit - '.$this->Laman_m->detail_laman($alias)->judul_laman;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				if ($this->ion_auth->in_group('admin')) {
					$data['aside'] = 'nav/nav-admin';
				}else{
					$data['aside'] = 'nav/nav-members';
				}
				$data['detail'] = $this->Laman_m->detail_laman($alias);
				$data['alllaman'] = $this->Laman_m->all_laman();
				$data['page'] = 'admin/edit-laman-v';
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
			$post = $this->input->post();
			$id=$post['id_laman'];
			$data = array(
				'judul_laman' => $post['judul_laman'],
				'alias_laman' => strtolower(url_title($post['judul_laman'])),
				'status_laman' => $post['status_laman'],
				'deskripsi_laman' => $post['deskripsi_laman'],
				'isi_laman' => $post['isi_laman'],
				'link' => $post['link'],
				's_laman' => $post['s_laman'],
				'id_user' => $this->ion_auth->user()->row()->id,
				);
				// upload file
			if (!empty($_FILES["img_laman"]["tmp_name"])) {
				$config['file_name'] = strtolower(url_title('laman'.'-'.$post['judul_laman'].'-'.date('Ymd').'-'.time('Hms')));
				$config['upload_path'] = './asset/img/laman/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2048;
				$config['max_width'] = '';
				$config['max_height'] = '';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('img_laman')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('message', $error );
					redirect(base_url('index.php/admin/laman'));
				}
				else{
					$file = $this->Laman_m->cek_laman($id)->img_laman;
					if ($file != "default.jpg") {
						unlink("asset/img/laman/$file");
					}
					$data['img_laman'] = $this->upload->data('file_name');
				}
			}
			$this->Laman_m->update_laman($id,$data);
			$pesan = 'Laman '.$post['judul_laman'].' Berhasil diedit';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/laman'));
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}
	}
	public function delete($alias){
    if(!$this->ion_auth->logged_in()){
    	$pesan = 'Login terlebih dahulu';
    	$this->session->set_flashdata('message', $pesan );
    	redirect(base_url('index.php/admin/login'));
    }else{
      $file = $this->Laman_m->detail_laman($alias)->img_laman;
      if ($file==true) {
      	unlink("asset/img/laman/$file");
      }
      $this->Laman_m->delete_laman($alias);
      $this->session->set_flashdata('message', 'Laman berhasil di hapus');
      redirect(base_url('index.php/admin/laman'));
    }
  }
}
