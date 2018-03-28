<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Admin_m');
		$this->load->model('admin/Users_m');
	}
	public function index(){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$post = $this->input->get();
				$data['title'] = 'Daftar users - '.$this->Admin_m->info_pt(1)->nama_info_pt;
				$data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['page'] = 'admin/daftar-member-v';
				$config['base_url'] = base_url('index.php/admin/member/index/');
                $config['total_rows'] = $this->Admin_m->count_data_member(@$post['string']); //total row
                $config['per_page'] = 10;  //show record per halaman
                $config["uri_segment"] = 4;  // uri parameter
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
                $data['offset'] = ($this->uri->segment(3)) ? $this->uri->segment(4) : 0;
                $data['pagination'] = $this->pagination->create_links();
				$data['hasil'] = $this->Admin_m->select_all_data_member($config["per_page"], $data['offset'],@$post['string']);
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
				$data['title'] = 'Tambah users';
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				if ($this->ion_auth->in_group('admin')) {
					$data['aside'] = 'nav/nav-admin';
				}else{
					$data['aside'] = 'nav/nav-members';
				}
				$data['groups'] = $this->ion_auth->groups()->result();
				$data['page'] = 'admin/tambah-users-v';
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
				if ($this->Admin_m->lastid('member','id_member') == TRUE) {
					$lastid = $this->Admin_m->lastid('member','id_member')->id_member+1;	
				}else{
					$lastid = 1;
				}
				$kodemember = str_pad($lastid, 8, "0", STR_PAD_LEFT);
				$data = array(
					'nm_member' => $post['nm_member'],
					'kode_member' => $kodemember,
					'tgl_lahir_member' => $post['tgl_lahir_member_thn'].'-'.$post['tgl_lahir_member_bln'].'-'.$post['tgl_lahir_member_hr'],
					'tmpt_lahir_member' => $post['tmpt_lahir_member'],
					'hp_member' => $post['hp_member'],
					'nik_member' => $post['nik_member'],
					'tgl_create' => date('Y-m-d'),
					'alamat_member' => $post['alamat_member'],
					'status_member' => 1,
					);
				$this->Admin_m->create('member',$data);
				$pesan = 'Member '.$post['nm_member'].' Berhasil dibuat';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/member'));
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
				$detail = $this->Admin_m->detail_data_order('member','id_member',$id);
				$data['title'] = 'Edit - '.$detail->nm_member;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $this->ion_auth->user()->row();
				$data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
				$data['aside'] = 'nav/nav';
				$data['detail'] = $detail;
				$data['page'] = 'admin/edit-member-v';
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
			$level=array('admin');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$post = $this->input->post();
				$id = $this->input->post('id_member');
				$data = array(
					'nm_member' => $post['nm_member'],
					'tgl_lahir_member' => $post['tgl_lahir_member_thn'].'-'.$post['tgl_lahir_member_bln'].'-'.$post['tgl_lahir_member_hr'],
					'tmpt_lahir_member' => $post['tmpt_lahir_member'],
					'hp_member' => $post['hp_member'],
					'nik_member' => $post['nik_member'],
					'alamat_member' => $post['alamat_member']
					);
                $this->Admin_m->update('member','id_member',$id,$data);

				$pesan = 'Member '.$this->input->post('nm_member').' Berhasil di edit';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/member'));
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
			$this->Admin_m->delete('member','id_member',$id);
			$this->session->set_flashdata('message', 'users berhasil di hapus');
			redirect(base_url('index.php/admin/member'));
		}
	}
}
