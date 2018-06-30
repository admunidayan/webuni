<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Admin_m');
		$this->load->library('resize');
	}
	// slider
	public function index($offset=0){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$post = $this->input->get();
				$data['title'] = 'Daftar Slider - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['page'] = 'admin/daftar-slider-v';
				$data['hasil'] = $this->Admin_m->select_all_data('slider');
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
					'jdl_slider' => $post['jdl_slider'],
					'alias_slider' => strtolower(url_title($post['jdl_slider'])),
					'tgl_slider' => date('Y-m-d'),
					);
				if (!empty($_FILES["img_slider"]["tmp_name"])) {
					$config['file_name'] = strtolower(url_title('slider'.'-'.$post['jdl_slider'].'-'.date('Y-m-d').'-'.time('H-i-s')));
					$config['upload_path'] = './asset/img/slider/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 2048;
					$config['max_width'] = '';
					$config['max_height'] = '';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('img_slider')){
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('errors', $error );
						redirect(base_url('index.php/admin/slider'));
					}
					else{
						$img = $this->upload->data('file_name');
						$data['img_slider'] = $img;
    					//file yang akan di resize
						$file = "asset/img/slider/$img";
    					//output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
						$resizedFile = "asset/img/slider/$img";
						$this->resize->smart_resize_image(null , file_get_contents($file), 1170 , 350 , false , $resizedFile , true , false ,90 );
					}
				}else{
					$data['img_slider'] = 'default.jpg';
				}
				$this->Admin_m->create('slider',$data);
				$pesan = 'Slider '.$post['jdl_slider'].' Berhasil dibuat';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/slider'));
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
				$data['title'] = 'Edit - '.$this->Admin_m->detail_data_order('slider','id_slider',$id)->jdl_slider;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['aside'] = 'nav/nav';
				$data['detail'] = $this->Admin_m->detail_data_order('slider','id_slider',$id);
				$data['page'] = 'admin/edit-slider-v';
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
				$id=$post['id_slider'];
				$data = array(
					'jdl_slider' => $post['jdl_slider'],
					'alias_slider' => strtolower(url_title($post['jdl_slider'])),
					'tgl_slider' => date('Y-m-d'),
					);
				if (!empty($_FILES["img_slider"]["tmp_name"])) {
					$config['file_name'] = strtolower(url_title('slider'.'-'.$post['jdl_slider'].'-'.date('Y-m-d').'-'.time('H-i-s')));
					$config['upload_path'] = './asset/img/slider/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 2048;
					$config['max_width'] = '';
					$config['max_height'] = '';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('img_slider')){
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('errors', $error );
						redirect(base_url('index.php/admin/sliser/edit/'.$id));
					}
					else{
						$file = $this->Admin_m->detail_data_order('slider','id_slider',$id)->img_slider;
						if ($file != "default.jpg") {
							unlink("asset/img/slider/$file");
						}
						$img = $this->upload->data('file_name');
						$data['img_slider'] = $img;
    					//file yang akan di resize
						$file = "asset/img/slider/$img";
    					//output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
						$resizedFile = "asset/img/slider/$img";
						$this->resize->smart_resize_image(null , file_get_contents($file), 1170 , 350 , false , $resizedFile , true , false ,90 );
					}
				}
				$this->Admin_m->update('slider','id_slider',$id,$data);
				$pesan = 'slider '.$post['jdl_slider'].' Berhasil diedit';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/slider'));
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
			$file = $this->Admin_m->detail_data_order('slider','id_slider',$id)->img_slider;
			if ($file!=='default.jpg') {
				unlink("asset/img/slider/$file");
			}
			$this->Admin_m->delete('slider','id_slider',$id);
			$this->session->set_flashdata('message', 'Slider berhasil di hapus');
			redirect(base_url('index.php/admin/slider/'));
		}
	}
}
