<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_m extends CI_Model {

	public function getuser($id_user){

		$this->db->where("id_user", $id_user);
		$sdf = $this->db->get('user');
		return $sdf->row();
	}
}
