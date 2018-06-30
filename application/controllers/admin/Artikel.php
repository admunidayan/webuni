<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
	function __construct(){
		parent::__construct();
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
				$data['title'] = 'Daftar artikel - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['page'] = 'admin/daftar-artikel-v';
				// pagging setting
				$config['base_url'] = base_url('index.php/admin/artikel/index');
                $config['total_rows'] = $this->Admin_m->count_data_artikel(@$post['string']); //total row
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
				$data['hasil'] = $this->Admin_m->select_all_data_artikel($config['per_page'],$offset,@$post['string']);
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
				$data['title'] = 'Tambah artikel';
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['kategori'] = $this->Admin_m->select_all_data('kategori');
				$data['page'] = 'admin/tambah-artikel-v';
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
					'jdl_artikel' => $post['judul_artikel'],
					'alias_artikel' => strtolower(url_title($post['judul_artikel'])),
					'deskripsi_artikel' => $post['deskripsi_artikel'],
					'id_kategori' => $post['id_kategori'],
					'isi_artikel' => $post['isi_artikel'],
					'tgl_upload' => date('Y-m-d'),
					'status_artikel' => $post['status_artikel'],
					'id_outhor' => $this->ion_auth->user()->row()->id,
					);
				if (!empty($_FILES["img_artikel"]["tmp_name"])) {
					$config['file_name'] = strtolower(url_title('artikel'.'-'.$post['judul_artikel'].'-'.date('Y-m-d').'-'.time('H-i-s')));
					$config['upload_path'] = './asset/img/artikel/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 2048;
					$config['max_width'] = '';
					$config['max_height'] = '';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('img_artikel')){
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('errors', $error );
						redirect(base_url('index.php/admin/artikel/create'));
					}
					else{
						$img = $this->upload->data('file_name');
						$data['image_artikel'] = $img;
    					//file yang akan di resize
						$file = "asset/img/artikel/$img";
    					//output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
						$resizedFile = "asset/img/artikel/$img";
						$this->resize->smart_resize_image(null , file_get_contents($file), 705 , 395 , false , $resizedFile , true , false ,60 );
					}
				}else{
					$data['image_artikel'] = 'default.jpg';
				}
				$this->Admin_m->create('artikel',$data);
				$pesan = 'Artikel '.$post['judul_artikel'].' Berhasil dibuat';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/artikel'));
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
				$result = $this->Admin_m->detail_artikel($id);
				$data['title'] = 'Edit - '.$result->jdl_artikel;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['kategori'] = $this->Admin_m->select_all_data('kategori');
				$data['hasil'] = $result;
				$data['page'] = 'admin/edit-artikel-v';
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
				$id=$post['id_artikel'];
				$data = array(
					'jdl_artikel' => $post['judul_artikel'],
					'alias_artikel' => strtolower(url_title($post['judul_artikel'])),
					'deskripsi_artikel' => $post['deskripsi_artikel'],
					'id_kategori' => $post['id_kategori'],
					'isi_artikel' => $post['isi_artikel'],
					'tgl_upload' => date('Y-m-d'),
					'status_artikel' => $post['status_artikel'],
					'id_outhor' => $this->ion_auth->user()->row()->id,
					);
				if (!empty($_FILES["img_artikel"]["tmp_name"])) {
					$config['file_name'] = strtolower(url_title('artikel'.'-'.$post['judul_artikel'].'-'.date('Y-m-d').'-'.time('H-i-s')));
					$config['upload_path'] = './asset/img/artikel/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
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
						$file = $this->Admin_m->detail_data_order('artikel','id_artikel',$id)->img_artikel;
						if ($file != "default.jpg") {
							unlink("asset/img/artikel/$file");
						}
						$img = $this->upload->data('file_name');
						$data['image_artikel'] = $img;
    					//file yang akan di resize
						$file = "asset/img/artikel/$img";
    					//output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
						$resizedFile = "asset/img/artikel/$img";
						$this->resize->smart_resize_image(null , file_get_contents($file), 705 , 395 , false , $resizedFile , true , false ,60 );
					}
				}
				$this->Admin_m->update('artikel','id_artikel',$id,$data);
				$pesan = 'artikel '.$post['judul_artikel'].' Berhasil diedit';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/artikel'));
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
			$file = $this->Admin_m->detail_data_order('artikel','id_artikel',$id)->image_artikel;
			if ($file!=='default.jpg') {
				unlink("asset/img/artikel/$file");
			}
			$this->Admin_m->delete('artikel','id_artikel',$id);
			$this->session->set_flashdata('message', 'artikel berhasil di hapus');
			redirect(base_url('index.php/admin/artikel'));
		}
	}
}
