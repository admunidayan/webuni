<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends CI_Controller {

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
                $data['title'] = 'Pembelian - '.$this->Admin_m->info_pt(1)->nama_info_pt;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->list_pembelian_hari_ini(date('Y-m-d'));
                $data['page'] = 'admin/pembelian-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function create($tgl){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $data = array(
                    'tgl_nota' => $tgl,
                    'jam_nota' =>date('H:i:s'),
                    'id_user' => $this->ion_auth->user()->row()->id,
                    'id_status' => 1
                );
                $this->Admin_m->create('nota',$data);

                $cektgl = $this->Admin_m->detail_data('tanggal','kode',$tgl);
                if (empty($cektgl)) {
                    $dttgl = array('kode' => $tgl);
                    $this->Admin_m->create('tanggal',$dttgl);
                }
                $cektahun = $this->Admin_m->detail_data('tahun','kode_tahun',date('Y'));
                if (empty($cektahun)) {
                    $dtthn = array('kode_tahun' => date('Y'));
                    $this->Admin_m->create('tahun',$dtthn);
                }
                $lastid = $this->Admin_m->lastid('nota','id_nota')->id_nota;
                $pesan = 'Nota Baru Berhasil dibuat';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/pembelian/nota/'.$lastid));
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
                $post = $this->input->post();
                $data['title'] = 'Pembelian - Nota Nomor '.$nota;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['aside'] = 'nav/nav';
                $config['base_url'] = base_url('index.php/admin/pembelian/nota/'.$nota.'/');
                $config['total_rows'] = $this->Admin_m->count_data_menu(@$post['string'],@$post['kategori']); //total row
                $config['per_page'] = 10;  //show record per halaman
                $config["uri_segment"] = 5;  // uri parameter
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
                $data['offset'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
                $data['detnota'] = $this->Admin_m->detail_data_nota($nota);
                $data['katgor'] = $this->Admin_m->select_all_data('kategori');
                $data['menu'] = $this->Admin_m->select_all_data_menu($config["per_page"], $data['offset'],@$post['string'],@$post['kategori']);
                $data['beli'] = $this->Admin_m->list_data_beli($nota);
                $data['pagination'] = $this->pagination->create_links();
                $data['page'] = 'admin/nota-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function input_menu($tanggal,$idnota){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post=$this->input->post();
                $ceknota = $this->Admin_m->detail_data_order('nota','id_nota',$idnota);
                $detail = $this->Admin_m->detail_data_order('menu','id_menu',$post['id_menu']);
                if ($ceknota->id_member == '0') {
                    if ($detail->diskon !== '0') {
                        $hargadiskon = $detail->harga_satuan*$detail->diskon/100;
                        $harusbayar = $detail->harga_satuan-$hargadiskon;
                    }else{
                        $harusbayar = $detail->harga_satuan;
                    }
                }else{
                    if ($detail->diskon !== '0') {
                        $hargadiskon = $detail->harga_member*$detail->diskon/100;
                        $harusbayar = $detail->harga_member-$hargadiskon;
                    }else{
                        $harusbayar = $detail->harga_member;
                    }
                }
                $data = array(
                    'id_nota' =>$post['id_nota'],
                    'id_menu' =>$post['id_menu'],
                    'jml_menu' =>1,
                    'tgl_bayar' =>$tanggal,
                    'total_bayar' =>$harusbayar,
                    'id_status' =>1
                );
                $this->Admin_m->create('menu_to_nota',$data);

                $updatestrok = array('stok' =>$detail->stok-1);
                $this->Admin_m->update('menu','id_menu',$post['id_menu'],$updatestrok);
                $pesan = 'Menu '.$detail->nama_menu.' Berhasil ditambahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/pembelian/nota/'.$post['id_nota']));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function update_menu_nota($id,$idnota){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post=$this->input->post();
                $ceknota = $this->Admin_m->detail_data_order('nota','id_nota',$idnota);
                $detail = $this->Admin_m->detail_data_order('menu_to_nota','id_menu_to_nota',$id);
                $menu = $this->Admin_m->detail_data_order('menu','id_menu',$detail->id_menu);
                if ($ceknota->id_member == '0') {
                    if ($menu->diskon !== '0') {
                        $hargadiskon = $menu->harga_satuan*$menu->diskon/100;
                        $harusbayar = $menu->harga_satuan-$hargadiskon;
                    }else{
                        $harusbayar = $menu->harga_satuan;
                    }
                }else{
                    if ($menu->diskon !== '0') {
                        $hargadiskon = $menu->harga_member*$menu->diskon/100;
                        $harusbayar = $menu->harga_member-$hargadiskon;
                    }else{
                        $harusbayar = $menu->harga_member;
                    }
                }
                $data = array(
                    'jml_menu' =>$post['jml_menu'],
                    'total_bayar' =>$post['jml_menu']*$harusbayar,
                );
                $this->Admin_m->update('menu_to_nota','id_menu_to_nota',$id,$data);

                $updatestrok = array('stok' =>($menu->stok+$detail->jml_menu)-$post['jml_menu']);
                $this->Admin_m->update('menu','id_menu',$detail->id_menu,$updatestrok);

                $pesan = 'Jumlah barang menu '.$menu->nama_menu.' ditambahkan menjadi '.$post['jml_menu'];
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/pembelian/nota/'.$detail->id_nota));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function insert_member_to_nota($nota){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post=$this->input->post();
                $daftarmenu = $this->Admin_m->select_all_data_order('menu_to_nota','id_nota',$nota);
                if ($daftarmenu == TRUE) {
                    $detail = $this->Admin_m->detail_data_order('member','kode_member',$post['idmember']);
                    if ($detail == TRUE) {
                        $updatemember = array(
                            'id_member' =>$detail->id_member,
                        );
                        $this->Admin_m->update('nota','id_nota',$nota,$updatemember);
                        foreach ($daftarmenu as $data) {
                            $menu = $this->Admin_m->detail_data_order('menu','id_menu',$data->id_menu);
                            if ($menu->diskon !== '0') {
                                $hargadiskon = $menu->harga_member*$menu->diskon/100;
                                $harusbayar = $menu->harga_member-$hargadiskon;
                            }else{
                                $harusbayar = $menu->harga_member;
                            }
                            $updtmnnota = array(
                                'total_bayar' =>$data->jml_menu*$harusbayar,
                            );
                            $this->Admin_m->update('menu_to_nota','id_menu_to_nota',$data->id_menu_to_nota,$updtmnnota);
                        }
                        $pesan = 'Memeber berhasil ditambahkan kedalam nota dan daftar harga telah di ubah menjadi harga member';
                        $this->session->set_flashdata('message2', $pesan );
                        redirect(base_url('index.php/admin/pembelian/nota/'.$nota));
                    }else{
                        $pesan = 'Member '.$post['idmember']. ' tidak terdaftar, perhatikan penulisan.';
                        $this->session->set_flashdata('error2', $pesan );
                        redirect(base_url('index.php/admin/pembelian/nota/'.$nota));
                    }
                }else{
                    $pesan = 'Belum ada menu yang di masukan di dalam nota, masukan menu terlebih dahulu agar bisa menggunakan fitur tambah member';
                    $this->session->set_flashdata('message2', $pesan );
                    redirect(base_url('index.php/admin/pembelian/nota/'.$nota));
                }
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function cetak_struk($nota){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $data['title'] = 'Cetak Struk - Nota Nomor '.$nota;
                $data['infopt'] = $this->Admin_m->info_pt(1);
                $data['brand'] = 'asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['detnota'] = $this->Admin_m->detail_data_nota($nota);
                $data['beli'] = $this->Admin_m->list_data_beli($nota);
                // pagging setting
                $this->load->view('admin/cetak-struk-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function delete_nota($nota){
        $cek = $this->Admin_m->select_all_data_order('menu_to_nota','id_nota',$nota);
        if ($cek == TRUE) {
            foreach ($cek as $data) {
                $detail = $this->Admin_m->detail_data_order('menu_to_nota','id_menu_to_nota',$data->id_menu_to_nota);
                $menu = $this->Admin_m->detail_data_order('menu','id_menu',$detail->id_menu);
                $updatestrok = array('stok' =>($menu->stok+$detail->jml_menu));
                $this->Admin_m->update('menu','id_menu',$detail->id_menu,$updatestrok);
                $this->Admin_m->delete('menu_to_nota','id_menu_to_nota',$data->id_menu_to_nota);
            }
            $this->Admin_m->delete('nota','id_nota',$nota);  
        }else{
            $this->Admin_m->delete('nota','id_nota',$nota);  
        }
        $pesan = 'Nota berhasil dihapus';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/pembelian'));
    }
     public function delete_member_nota($nota){
        $daftarmenu = $this->Admin_m->select_all_data_order('menu_to_nota','id_nota',$nota);
        $updatemember = array(
            'id_member' =>0,
        );
        $this->Admin_m->update('nota','id_nota',$nota,$updatemember);
        foreach ($daftarmenu as $data) {
            $menu = $this->Admin_m->detail_data_order('menu','id_menu',$data->id_menu);
            if ($menu->diskon !== '0') {
                $hargadiskon = $menu->harga_satuan*$menu->diskon/100;
                $harusbayar = $menu->harga_satuan-$hargadiskon;
            }else{
                $harusbayar = $menu->harga_satuan;
            }
            $updtmnnota = array(
                'total_bayar' =>$data->jml_menu*$harusbayar,
            );
            $this->Admin_m->update('menu_to_nota','id_menu_to_nota',$data->id_menu_to_nota,$updtmnnota);
        }
        $pesan = 'Memeber berhasil dihapus dan daftar harga telah di ubah menjadi harga reguler';
        $this->session->set_flashdata('message2', $pesan );
        redirect(base_url('index.php/admin/pembelian/nota/'.$nota));
        
        if ($cek == TRUE) {
            foreach ($cek as $data) {
                $detail = $this->Admin_m->detail_data_order('menu_to_nota','id_menu_to_nota',$data->id_menu_to_nota);
                $menu = $this->Admin_m->detail_data_order('menu','id_menu',$detail->id_menu);
                $updatestrok = array('stok' =>($menu->stok+$detail->jml_menu));
                $this->Admin_m->update('menu','id_menu',$detail->id_menu,$updatestrok);
                $this->Admin_m->delete('menu_to_nota','id_menu_to_nota',$data->id_menu_to_nota);
            }
            $this->Admin_m->delete('nota','id_nota',$nota);  
        }else{
            $this->Admin_m->delete('nota','id_nota',$nota);  
        }
        $pesan = 'Nota berhasil dihapus';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/pembelian'));
    }
    public function delete_order($nota,$id){
        $detail = $this->Admin_m->detail_data_order('menu_to_nota','id_menu_to_nota',$id);
        $menu = $this->Admin_m->detail_data_order('menu','id_menu',$detail->id_menu);
        $updatestrok = array('stok' =>($menu->stok+$detail->jml_menu));
        $this->Admin_m->update('menu','id_menu',$detail->id_menu,$updatestrok);
        $this->Admin_m->delete('menu_to_nota','id_menu_to_nota',$id);
        $pesan = 'Order berhasil dihapus';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/pembelian/nota/'.$nota));
    }
    public function bayar($nota,$total){
        $detail = $this->Admin_m->detail_data_order('nota','id_nota',$nota);
        $daftar_menu = $this->Admin_m->select_all_data_order('menu_to_nota','id_nota',$nota);
        foreach ($daftar_menu as $menu) {
            $data = array('id_status'=>2);
            $this->Admin_m->update('menu_to_nota','id_menu_to_nota',$menu->id_menu_to_nota,$data);

            $ceklaku = $this->Admin_m->cek_barang_laku($menu->id_menu,$detail->tgl_nota);
            if ($ceklaku == TRUE) {
                $upjmlmenulaku = array('jml_laku' => $ceklaku->jml_laku+$menu->jml_menu);
                $this->Admin_m->update('laku_per_hari','id_laku_per_hari',$ceklaku->id_laku_per_hari,$upjmlmenulaku);
            }else{
                $upjmlmenulaku = array(
                    'id_menu' => $menu->id_menu,
                    'tgl_laku' => $detail->tgl_nota,
                    'jml_laku' => $menu->jml_menu,
                );
                $this->Admin_m->create('laku_per_hari',$upjmlmenulaku);
            }
        }
        // update nota
        $notanya = array(
            'id_status' =>2,
            'total_bayar_nota' => $total,
            'jumlah_bayar' => $this->input->post('jumlah_bayar'),
            'kembalian' => $this->input->post('jumlah_bayar') - $total,
        );
        $this->Admin_m->update('nota','id_nota',$nota,$notanya);
        // update penghasilan harian
        $tanggal = $this->Admin_m->detail_data_order('tanggal','kode',$detail->tgl_nota);
        $hasil_hari_ini = array('total' => $tanggal->total+$total,);
        $this->Admin_m->update('tanggal','id_tanggal',$tanggal->id_tanggal,$hasil_hari_ini);

        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/pembelian/nota/'.$nota));
    }
}
?>