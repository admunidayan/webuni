<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_m extends CI_Model
{
	function jumlah($string){
		if (!empty($string)) {
			$this->db->like('nama_users',$string);
		}
		return $this->db->get('users')->num_rows();
	}
	public function searcing_data($sampai,$dari,$cari){
		if (!empty($cari)) {
			$this->db->like('first_name',$cari);
			$this->db->or_like('last_name',$cari);
		}
		$query = $this->db->get('users',$sampai,$dari);
		return $query->result();
	}
	function insert_users($data){
		$this->db->insert('users', $data);
	}
	function update_users($id,$data){
		$this->db->where('id',$id);
		$this->db->update('users', $data);
	}
	public function detail_users($id){
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->row();
	}
	public function cek_users($id){
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->row();
	}
	public function delete_users($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}
}
