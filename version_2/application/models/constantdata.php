<?php
class ConstantData extends CI_Model {
	function getAvailableCourses(){
		$this->load->database("default");
		$this->db->select('*');
		return $this->db->get('available_degrees')->result_array();
	}
}
?>