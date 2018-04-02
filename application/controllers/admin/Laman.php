<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laman extends CI_Controller {
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
				$data['title'] = 'Daftar Laman - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['page'] = 'admin/daftar-laman-v';
                // pagging setting
        		$config['base_url'] = base_url('index.php/admin/laman/index');
        		$config['total_rows'] = $this->Admin_m->count_data_laman(@$post['string']); //total row
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
        		$data['hasil'] = $this->Admin_m->select_all_data_laman($config['per_page'],$offset,@$post['string']);
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
				$data['title'] = 'Tambah Laman - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['page'] = 'admin/tambah-laman-v';
				$data['alllaman'] = $this->Admin_m->select_all_data('laman');
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
			$this->Admin_m->create('laman',$data);
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
				$data['title'] = 'Edit - '.$this->Admin_m->detail_data_order('laman','alias_laman',$alias)->judul_laman;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['aside'] = 'nav/nav';
				$data['detail'] = $this->Admin_m->detail_data_order('laman','alias_laman',$alias);
				$data['alllaman'] = $this->Admin_m->select_all_data('laman');
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
					$file = $this->Admin_m->detail_data_order('laman','id_laman',$id)->img_laman;
					if ($file != "default.jpg") {
						unlink("asset/img/laman/$file");
					}
					$data['img_laman'] = $this->upload->data('file_name');
				}
			}
			$this->Admin_m->update('laman','id_laman',$id,$data);
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
      $file = $this->Admin_m->detail_data_order('laman','alias_laman',$alias)->img_laman;
      if ($file==true) {
      	unlink("asset/img/laman/$file");
      }
      $this->Admin_m->delete('laman','alias',$alias);
      $this->session->set_flashdata('message', 'Laman berhasil di hapus');
      redirect(base_url('index.php/admin/laman'));
    }
  }
}
