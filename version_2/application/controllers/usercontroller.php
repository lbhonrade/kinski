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
	function loadPendingAcctsManager(){
		$this->load->model("UserUtil");
		$pendingAccts=$this->UserUtil->getPendingAccts();
		$this->load->library('table');
		$tmpl = array(
			'table_open'          => '<table id="pendingAcctsTable" class="highlightRow" style="text-align:center;" cellpadding="4" cellspacing="2">',
			
			'heading_row_start'   => '<tr>','heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>','heading_cell_end'    => '</th>',

			'row_start'           => '<tr>','row_end'             => '</tr>',
			'cell_start'          => '<td style="border:1px solid #000;padding:2px;">','cell_end'            => '</td>',

			'row_alt_start'       => '<tr>','row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td style="border:1px solid #000;padding:2px;">','cell_alt_end'        => '</td>',

			'table_close'         => '</table>'
		);
		$this->table->set_heading('Student Number','Role');
		$this->table->set_template($tmpl);
		$_POST["pendingAccts"]=$this->table->generate($pendingAccts);
		$this->load->view("AccountManagement/PendingAcctsManagerUI",$_POST);
	}
	function loadUserAcctsManager(){
		$this->load->view("AccountManagement/UserAcctsManagerUI");
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