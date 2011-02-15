<?php
class Win6Transactions extends CI_Model {
	function addTransaction($data){
		$this->load->database("default");
		$this->db->insert("transactions",$data);
		return $data;
	}
	function getTransactions($data,$selectFields="*"){
		$this->load->database("default");
		$this->db->select($selectFields);
		foreach($data as $field=>$val)
			$this->db->where($field,$val);
		return $this->db->get('transactions')->result_array();
	}
	function updateTransaction($data){
		$this->load->database("default");
		foreach($data["primaryKey"] as $field=>$val)
			$this->db->where($field,$val);
		$this->db->update("transactions",$data["nonPrimaryKey"]);
		return $data;
	}
	function deleteTransaction($data){
		$this->load->database("default");
		$this->db->delete("transactions",$data); 
	}
}
?>