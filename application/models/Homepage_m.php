<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Homepage_m extends CI_Model
{
	public function info_pt($id){
		$this->db->where('id_info_pt', $id);
		$query = $this->db->get('info_pt');
		return $query->row();
	}
	public function all_laman(){
		$this->db->select('judul_laman,alias_laman,id_laman,s_laman,link');
		$this->db->where('status_laman', 'publish');
		$this->db->where('s_laman', '0');
		$query = $this->db->get('laman');
		return $query->result();
	}
	public function ceksubpage($id){
		$this->db->where('id_laman', $id);
		$query = $this->db->get('laman');
		return $query->row();
	}
	public function subpage($id){
		$this->db->where('s_laman', $id);
		$this->db->where_not_in('s_laman', 0);
		$query = $this->db->get('laman');
		return $query->result();
	}
	public function all_kategori(){
		$query = $this->db->get('kategori');
		return $query->result();
	}
	public function kadok(){
		$query = $this->db->get('kategori_dokumen');
		return $query->result();
	}
	// Indek artikel
	public function get_all_artikel($sampai,$dari,$cari){
		if (!empty($cari)) {
			$this->db->like('nomor_dokumen',$cari);
		}
		$this->db->order_by('id_artikel','desc');
		$query = $this->db->get('artikel',$sampai,$dari);
		return $query->result();
	}
	// index dokumen
	function jumlah_doc($string,$tahun,$kat){
		if (!empty($string)) {
			$this->db->like('nomor_dokumen',$string);
		}
		if (!empty($tahun)) {
			$this->db->like('tahun_dokumen',$tahun);
		}
		if (!empty($kat)) {
			$this->db->where('id_kategori',$kat);
		}
		return $this->db->get('dokumen')->num_rows();
	}
	public function searcing_data($sampai,$dari,$cari,$tahun,$kat){
		if (!empty($cari)) {
			$this->db->like('nomor_dokumen',$cari);
		}
		if (!empty($tahun)) {
			$this->db->like('tahun_dokumen',$tahun);
		}
		if (!empty($kat)) {
			$this->db->where('id_kategori',$kat);
		}
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get('dokumen',$sampai,$dari);
		return $query->result();
	}
	// index dokumen
	function jumlah_dokumen($string){
		if (!empty($string)) {
			$this->db->like('nomor_dokumen',$string);
		}
		return $this->db->get('dokumen')->num_rows();
	}
	public function searcing_data_doc($sampai,$dari,$cari){
		if (!empty($cari)) {
			$this->db->like('nomor_dokumen',$cari);
		}
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get('dokumen',$sampai,$dari);
		return $query->result();
	}
	// kategori dokumen
	function jumlah_kadok($string){
		if (!empty($string)) {
			$this->db->like('nama_kategori_dokumen',$string);
		}
		$this->db->where('id_kategori',$string);
		return $this->db->get('dokumen')->num_rows();
	}
	public function searcing_data_kategori_dokumen($sampai,$dari,$alias,$cari){
		if (!empty($cari)) {
			$this->db->like('nama_kategori_dokumen',$cari);
		}
		$this->db->where('id_kategori',$alias);
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get('dokumen',$sampai,$dari);
		return $query->result();
	}
	public function idkadok($alias){
		$this->db->where('alias_kategori_dokumen',$alias);
		$query = $this->db->get('kategori_dokumen');
		return $query->row();
	}
	// laman
	public function get_laman($alias){
		$this->db->where('alias_laman',$alias);
		$query = $this->db->get('laman');
		return $query->row();
	}
	public function get_id_kat($alias){
		$this->db->select('id_kategori');
		$this->db->where('alias_kategori',$alias);
		$query = $this->db->get('kategori');
		return $query->row();
	}
	// kategori
	function jumlah_doc_kat($id){		
		$this->db->where('id_kategori',$id);
		return $this->db->get('dokumen')->num_rows();
	}
	public function searcing_data_kat($sampai,$dari,$id){
		$this->db->where('id_kategori',$id);
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get('dokumen',$sampai,$dari);
		return $query->result();
	}
	// artikel 
	function jumlah_artikel($string){
		if (!empty($string)) {
			$this->db->like('judul_artikel',$string);
		}
		return $this->db->get('artikel')->num_rows();
	}
	public function artike_home(){
		$this->db->order_by('id_artikel','desc');
		$query = $this->db->get('artikel',3,0);
		return $query->result();
	}
	public function get_artikel($alias){
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->where('alias_artikel',$alias);
		$query = $this->db->get('artikel');
		return $query->row();
	}
	public function all_artikel($sampai,$dari,$cari){
		if (!empty($cari)) {
			$this->db->like('judul_artikel',$cari);
		}
		$this->db->order_by('id_artikel','desc');
		$query = $this->db->get('artikel',$sampai,$dari);
		return $query->result();
	}
	public function dokumen_home(){
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get('dokumen',8,0);
		return $query->result();
	}
	public function linkgambar(){
		$this->db->where('id_kategori_link',1);
		$query = $this->db->get('link');
		return $query->result();
	}
	public function info(){
		$this->db->order_by('id_info_kampus','desc');
		$this->db->limit(0,5);
		$query = $this->db->get('info_kampus');
		return $query->result();
	}
	public function linkbykateg(){
		$this->db->where_not_in('id_kategori_link',1);
		$query = $this->db->get('kategori_link');
		return $query->result();
	}
	public function isilinkbykateg($id){
		$this->db->where_not_in('id_kategori_link',1);
		$this->db->where('id_kategori_link',$id);
		$query = $this->db->get('link');
		return $query->result();
	}
}
