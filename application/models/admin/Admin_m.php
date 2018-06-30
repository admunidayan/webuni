<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_m extends CI_Model
{
	public function info_pt($id){
		$this->db->where('id_info_pt', $id);
		$query = $this->db->get('info_pt');
		return $query->row();
	}
	public function cek_pt($id){
		$this->db->where('id_info_pt', $id);
		$query = $this->db->get('info_pt');
		return $query;
	}
	public function cek_barang_laku($menu,$tgl){
		$this->db->where('id_menu', $menu);
		$this->db->where('tgl_laku', $tgl);
		$query = $this->db->get('laku_per_hari');
		return $query->row();
	}
	public function Update_pt($id,$data){
		$this->db->where('id_info_pt', $id);
		$this->db->update('info_pt',$data);
	}
	public function all_link(){
		$this->db->join('kategori_link', 'kategori_link.id_kategori_link = link.id_kategori_link');
		$query = $this->db->get('link');
		return $query->result();
	}
	public function all_kat_link(){
		$query = $this->db->get('kategori_link');
		return $query->result();
	}
	public function detail_link($id){
		$this->db->join('kategori_link', 'kategori_link.id_kategori_link = link.id_kategori_link');
		$this->db->where('id_link', $id);
		$query = $this->db->get('link');
		return $query->row();
	}
	public function detail_kategori_link($id){
		$this->db->where('id_kategori_link', $id);
		$query = $this->db->get('kategori_link');
		return $query->row();
	}
	function insert_link($data){
		$this->db->insert('link', $data);
	}
	function insert_kategori_link($data){
		$this->db->insert('kategori_link', $data);
	}
	function update_link($id,$data){
		$this->db->where('id_link',$id);
		$this->db->update('link', $data);
	}
	function update_kategori_link($id,$data){
		$this->db->where('id_kategori_link',$id);
		$this->db->update('kategori_link', $data);
	}
	public function delete_link($id){
		$this->db->where('id_link', $id);
		$this->db->delete('link');
	}
	public function cek_link_by_katelink($id){
		$this->db->where('id_kategori_link', $id);
		$query = $this->db->get('link');
		return $query->result();
	}
	public function delete_kategori_link($id){
		$this->db->where('id_kategori_link', $id);
		$this->db->delete('kategori_link');
	}
	// 
	public function select_all_data($table){
		$query = $this->db->get($table);
		return $query->result();
	}
	public function select_all_data_order($table,$field,$id){
		$this->db->where($field, $id);
		$query = $this->db->get($table);
		return $query->result();
	}
	public function select_all_data_bulan($bulan){
		$this->db->like('kode', $bulan);
		$query = $this->db->get('tanggal');
		return $query->result();
	}
	public function detail_data($table,$field,$id){
		$this->db->where($field, $id);
		$query = $this->db->get($table);
		return $query->result();
	}
	public function detail_data_order($table,$field,$id){
		$this->db->where($field, $id);
		$query = $this->db->get($table);
		return $query->row();
	}
	public function select_barang_laku($id){
		$this->db->select('laku_per_hari.*,menu.id_menu,menu.nama_menu');
		$this->db->where('tgl_laku',$id);
		$this->db->join('menu', 'menu.id_menu = laku_per_hari.id_menu');
		$query = $this->db->get('laku_per_hari');
		return $query->result();
	}
	public function detail_obat($id){
		$this->db->where('menu.id_menu', $id);
		$this->db->join('kategori', 'kategori.id_kategori = menu.id_kategori');
		$query = $this->db->get('menu');
		return $query->row();
	}
	public function detail_data_nota($id){
		$this->db->where('nota.id_nota', $id);
		$this->db->join('status', 'status.id_status = nota.id_status');
		$this->db->join('users', 'users.id = nota.id_user');
		$query = $this->db->get('nota');
		return $query->row();
	}
	public function list_data_beli($nota){
		$this->db->where('menu_to_nota.id_nota',$nota);
		$this->db->join('menu', 'menu.id_menu = menu_to_nota.id_menu');
		$query = $this->db->get('menu_to_nota');
		return $query->result();
	}
	public function list_obat(){
		$this->db->join('kategori', 'kategori.id_kategori = menu.id_kategori');
		$query = $this->db->get('menu');
		return $query->result();
	}
	public function list_pembelian_hari_ini($tgl){
		$this->db->where('tgl_nota',$tgl);
		$this->db->join('status', 'status.id_status = nota.id_status');
		$this->db->join('users', 'users.id = nota.id_user');
		$this->db->order_by('nota.id_nota','desc');
		$query = $this->db->get('nota');
		return $query->result();
	}
	public function lastid($table,$field){
		$this->db->order_by($field, 'desc');
		$query = $this->db->get($table);
		return $query->row();
	}
	function create($table,$data){
		$this->db->insert($table,$data);
	}
	function update($table,$field,$id,$data){
		$this->db->where($field,$id);
		$this->db->update($table,$data);
	}
	function delete($table,$field,$id){
		$this->db->where($field, $id);
		$this->db->delete($table);
	}
	function count_data_menu($string,$kat){
		if (!empty($string)) {
			$this->db->like('nama_menu',$string);
			$this->db->or_like('kode_menu',$string);
		}
		if (!empty($kat)) {
			$this->db->where('menu.id_kategori',$kat);
		}
		return $this->db->get('menu')->num_rows();
	}
	public function select_all_data_menu($sampai,$dari,$string,$kat){
		if (!empty($string)) {
			$this->db->like('nama_menu',$string);
			$this->db->or_like('kode_menu',$string);
		}
		if (!empty($kat)) {
			$this->db->where('menu.id_kategori',$kat);
		}
		$this->db->join('kategori', 'kategori.id_kategori = menu.id_kategori');
		$this->db->order_by('nama_menu','asc');
		$query = $this->db->get('menu',$sampai,$dari);
		return $query->result();
	}
	function count_data_info($string){
		if (!empty($string)) {
			$this->db->like('judul_info_kampus',$string);
		}
		return $this->db->get('info_kampus')->num_rows();
	}
	public function select_all_data_info($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('judul_info_kampus',$string);
		}
		$this->db->order_by('id_info_kampus','desc');
		$query = $this->db->get('info_kampus',$sampai,$dari);
		return $query->result();
	}
	function count_data_video($string){
		if (!empty($string)) {
			$this->db->like('judul_video',$string);
		}
		return $this->db->get('video')->num_rows();
	}
	public function select_all_data_video($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('judul_video',$string);
		}
		$this->db->order_by('id_video','desc');
		$query = $this->db->get('video',$sampai,$dari);
		return $query->result();
	}
	function count_data_laman($string){
		if (!empty($string)) {
			$this->db->like('judul_laman',$string);
		}
		return $this->db->get('laman')->num_rows();
	}
	public function select_all_data_laman($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('judul_laman',$string);
		}
		$this->db->order_by('id_laman','desc');
		$query = $this->db->get('laman',$sampai,$dari);
		return $query->result();
	}
	function count_data_galeri($string){
		if (!empty($string)) {
			$this->db->like('nama_galeri',$string);
		}
		return $this->db->get('galeri')->num_rows();
	}
	public function select_all_data_galeri($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('nama_galeri',$string);
		}
		$this->db->order_by('id_galeri','desc');
		$query = $this->db->get('galeri',$sampai,$dari);
		return $query->result();
	}
	function count_data_link($string){
		if (!empty($string)) {
			$this->db->like('nama_link',$string);
		}
		return $this->db->get('link')->num_rows();
	}
	public function select_all_data_link($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('nama_link',$string);
		}
		$this->db->order_by('id_link','desc');
		$query = $this->db->get('link',$sampai,$dari);
		return $query->result();
	}
	function count_data_dokumen($string){
		if (!empty($string)) {
			$this->db->like('nama_dokumen',$string);
		}
		return $this->db->get('dokumen')->num_rows();
	}
	public function select_all_data_dokumen($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('nama_dokumen',$string);
		}
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get('dokumen',$sampai,$dari);
		return $query->result();
	}
	function count_data_member($string){
		if (!empty($string)) {
			$this->db->like('nm_member',$string);
			$this->db->or_like('kode_member',$string);
		}
		return $this->db->get('member')->num_rows();
	}
	function count_data_artikel($string){
		if (!empty($string)) {
			$this->db->like('jdl_artikel',$string);
		}
		return $this->db->get('artikel')->num_rows();
	}
	public function select_all_data_member($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('nm_member',$string);
			$this->db->or_like('kode_member',$string);
		}
		$this->db->order_by('kode_member','desc');
		$query = $this->db->get('member',$sampai,$dari);
		return $query->result();
	}
	public function select_all_data_artikel($sampai,$dari,$string){
		if (!empty($string)) {
			$this->db->like('jdl_artikel',$string);
		}
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->order_by('id_artikel','desc');
		$query = $this->db->get('artikel',$sampai,$dari);
		return $query->result();
	}
	public function detail_artikel($id){
		$this->db->where('id_artikel',$id);
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$query = $this->db->get('artikel');
		return $query->row();
	}
}
