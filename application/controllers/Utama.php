<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utama extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('Homepage_m');
    }

    public function index($offset=0){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        $data['title'] = $maininfo->nama_info_pt;
        $data['metadeskripsi'] = $maininfo->nama_info_pt;
        $data['metakeywords'] = 'Web Resmi '.$maininfo->nama_info_pt; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['url'] ='';
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['scslider'] = $this->Homepage_m->sc_slider();
        $data['ftslider'] = $this->Homepage_m->ft_slider();
        $data['artikel'] = $this->Homepage_m->artike_home();
        $data['link'] = $this->Homepage_m->limit_link(16);
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['video'] = $this->Homepage_m->result_table_limit('video','3');
        $data['page'] = 'homepage-main-v';
        $this->load->view('homepage-v',$data);
    }
    public function laman($alias){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        $detail = $this->Homepage_m->row_order('laman','alias_laman',$alias);
        $data['title'] = $detail->judul_laman;
        $data['metadeskripsi'] = $detail->judul_laman;
        $data['metakeywords'] = $detail->judul_laman; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['url'] = base_url('index.php/utama/laman/'.$detail->alias_laman);
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['detail'] = $detail;
        $data['page'] = 'laman-v';
        $this->load->view('homepage-v',$data);
    }
    public function artikel($alias){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        $detail = $this->Homepage_m->row_order('artikel','alias_artikel',$alias);
        $data['title'] = $detail->jdl_artikel;
        $data['metadeskripsi'] = $detail->deskripsi_artikel;
        $data['metakeywords'] = $detail->deskripsi_artikel; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/artikel/'.$detail->image_artikel;
        $data['url'] = base_url('index.php/utama/artikel/'.$detail->alias_artikel);
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['detail'] = $detail;
        $data['terkait'] = $this->Homepage_m->result_order_limit('artikel','id_kategori','6',$detail->id_kategori);
        $data['infor'] = $this->Homepage_m->result_table_limit('info_kampus','6');
        $data['page'] = 'artikel-v';
        $this->load->view('homepage-v',$data);
    }
    public function info($alias){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        $detail = $this->Homepage_m->row_order('info_kampus','alias_info_kampus',$alias);
        $data['title'] = $detail->judul_info_kampus;
        $data['metadeskripsi'] = $detail->judul_info_kampus;
        $data['metakeywords'] = $detail->judul_info_kampus; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['url'] = base_url('index.php/utama/info/'.$detail->alias_info_kampus);
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['detail'] = $detail;
        $data['infor'] = $this->Homepage_m->result_table_limit('info_kampus','6');
        $data['page'] = 'info-v';
        $this->load->view('homepage-v',$data);
    }
}
?>