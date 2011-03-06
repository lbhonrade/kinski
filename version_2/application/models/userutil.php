<?php
class UserUtil extends CI_Model {
	function getAcct($data){
		$this->load->database("default");
		$this->db->select('*');
		$this->db->where("Username",$data["username"]);
		$this->db->where("Password",md5($data["password"]));
		return $this->db->get('users')->result_array();
	}
	function getEmailPassword($user){
		$this->load->database("default");
		$this->db->select('*');
		$this->db->where("Username",$user);
		$userInfo=$this->db->get('users')->result_array();
		if(count($userInfo)==0) return null;
		if($userInfo[0]["Role"]=="admin") return null;
		$this->db->select('Email_Address');
		$this->db->where("Student_Number",$user);
		$email=$this->db->get($userInfo[0]["Role"])->result_array();
		return array($email[0]["Email_Address"],$userInfo[0]["Password"]);
	}
	function verifyLoginInfo($stdNo,$rawPw){
		$this->load->database("default");
		$this->db->select('*');
		$this->db->where("Username",$stdNo);
		$this->db->where("Password",$rawPw);
		return count($this->db->get('users')->result_array())>0;
	}
	function resetPassword($stdNo,$newPassword){
		$this->load->database("default");
		$this->db->where("Username",$stdNo);
		$this->db->update("users",array("Password"=>$newPassword));
	}
	function getAcctInfo($user){
		$this->load->database("default");
		switch($user["Role"]){
			case "student":$query=$this->db->query("SELECT DegreeName AS Degree,
														   student.*
													FROM student NATURAL JOIN available_degrees
													WHERE Student_Number='".$user["Username"]."' AND Course=DegreeAbbr;")->result_array();
						   return $query[0];
			case "alumni":$this->db->select('*');
						  $this->db->where("Student_Number",$user["Username"]);
						  $alumniInfo=$this->db->get('alumni')->result_array();
						  $query=$this->db->query("SELECT DegreeName AS DP,
														  CASE
															WHEN Semester_Graduated='1' THEN '1st'
															WHEN Semester_Graduated='2' THEN '2nd'
															WHEN Semester_Graduated='S' THEN 'Summer'
														  END AS SG,
														  Year_Graduated AS YG
													FROM alumni_degrees NATURAL JOIN available_degrees
													WHERE Student_Number='".$user["Username"]."' AND Degree=DegreeAbbr;")->result_array();
						  return array_merge($alumniInfo[0],array("Degrees"=>$query));
			case "admin":return array();
		}
	}
	function createNewAccount($type,$info,$user,$degrees=""){
		$this->load->database("default");
		$this->db->insert($type,$info);
		$this->db->insert("pending_users",$user);
		if($type=="alumni"){
			$degreeFields=$this->db->list_fields("alumni_degrees");
			foreach($degrees as $val){
				$this->db->insert("alumni_degrees",array_combine($degreeFields,array_merge(array($info["Student_Number"]),$val)));
			}
		}
	}
	function getUserFields($userTable){
		$this->load->database("default");
		return $this->db->list_fields($userTable);
	}
	function giveAccess($user){
		$this->load->database("default");
		$this->db->select("*");
		$this->db->where("Username",$user);
		$userAcct=$this->db->get('pending_users')->result_array();
		$this->db->insert("users",$userAcct[0]);
		$this->db->delete("pending_users",$userAcct[0]);
	}
	function deleteUser($user){
		$this->load->database("default");
		$role=$user["Role"];
		unset($user["Role"]);
		switch($role){
			case "student": $this->db->delete("pending_users",array("Username"=>$user["Student_Number"]));
							$this->db->delete("student",$user);
							break;
			case "alumni":  $this->db->delete("pending_users",array("Username"=>$user["Student_Number"]));
							$this->db->delete("alumni",$user);
							$this->db->delete("alumni_degrees",$user);
		}
	}
	function changeUserPassword($user,$newPassword){
		$this->load->database("default");
		$this->db->where("Username",$user["Username"]);
		$this->db->where("Password",$user["Password"]);
		$this->db->where("Role",$user["Role"]);
		$this->db->update("users",array("Password"=>$newPassword));
	}
	function updateContactInfo($user,$contactInfo){
		$this->load->database("default");
		$this->db->where("Student_Number",$user["Student_Number"]);
		$this->db->update(strtolower($user["Role"]),$contactInfo);
	}
	function searchUsers($start,$perpage,$key,$tableName){
		$this->load->database("default");
		return $this->db->query(" SELECT Student_Number,Last_Name,First_Name,Middle_Initial,Role
								  FROM (
										(SELECT Student_Number,Last_Name,First_Name,Middle_Initial FROM alumni)
										UNION
										(SELECT Student_Number,Last_Name,First_Name,Middle_Initial FROM student)
										) AS T1
								  JOIN ".$tableName." on Student_Number=Username
								  WHERE  (Username LIKE '%".$key."%' OR Last_Name LIKE '%".$key."%' OR First_Name LIKE '%".$key."%')
								  LIMIT ".$start.",".$perpage.";")->result_array();
	}
	function getTotalPendingUsersCount(){
		$this->load->database("default");
		$count=$this->db->query("SELECT count(Role) AS total FROM pending_users;")->result_array();
		return $count[0]['total'];
	}
	function getTotalUserCount($key,$tableName){
		$this->load->database("default");
		$count=$this->db->query(" SELECT count(Role) AS total
								  FROM (
										(SELECT Student_Number,Last_Name,First_Name,Middle_Initial FROM alumni)
										UNION
										(SELECT Student_Number,Last_Name,First_Name,Middle_Initial FROM student)
										) AS T1
								  JOIN ".$tableName." on Student_Number=Username
								  WHERE  (Username LIKE '%".$key."%' OR Last_Name LIKE '%".$key."%' OR First_Name LIKE '%".$key."%');")->result_array();
		return $count[0]['total'];
	}
}
?>