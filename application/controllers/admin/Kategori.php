<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Admin_m');
	}
	public function index(){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$data['title'] = $this->Admin_m->info_pt('1')->nama_info_pt;
				$data['brand'] = $this->Admin_m->info_pt('1')->logo_pt;
				$data['infopt'] = $this->Admin_m->info_pt('1');
				$data['users'] = $this->ion_auth->user()->row();
				$data['aside'] = 'nav/nav';
				$data['hasil'] = $this->Admin_m->select_all_data('kategori');
				$data['page'] = 'admin/halaman-kategori-v';
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
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
				$post=$this->input->post();
				$data = array(
					'nama_kategori' =>$post['nama_kategori'],
					'kode_kategori' =>$post['kode_kategori'],
					'ket_kategori' =>$post['ket_kategori'],
				);
				$this->Admin_m->create('kategori',$data);
				$pesan = 'Menu '.$post['nama_kategori'].' Berhasil ditambahkan';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/kategori'));
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
                $data['title'] = 'Edit Kategori - '.$this->Admin_m->info_pt(1)->nama_info_pt;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->detail_data_order('kategori','id_kategori',$id);
                $data['page'] = 'admin/edit-kategori-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
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
                    'nama_kategori' =>$post['nama_kategori'],
                    'kode_kategori' =>$post['kode_kategori'],
                    'ket_kategori' =>$post['ket_kategori'],
                );
                $this->Admin_m->update('kategori','id_kategori',$id,$data);
                $pesan = 'Kategori '.$post['nama_kategori'].' Berhasil di ubah';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/kategori/edit/'.$id));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
	public function delete($id){
        $this->Admin_m->delete('kategori','id_kategori',$id);
        $pesan = 'Order berhasil dihapus';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/kategori/'));
    }
}
