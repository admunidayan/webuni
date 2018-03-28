<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Histori extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->helper('form');
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
                $data['title'] = 'Histori - '.$this->Admin_m->info_pt(1)->nama_info_pt;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->select_all_data('tahun');
                $data['page'] = 'admin/histori-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function bulan($tahun,$bulan=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Detail Tahun '.$tahun;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->select_all_data('bulan');
                $data['thn'] =$tahun;
                $data['bland'] =$bulan;
                $data['bln'] =$this->Admin_m->select_all_data_bulan($tahun.'-'.$bulan);
                $data['page'] = 'admin/histori-bulan-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function list_bulan($bulan){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Detail Bulan '.$bulan;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['hasil'] =$this->Admin_m->select_all_data_bulan($bulan);
                $data['page'] = 'admin/histori-list-bulan-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function hari($tgl){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Daftar Nota Tanggal '.$tgl;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->list_pembelian_hari_ini($tgl);
                $data['tanggal'] = $tgl;
                $data['ukeluar'] = $this->Admin_m->select_all_data_order('uang_keluar','tgl_uang_keluar',$tgl);
                $data['umasuk'] = $this->Admin_m->select_all_data_order('uang_masuk','tgl_uang_masuk',$tgl);
                $data['brglaku'] = $this->Admin_m->select_barang_laku($tgl);
                $data['page'] = 'admin/histori-hari-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function create_uang_keluar($tgl)
    {
        $post = $this->input->post();
        $data = array(
            'keterangan' => $post['keterangan'],
            'tgl_uang_keluar' => $tgl,
            'jumlah' => $post['jumlah']
            );
        $this->Admin_m->create('uang_keluar',$data);

        $cektgl = $this->Admin_m->detail_data_order('tanggal','kode',$tgl);
        if (empty($cektgl)) {
            $dttgl = array('kode' => $tgl,'total' =>trim($post['jumlah']));
            $this->Admin_m->create('tanggal',$dttgl);
        }else{
            $datatgl = array('total' => $cektgl->total-$post['jumlah']);
            $this->Admin_m->update('tanggal','id_tanggal',$cektgl->id_tanggal,$datatgl);
        }
        $pesan = 'Uang keluar berhasil dibuat';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/histori/hari/'.$tgl));
    }
    public function create_uang_masuk($tgl)
    {
        $post = $this->input->post();
        $data = array(
            'keterangan' => $post['keterangan'],
            'tgl_uang_masuk' => $tgl,
            'jumlah' => $post['jumlah']
            );
        $this->Admin_m->create('uang_masuk',$data);

        $cektgl = $this->Admin_m->detail_data_order('tanggal','kode',$tgl);
         if (empty($cektgl)) {
            $dttgl = array('kode' => $tgl,'total' =>trim($post['jumlah']));
            $this->Admin_m->create('tanggal',$dttgl);
        }else{
            $datatgl = array('total' => $cektgl->total+$post['jumlah']);
            $this->Admin_m->update('tanggal','id_tanggal',$cektgl->id_tanggal,$datatgl);
        }
        $pesan = 'Uang masuk berhasil dibuat';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/histori/hari/'.$tgl));
    }
    public function cetak_hasil($tgl){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Cetak penghasilan tanggal '.$tgl;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->list_pembelian_hari_ini($tgl);
                $data['tanggal'] = $tgl;
                $data['ukeluar'] = $this->Admin_m->select_all_data_order('uang_keluar','tgl_uang_keluar',$tgl);
                $data['umasuk'] = $this->Admin_m->select_all_data_order('uang_masuk','tgl_uang_masuk',$tgl);
                $data['brglaku'] = $this->Admin_m->select_barang_laku($tgl);
                // pagging setting
                $this->load->view('admin/cetak-hasil-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function nota($nota){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $data['title'] = 'detail nota '.$nota;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['detnota'] = $this->Admin_m->detail_data_nota($nota);
                $data['beli'] = $this->Admin_m->list_data_beli($nota);
                $data['page'] = 'admin/detail-nota-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>