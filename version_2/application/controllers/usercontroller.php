<?php
class UserController extends CI_Controller {
	function ViewUserAccount(){
		session_start();
		if(!isset($_SESSION["loggedIn"])){
			$this->load->view("unauthorized");
			return;
		}
		$this->load->view("AccountManagement/".$_SESSION["loggedIn"]["Role"]."_account_settings");
	}
	function createPendingAccount($type=""){
		$this->load->model("UserUtil");
		$pw=md5($_POST[0]);
		unset($_POST[0]);
		$type=strtolower($type);
		switch($type){
			case "student": $studentInfo=array_combine($this->UserUtil->getUserFields($type),$_POST);
							$userInfo=array_combine($this->UserUtil->getUserFields("pending_users"),array($studentInfo["Student_Number"],$pw,$type));
							$this->UserUtil->createNewAccount($type,$studentInfo,$userInfo);
							break;
			case "alumni":	$degrees=$_POST[1];
							unset($_POST[1]);
							$alumniInfo=array_combine($this->UserUtil->getUserFields($type),$_POST);
							$userInfo=array_combine($this->UserUtil->getUserFields("pending_users"),array($alumniInfo["Student_Number"],$pw,$type));
							$this->UserUtil->createNewAccount($type,$alumniInfo,$userInfo,$degrees);
		}
		echo "Account Sent. Please Wait for Approval.";
	}
	function changePassword(){
		session_start();
		if($_SESSION["loggedIn"]["Password"]!=md5($_POST['current_password'])) echo "Current Password does not match.";
		else{
			$this->load->model("UserUtil");
			$this->UserUtil->changeUserPassword($_SESSION["loggedIn"],md5($_POST['new_password']));
			$_SESSION["loggedIn"]["Password"]=md5($_POST['new_password']);
			echo "Password changed successfully.";
		}
	}
	function resetPassword($stdNo="",$rawPw="",$newPw=""){
		$this->load->model('UserUtil');
		if($newPw!=""){
			session_start();
			if(isset($_SESSION["resetLoggedIn"])){
				$this->UserUtil->resetPassword($_SESSION["resetLoggedIn"][0],md5($newPw));
				unset($_SESSION["resetLoggedIn"]);
				echo "Successfully Reset.";
				return;
			}
		}else if($this->UserUtil->verifyLoginInfo($stdNo,$rawPw)){
			session_start();
			$_SESSION["resetLoggedIn"]=array($stdNo,$rawPw);
			$this->load->view("AccountManagement/ResetPasswordUI");
			return;
		}
		$this->load->view("unauthorized");
	}
	function updateContactInfo(){
		session_start();
		$this->load->model("UserUtil");
		$fields=$this->UserUtil->getUserFields(strtolower($_SESSION["loggedIn"]["Role"]));
		$contact=array();
		foreach($_POST as $i=>$val) $contact[$fields[$i]]=$val;
		$this->UserUtil->updateContactInfo($_SESSION["loggedIn"],$contact);
		$_SESSION["loggedIn"]=array_merge($_SESSION["loggedIn"],$contact);
		echo "Changes in contacts were saved.";
	}
}
?>