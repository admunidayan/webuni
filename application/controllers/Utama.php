<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utama extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('Homepage_m');
    }

    public function index($offset=0){
        $post = $this->input->get();
        $data['title'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metadeskripsi'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metakeywords'] = 'Web Resmi '.$this->Homepage_m->info_pt(1)->nama_info_pt; 
        $data['metakategori'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['url'] ='';
        $data['taglineuni'] = $this->Homepage_m->info_pt(1)->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['page'] = 'homepage-main-v';
        $this->load->view('homepage-v',$data);
    }
}
?>