<?php
class Report extends CI_Model {
	function getReport(){
		$this->load->database("default");
		$this->db->select("Transaction_Number,Date_In");		
		return $this->db->get('transactions')->result_array();
	}
}
?>
