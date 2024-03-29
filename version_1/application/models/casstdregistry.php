<?php
class CASStdRegistry extends CI_Model {
	function addStdReg($data){
		$this->load->database("default");
		$this->db->insert("sbasic",$data["BasicInfo"]);
		if(isset($data["PerSemester"])&&is_array($data["PerSemester"]))
			foreach($data["PerSemester"] as $sem){
				$this->db->insert("sgwapersem",array_merge($sem,array("Student_Number"=>$data["BasicInfo"]["Student_Number"])));	
			}
		return $data;
	}
	function getStdReg($stdno){
		$this->load->database("default");
		$this->db->select('*');
		$this->db->where('Student_Number',$stdno["Student_Number"]);
		$profile=$this->db->get('sbasic')->result_array();
		$this->db->select('Semester,AY,GWA,Status');
		$this->db->where('Student_Number',$stdno["Student_Number"]);
		$profile[]=$this->db->get('sgwapersem')->result_array();
		return $profile;
	}
	function searchStdReg($data,$selectFields){
		$this->load->database("default");
		$this->db->select($selectFields);
		foreach($data as $field=>$val)
			$this->db->where($field,$val);
		return $this->db->get('sbasic')->result_array();
	}
	function delGWAPerSem($stdNo){
		$this->db->delete('sgwapersem', array('Student_Number' => $stdNo)); 
	}
	function updateStdReg($data){
		$this->load->database("default");
		$stdNo=$data["BasicInfo"]["Student_Number"];
		unset($data["BasicInfo"]["Student_Number"]);
		$this->db->where("Student_Number",$stdNo);
		$this->db->update("sbasic",$data["BasicInfo"]);
		$this->delGWAPerSem($stdNo);
		if(isset($data["PerSemester"])&&is_array($data["PerSemester"]))
			foreach($data["PerSemester"] as $sem){
				$this->db->insert("sgwapersem",array_merge($sem,array("Student_Number"=>$stdNo)));	
			}
		return $data;
	}
	function delStdReg($data){
		$this->load->database('default');
		$this->db->where('Student_Number', $data['Student_Number']);
		$this->db->delete('sbasic');
		$this->delGWAPerSem($data['Student_Number']);
	}
	function addSDH($data){
		$this->load->database("default");
		$this->db->insert("sdeli",$data);
		return $data;
	}
	function getSDH($data){
		$this->load->database("default");
		$this->db->select('*');
		foreach($data as $field=>$val)
			$this->db->where($field,$val);
		return $this->db->get('sdeli')->result_array();
	}
	function updateSDH($data){
		$this->load->database("default");
		foreach($data["primaryKey"] as $field=>$val)
			$this->db->where($field,$val);
		$this->db->update("sdeli",$data["nonPrimaryKey"]);
		return $data;
	}
	function delSDH($data){
		$this->load->database();
		$this->db->where('Student_Number', $data['Student_Number']);
		$this->db->where('Semester', $data['Semester']);
		$this->db->where('AY', $data['AY']);
		$this->db->delete('sdeli');
	}
	function addSDT($data){
		$this->load->database("default");
		$this->db->insert("ssdt",$data);
		return $data;
	}
	function getSDT($data){
		$this->load->database("default");
		$this->db->select('*');
		foreach($data as $field=>$val)
			$this->db->where($field,$val);
		return $this->db->get('ssdt')->result_array();
	}
	function updateSDT($data){
		$this->load->database("default");
		foreach($data["primaryKey"] as $field=>$val)
			$this->db->where($field,$val);
		$this->db->update("ssdt",$data["nonPrimaryKey"]);
		return $data;
	}
	function delSDT($data){
		$this->load->database("default");
		foreach($data as $field=>$val)
			$this->db->where($field,$val);
		$this->db->delete('ssdt');
	}
}
?>