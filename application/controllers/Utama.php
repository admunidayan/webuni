<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utama extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('Homepage_m');
        $this->load->helper('form');
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
        $data['homeartikel'] = $this->Homepage_m->artike_home();
        $data['link1'] = $this->Homepage_m->linkgambar();
        $data['link2'] = $this->Homepage_m->linkbykateg();
        $data['info'] = $this->Homepage_m->info();
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['kategori'] = $this->Homepage_m->all_kategori();
        $data['slide'] = $this->Main_m->slide();
        $data['widget'] = $this->Main_m->widget();
        $data['navar'] = $this->Main_m->navartikel();
        $data['slider1'] = $this->Main_m->slider1();
        $data['slider2'] = $this->Main_m->slider2();
        $data['getkat'] = $this->Main_m->getkat();
        // pagging setting
        $data['contoh'] =$this->Homepage_m->jumlah_doc(@$post['string'],@$post['tahun'],@$post['idkat']);
        $jumlah = $this->Homepage_m->jumlah_doc(@$post['string'],@$post['tahun'],@$post['idkat']);
        $config['base_url'] = base_url().'index.php/';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = '10';
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
        $data['hasil'] = $this->Homepage_m->searcing_data($config['per_page'],$offset,@$post['string'],@$post['tahun'],@$post['idkat']);
        $data['pagging'] = $this->pagination->create_links();
        $data['page'] = 'homepage-main-v';
        $this->load->view('homepage-v',$data);
    }
    public function laman($alias){
        $data['title'] = $this->Homepage_m->get_laman($alias)->judul_laman;
        $data['metadeskripsi'] = $this->Homepage_m->get_laman($alias)->judul_laman;
        $data['metakeywords'] = $this->Homepage_m->get_laman($alias)->judul_laman; 
        $data['metakategori'] = $this->Homepage_m->get_laman($alias)->judul_laman;
        $data['brand'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['url'] ='index.php/homepage/laman/'.$this->Homepage_m->get_laman($alias)->alias_laman;
        $data['link1'] = $this->Homepage_m->linkgambar();
        $data['link2'] = $this->Homepage_m->linkbykateg();
        $data['taglineuni'] = $this->Homepage_m->info_pt(1)->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['infokampus'] = $this->Main_m->infokampus();
        $data['kategori'] = $this->Homepage_m->all_kategori();
        $data['hasil'] = $this->Homepage_m->get_laman($alias);
        $data['page'] = 'halaman-halaman-v';
        $this->load->view('homepage-v',$data);
    }
    public function artikel($alias){
        $data['title'] = $this->Homepage_m->get_artikel($alias)->judul_artikel;
        $data['metadeskripsi'] = $this->Homepage_m->get_artikel($alias)->judul_artikel;
        $data['metakeywords'] = $this->Homepage_m->get_artikel($alias)->judul_artikel; 
        $data['metakategori'] = $this->Homepage_m->get_artikel($alias)->nama_kategori;
        $data['brand'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['image'] ='asset/img/artikel/'.$this->Homepage_m->get_artikel($alias)->img_artikel;
        $data['link1'] = $this->Homepage_m->linkgambar();
        $data['link2'] = $this->Homepage_m->linkbykateg();
        $data['url'] ='index.php/homepage/artikel/'.$this->Homepage_m->get_artikel($alias)->alias_artikel;
        $data['taglineuni'] = $this->Homepage_m->info_pt(1)->slogan;
        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['kategori'] = $this->Homepage_m->all_kategori();
        $data['lainnya'] = $this->Artikel_m->artikel_by_kategori($this->Artikel_m->getartikel($alias)->id_kategori);
        $data['infokampus'] = $this->Main_m->infokampus();
        $data['last'] = $this->Artikel_m->terkahir_upload();
        $data['hasil'] = $this->Homepage_m->get_artikel($alias);
        $data['page'] = 'halaman-artikel-v';
        $this->load->view('homepage-v',$data);
    }
    public function allartikel($offset=0){
        $post = $this->input->get();
        $data['title'] ='Artikel '.$this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metadeskripsi'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metakeywords'] = 'Artikel '.$this->Homepage_m->info_pt(1)->nama_info_pt; 
        $data['metakategori'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['brand'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['url'] ='';
        $data['link1'] = $this->Homepage_m->linkgambar();
        $data['link2'] = $this->Homepage_m->linkbykateg();
        $data['taglineuni'] = $this->Homepage_m->info_pt(1)->slogan;
        $data['homeartikel'] = $this->Homepage_m->artike_home();

        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['dokumen'] = $this->Homepage_m->dokumen_home();
        $data['kategori'] = $this->Homepage_m->all_kategori();
        // pagging setting
        $data['contoh'] =$this->Homepage_m->jumlah_artikel(@$post['string']);
        $jumlah = $this->Homepage_m->jumlah_artikel(@$post['string']);
        $config['base_url'] = base_url().'index.php/homepage/artikel/';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = '10';
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
        $data['hasil'] = $this->Homepage_m->all_artikel($config['per_page'],$offset,@$post['string']);
        $data['pagging'] = $this->pagination->create_links();
        $data['page'] = 'all-artikel-v';
        $this->load->view('homepage-v',$data);
    }
    public function bentuk($alias,$offset=0){
        $id = $this->Homepage_m->get_id_kat($alias)->id_kategori;
        $data['title'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metadeskripsi'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metakeywords'] = 'Web Resmi '.$this->Homepage_m->info_pt(1)->nama_info_pt; 
        $data['metakategori'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['link1'] = $this->Homepage_m->linkgambar();
        $data['link2'] = $this->Homepage_m->linkbykateg();
        $data['brand'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['url'] ='';
        $data['taglineuni'] = $this->Homepage_m->info_pt(1)->slogan;

        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['kategori'] = $this->Homepage_m->all_kategori();
        // pagging setting
        $data['contoh'] =$this->Homepage_m->jumlah_doc_kat($id);
        $jumlah = $this->Homepage_m->jumlah_doc_kat($id);
        $config['base_url'] = base_url().'index.php/homepage/bentuk/'.$alias.'/';
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
        $data['hasil'] = $this->Homepage_m->searcing_data_kat($config['per_page'],$offset,$id);
        $data['pagging'] = $this->pagination->create_links();
        $data['page'] = 'bentuk-v';
        $this->load->view('homepage-v',$data);
    }
    public function dokumen($offset=0){
        $data['title'] = 'Dokmen '.$this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metadeskripsi'] = 'Dokmen '.$this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['metakeywords'] = 'Dokumen '.$this->Homepage_m->info_pt(1)->nama_info_pt; 
        $data['metakategori'] = $this->Homepage_m->info_pt(1)->nama_info_pt;
        $data['link1'] = $this->Homepage_m->linkgambar();
        $data['link2'] = $this->Homepage_m->linkbykateg();
        $data['brand'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['image'] ='asset/img/lembaga/'.$this->Homepage_m->info_pt(1)->logo_pt;
        $data['url'] ='index.php/homepage/dokumen';
        $data['taglineuni'] = $this->Homepage_m->info_pt(1)->slogan;

        $data['halaman'] = $this->Homepage_m->all_laman();
        $data['kategori'] = $this->Homepage_m->all_kategori();
        // pagging setting
        $data['contoh'] =$this->Homepage_m->jumlah_dokumen(@$post['string']);
        $jumlah = $this->Homepage_m->jumlah_dokumen(@$post['string']);
        $config['base_url'] = base_url().'index.php/homepage/dokumen/';
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
        $data['hasil'] = $this->Homepage_m->searcing_data_doc($config['per_page'],$offset,@$post['string']);
        $data['pagging'] = $this->pagination->create_links();
        $data['page'] = 'bentuk-v';
        $this->load->view('homepage-v',$data);
    }
}
?>