<?php
class AdminController extends CI_Controller {
	function approveUser(){
		$this->load->model("UserUtil");
		$this->UserUtil->giveAccess($_POST["user"]);
		echo "Pending User Approved!";
	}
	function disapproveUser(){
		$this->load->model("UserUtil");
		$this->UserUtil->deleteUser(array_combine(array("Student_Number","Role"),$_POST));
		echo "Pending User Deleted.";
	}
	function viewUserProfile(){
		$this->load->model("UserUtil");
		$profile=$this->UserUtil->getAcctInfo(array_combine(array("Username","Role"),$_POST));
		if($_POST["role"]=="student"){
			unset($profile["Course"]);
			$profile=array_combine(array(4,0,1,2,3,5,6,7,8),$profile);
		}else if($_POST["role"]=="alumni"){
			$profile=array_combine(array(0,1,2,3,5,6,7,8,9,4),$profile);		
		}
		echo json_encode($profile);
	}
}
?>