<?php
class UserUtil extends CI_Model {
	function getAcct($data){
		$this->load->database("default");
		$this->db->select('*');
		$this->db->where("username",$data["username"]);
		$this->db->where("password",md5($data["password"]));
		return $this->db->get('userdata')->result_array();
	}
}
?>