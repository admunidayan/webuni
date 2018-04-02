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
	public function cek_email($data){
		$this->db->order_by('email','asc');
		$this->db->where('email', $data);
		$query = $this->db->get('users');
		return $query->row();
	}
	public function subpage($id){
		$this->db->where('s_laman', $id);
		$query = $this->db->get('laman');
		return $query->result();
	}
	public function all_kategori(){
		$query = $this->db->get('kategori');
		return $query->result();
	}
	// index dokumen
	function jumlah_doc($string,$tahun,$kat,$ten){
		if (!empty($string)) {
			$this->db->like('nomor_dokumen',$string);
		}
		if (!empty($tahun)) {
			$this->db->like('tahun_dokumen',$tahun);
		}
		if (!empty($kat)) {
			$this->db->where('id_kategori',$kat);
		}
		if (!empty($ten)) {
			$this->db->like('deskripsi_dokumen',$ten);
		}
		return $this->db->get('dokumen')->num_rows();
	}
	public function searcing_data($sampai,$dari,$cari,$tahun,$kat,$ten){
		if (!empty($cari)) {
			$this->db->like('nomor_dokumen',$cari);
		}
		if (!empty($tahun)) {
			$this->db->like('tahun_dokumen',$tahun);
		}
		if (!empty($kat)) {
			$this->db->where('id_kategori',$kat);
		}
		if (!empty($ten)) {
			$this->db->like('deskripsi_dokumen',$ten);
		}
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get('dokumen',$sampai,$dari);
		return $query->result();
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
	function jml_pilih($id){		
		$this->db->where('pilihan',$id);
		return $this->db->get('pilihan')->num_rows();
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
	// baru
	public function pimpinan(){
		$query = $this->db->get('pimpinan_pt');
		return $query->result();
	}
	public function linkgambar(){
		$this->db->where('id_kategori_link',1);
		$query = $this->db->get('link');
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
	// calon peserta
	function input_data_calon($data){
		$this->db->insert('calon_mhs', $data);
	}
	public function last_id(){
		$this->db->order_by('id_mhs','desc');
		$query = $this->db->get('calon_mhs');
		return $query->row();
	}
	public function data_calon_peserta($id){
		$this->db->where('id_mhs',$id);
		$query = $this->db->get('calon_mhs');
		return $query->row();
	}
	public function listagama(){
		$query = $this->db->get('agama');
		return $query->result();
	}
	public function dttgl(){
		$query = $this->db->get('jenis_tinggal');
		return $query->result();
	}
	public function pekerjaan(){
		$query = $this->db->get('pekerjaan');
		return $query->result();
	}
	public function penghasilan(){
		$query = $this->db->get('penghasilan');
		return $query->result();
	}
	public function pendidikan(){
		$query = $this->db->get('jenjang_pend');
		return $query->result();
	}
	public function wilayah(){
		$this->db->where('id_level_wil', 1);
		$this->db->order_by('nm_wil', 'asc');
		$query = $this->db->get('data_wilayah');
		return $query->result();
	}
	function input_form_2($data,$id){
		$this->db->where('id_mhs',$id);
		$this->db->update('calon_mhs', $data);
	}
	function edituser($data,$id){
		$this->db->where('id',$id);
		$this->db->update('users', $data);
	}
	function upload_img_konfirmasi($data,$id){
		$this->db->where('id_mhs',$id);
		$this->db->update('calon_mhs', $data);
	}
	function update_data_calon($id,$data){
		$this->db->where('id_mhs',$id);
		$this->db->update('calon_mhs', $data);
	}
	public function pilih_jurusan1($tipe){
		if ($tipe !== '3') {
			$this->db->where('type',$tipe);
		}
		$this->db->where('grup',1);
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$this->db->order_by('nama_prodi', 'asc');
		$query = $this->db->get('prodi');
		return $query->result();
	}
	public function pilih_jurusan2($tipe){
		if ($tipe !== '3') {
			$this->db->where('type',$tipe);
		}
		$this->db->where('grup',2);
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$this->db->order_by('nama_prodi', 'asc');
		$query = $this->db->get('prodi');
		return $query->result();
	}
	function input_form_3($data){
		$this->db->insert('pilihan', $data);
	}
	public function provinsi(){
		$this->db->where('id_level_wil', 1);
		$query = $this->db->get('data_wilayah');
		return $query->result();
	}
	public function getProv()
	{
	$this->db->order_by('nama','asc');
    $query = $this->db->get('provinsi');
    return $query->result();
	}

	public function getKab($id_prov)
	{
	  $this->db->where('id_prov', $id_prov);
	  $this->db->order_by('nama','asc');
		$query = $this->db->get('kabupaten');
		return $query->result();
	}
	public function cekpilihan($id,$pilihan){
		$this->db->where('id_mhs', $id);
		$this->db->where('pilihan', $pilihan);
		$query = $this->db->get('pilihan');
		return $query->row();
	}
	public function jur_pil($id){
		$this->db->join('prodi', 'prodi.id_prodi = pilihan.pilihan');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$this->db->where('id_mhs', $id);
		$query = $this->db->get('pilihan');
		return $query->result();
	}
	function edit_data_diri($id,$data){
		$this->db->where('id_mhs',$id);
		$this->db->update('calon_mhs', $data);
	}
	function edit_input_form_3($id,$data){
		$this->db->where('id_mhs',$id);
		$this->db->update('pilihan', $data);
	}
	 public function jumlah_pilihan($id){
	 $this->db->where('id_mhs', $id);
	 $query = $this->db->get('pilihan');
	 return $query->num_rows();
	}
	function hapus_pilihan($id){
		$this->db->where('id_pilihan', $id);
		$this->db->delete('pilihan');
	}
	public function provbyid($id){
		$this->db->where('id_prov', $id);
		$query = $this->db->get('provinsi');
		return $query->row();
	}
	public function detail_agama($id){
		$this->db->where('id_agama', $id);
		$query = $this->db->get('agama');
		return $query->row();
	}
	public function kotabyid($id){
		$this->db->where('id_kab', $id);
		$query = $this->db->get('kabupaten');
		return $query->row();
	}
}
