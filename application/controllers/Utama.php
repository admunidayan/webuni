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
    public function video($alias){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        $detail = $this->Homepage_m->row_order('video','alias_video',$alias);
        $data['title'] = $detail->judul_video;
        $data['metadeskripsi'] = $detail->judul_video;
        $data['metakeywords'] = $detail->judul_video; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['url'] = base_url('index.php/utama/video/'.$detail->alias_video);
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['detail'] = $detail;
        $data['infor'] = $this->Homepage_m->result_table_limit('info_kampus','6');
        $data['videor'] = $this->Homepage_m->result_table_limit('video','6');
        $data['page'] = 'video-v';
        $this->load->view('homepage-v',$data);
    }
    public function allnews($offset=0){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        // $detail = $this->Homepage_m->row_order('info_kampus','alias_info_kampus',$alias);
        $data['title'] = 'Semua Berita';
        $data['metadeskripsi'] = $maininfo->nama_info_pt;
        $data['metakeywords'] = 'Web Resmi '.$maininfo->nama_info_pt; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['url'] = base_url('index,php/utama/allnews');
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['page'] = 'semua-berita-v';
        $data['terkait'] = $this->Homepage_m->result_table_limit('artikel','6');
        $data['infor'] = $this->Homepage_m->result_table_limit('info_kampus','6');
        // pagging setting
        $config['base_url'] = base_url('index.php/utama/allnews/');
        $config['total_rows'] = $this->Homepage_m->count_data_artikel(@$post['string']); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
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
        $data['offset'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // pengaturan searching
        $data['nomor'] = $data['offset'];
        $data['hasil'] = $this->Homepage_m->select_all_data_artikel($config['per_page'],$offset,@$post['string']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('homepage-v',$data);
    }
    public function alldoc($offset=0){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        // $detail = $this->Homepage_m->row_order('info_kampus','alias_info_kampus',$alias);
        $data['title'] = 'Semua Dokumen';
        $data['metadeskripsi'] = $maininfo->nama_info_pt;
        $data['metakeywords'] = 'Web Resmi '.$maininfo->nama_info_pt; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['url'] = base_url('index,php/utama/allnews');
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['page'] = 'semua-dokumen-v';
        $data['terkait'] = $this->Homepage_m->result_table_limit('artikel','6');
        $data['infor'] = $this->Homepage_m->result_table_limit('info_kampus','6');
        // pagging setting
        $config['base_url'] = base_url('index.php/utama/alldoc/');
        $config['total_rows'] = $this->Homepage_m->count_data_doc(@$post['string']); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
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
        $data['offset'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // pengaturan searching
        $data['nomor'] = $data['offset'];
        $data['hasil'] = $this->Homepage_m->select_all_data_doc($config['per_page'],$offset,@$post['string']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('homepage-v',$data);
    }
    public function allgalery($offset=0){
        $post = $this->input->get();
        $maininfo = $this->Homepage_m->info_pt(1);
        // $detail = $this->Homepage_m->row_order('info_kampus','alias_info_kampus',$alias);
        $data['title'] = 'Semua Dokumen';
        $data['metadeskripsi'] = $maininfo->nama_info_pt;
        $data['metakeywords'] = 'Web Resmi '.$maininfo->nama_info_pt; 
        $data['metakategori'] = $maininfo->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$maininfo->logo_pt;
        $data['url'] = base_url('index,php/utama/allnews');
        $data['infopt'] = $maininfo;
        $data['taglineuni'] = $maininfo->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['link2'] = $this->Homepage_m->limit_link(6);
        $data['page'] = 'semua-galeri-v';
        $data['terkait'] = $this->Homepage_m->result_table_limit('artikel','6');
        $data['infor'] = $this->Homepage_m->result_table_limit('info_kampus','6');
        // pagging setting
        $config['base_url'] = base_url('index.php/utama/allgalery/');
        $config['total_rows'] = $this->Homepage_m->count_data_galery(@$post['string']); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
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
        $data['offset'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // pengaturan searching
        $data['nomor'] = $data['offset'];
        $data['hasil'] = $this->Homepage_m->select_all_data_galery($config['per_page'],$offset,@$post['string']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('homepage-v',$data);
    }
}
?>