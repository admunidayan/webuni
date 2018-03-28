<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {
	function __construct(){
		parent::__construct();
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
				$data['title'] = 'Daftar Dokumen - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['page'] = 'admin/daftar-dokumen-v';
				// pagging setting
                $config['base_url'] = base_url('index.php/admin/dokumen/index');
                $config['total_rows'] = $this->Admin_m->count_data_dokumen(@$post['string']); //total row
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
				$data['hasil'] = $this->Admin_m->select_all_data_dokumen($config['per_page'],$offset,@$post['string']);
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
				$data['title'] = 'Tambah Dokumen';
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['page'] = 'admin/tambah-dokumen-v';
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
			//echo "<pre>";print_r($post);echo "</pre>";exit();
			$data = array(
				'nama_dokumen' => $post['nama_dokumen'],
				'alias_dokumen' => strtolower(url_title($post['nama_dokumen'])),
				'status_dokumen' => $post['status_dokumen'],
				'ket_dokumen' => $post['ket_dokumen'],
				'tgl_upload_dokumen' => date('Y-m-d'),
				);
				// upload file
			if (!empty($_FILES["file_dokumen"]["tmp_name"])) {
				$config['file_name'] = strtolower(url_title('dok'.'-'.$post['nama_dokumen'].'-'.time('His')));
				$config['upload_path'] = './asset/dokumen/';
				$config['allowed_types'] = 'pdf|doc|xls|xlsx|ppt|pptx|docx';
				$config['max_size'] = 3072;
				$config['max_width'] = '';
				$config['max_height'] = '';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_dokumen')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('message', $error );
					redirect(base_url('index.php/admin/dokumen/create'));
				}
				else{
					$data['file_dokumen'] = $this->upload->data('file_name');
					$data['type_dokumen'] = $this->upload->data('file_ext');
				}
			}
			$this->Admin_m->create('dokumen',$data);
			$pesan = 'Dokumen '.$post['nama_dokumen'].' Berhasil dibuat';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/dokumen'));
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}
	}
	public function kategori($offset=0){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$post = $this->input->get();
				$data['title'] = 'Daftar kategori Dokumen - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				if ($this->ion_auth->in_group('admin')) {
					$data['aside'] = 'nav/nav-admin';
				}else{
					$data['aside'] = 'nav/nav-members';
				}
				$data['page'] = 'admin/daftar-kategori-dokumen-v';
				// pagging setting
				$data['contoh'] =$this->Admin_m->jumlahkadok(@$post['string']);
				$jumlah = $this->Admin_m->jumlahkadok(@$post['string']);
				$config['base_url'] = base_url().'index.php/admin/dokumen/kategori/';
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
				$data['hasil'] = $this->Admin_m->searcing_data_dokumen($config['per_page'],$offset,@$post['string']);
				$data['pagging'] = $this->pagination->create_links();
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin//login'));
		}
	}
	public function proses_create_kategori_dokumen(){
		if ($this->ion_auth->logged_in()) {
			$level=array('admin');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$post = $this->input->post();
				$data = array(
					'nama_kategori_dokumen' => $post['nama_kategori'],
					'alias_kategori_dokumen' => strtolower(url_title($post['nama_kategori'])),
					);
				$this->Admin_m->Insert_kategori_dokumen($data);
				$pesan = 'Kategori '.$post['nama_kategori'].' Berhasil dibuat';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dokumen/kategori'));
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
				$data['title'] = 'Edit - '.$this->Admin_m->detail_data_order('dokumen','id_dokumen',$id)->nama_dokumen;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['hasil'] = $this->Admin_m->detail_data_order('dokumen','id_dokumen',$id);
				$data['page'] = 'admin/edit-dokumen-v';
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
			$id=$post['id_dokumen'];
			$data = array(
				'nama_dokumen' => $post['nama_dokumen'],
				'alias_dokumen' => strtolower(url_title($post['nama_dokumen'])),
				'status_dokumen' => $post['status_dokumen'],
				'ket_dokumen' => $post['ket_dokumen'],
				'tgl_upload_dokumen' => date('Y-m-d'),
				);
				// upload file
			if (!empty($_FILES["file_dokumen"]["tmp_name"])) {
				$file = $this->Admin_m->detail_data_order('dokumen','id_dokumen',$id)->file_dokumen;
				if ($file != "default.jpg") {
					unlink("asset/dokumen/$file");
				}
				$config['file_name'] = strtolower(url_title('dok'.'-'.$post['nama_dokumen'].'-'.time('His')));
				$config['upload_path'] = './asset/dokumen/';
				$config['allowed_types'] = 'pdf|doc|xls|xlsx|ppt|pptx|docx';
				$config['max_size'] = 3072;
				$config['max_width'] = '';
				$config['max_height'] = '';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_dokumen')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('message', $error );
					redirect(base_url('index.php/admin/dokumen/edit/'.$post['id_dokumen']));
				}
				else{
					$data['file_dokumen'] = $this->upload->data('file_name');
					$data['type_dokumen'] = $this->upload->data('file_ext');
				}
			}
			$this->Admin_m->update('dokumen','id_dokumen',$id,$data);
			$pesan = 'Dokumen '.$post['nama_dokumen'].' Berhasil diedit';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/dokumen'));
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
      $file = $this->Admin_m->detail_data_order('dokumen','id_dokumen',$id)->file_dokumen;
      if ($file==true) {
      	unlink("asset/dokumen/$file");
      }
      $this->Admin_m->delete('dokumen','id_dokumen',$id);
      $this->session->set_flashdata('message', 'Laman berhasil di hapus');
      redirect(base_url('index.php/admin/dokumen'));
    }
  }
  public function edit_kategori_dokumen($id){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$data['title'] = 'Edit - '.$this->Admin_m->detail_kategori_dokumen($id)->nama_kategori_dokumen;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				if ($this->ion_auth->in_group('admin')) {
					$data['aside'] = 'nav/nav-admin';
				}else{
					$data['aside'] = 'nav/nav-members';
				}
				$data['detail'] = $this->Admin_m->detail_kategori_dokumen($id);
				$data['page'] = 'admin/edit-kategori-dokumen-v';
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin//login'));
		}
	}
	public function proses_edit_kategori_dokumen(){
		if ($this->ion_auth->logged_in()) {
			$level=array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$post = $this->input->post();
				$id=$post['id_kategori'];
				$data = array(
					'nama_kategori_dokumen' => $post['nama_kategori'],
					'alias_kategori_dokumen' => strtolower(url_title($post['nama_kategori'])),
				);
				$this->Admin_m->update_kategori_dokumen($id,$data);
				$pesan = 'kategori '.$post['nama_kategori'].' Berhasil diedit';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dokumen/kategori'));
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}
	}
	public function delete_kategori_dokumen($id){
		if(!$this->ion_auth->logged_in()){
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}else{
			$this->Admin_m->delete_kategori_dokumen($id);
			$this->session->set_flashdata('message', 'Kategori berhasil di hapus');
			redirect(base_url('index.php/admin/dokumen/kategori'));
		}
	}
}
