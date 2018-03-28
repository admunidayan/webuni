<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Info_m extends CI_Model {

	function jumlah($string){
		if (!empty($string)) {
			$this->db->like('judul_info_kampus',$string);
		}
		return $this->db->get('info_kampus')->num_rows();
	}
	public function searcing_data($sampai,$dari,$cari){
		if (!empty($cari)) {
			$this->db->like('judul_info_kampus',$cari);
		}
		$this->db->order_by('id_info_kampus','desc');
		$query = $this->db->get('info_kampus',$sampai,$dari);
		return $query->result();
	}
	public function getallinfo(){
		$this->db->select('*');
    $this->db->from('info_kampus');
		$sdf = $this->db->get();
		return $sdf->result();
	}
	public function detailinfo($id){
		$this->db->select('*');
    $this->db->from('info_kampus');
		$this->db->where('id_info_kampus', $id);
		$sdf = $this->db->get();
		return $sdf->row();
	}
	public function update_info($id, $data){
		$this->db->where('id_info_kampus', $id);
		$this->db->update('info_kampus', $data);
	}
	function insert_info($data){
		$this->db->insert('info_kampus', $data);
	}
	public function delete_info($id){
		$this->db->where('id_info_kampus', $id);
		$this->db->delete('info_kampus');
	}
}
