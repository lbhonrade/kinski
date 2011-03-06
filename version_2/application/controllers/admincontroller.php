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
	function displayUsers($start='0'){
		$status=array("approved"=>"users","pending"=>"pending_users");
		$this->load->model("UserUtil");
		$this->load->library('table');
		$this->load->helper('url');
		session_start();
		if($start=='0'){
			$_SESSION["key"]=$_POST["key"];
			$_SESSION["total_Users"]=$this->UserUtil->getTotalUserCount($_SESSION["key"],$status[$_POST["status"]]);
		}
		if($_SESSION["total_Users"]==0){
			echo "<h2 style='text-align:center'>No results found.</h2>";
			exit;
		}
		$users=$this->UserUtil->searchUsers($start,'15',$_SESSION["key"],$status[$_POST["status"]]);
		$tmpl = array(
			'table_open'          => '<table id="'.$_POST["status"].'AcctsTable" class="highlightRow" style="text-align:center;" cellpadding="4" cellspacing="2">',
			
			'heading_row_start'   => '<tr>','heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>','heading_cell_end'    => '</th>',

			'row_start'           => '<tr>','row_end'             => '</tr>',
			'cell_start'          => '<td style="border:1px solid #000;padding:2px;">','cell_end'            => '</td>',

			'row_alt_start'       => '<tr>','row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td style="border:1px solid #000;padding:2px;">','cell_alt_end'        => '</td>',

			'table_close'         => '</table>'
		);
		$this->table->set_heading('Student Number','Last Name','First Name','Middle Initial','Role');
		$this->table->set_template($tmpl);
		
		$this->load->library('pagination');

		$config['base_url'] = base_url()."index.php/AdminController/displayUsers/";
		$config['total_rows'] = $_SESSION["total_Users"];
		$config['per_page'] = '15';
		$config['num_links'] = 20;
		$config['cur_tag_open'] = '<a class="cur_page">';
		$config['cur_tag_close'] = '</a>';
		$config['prev_link'] = 'Previous';
		$config['next_link'] = 'Next';
		
		$this->pagination->initialize($config); 
		echo $this->table->generate($users);
		echo "<div id='pageLinks' style='display:none;visibility:hidden;'>";
		echo $this->pagination->create_links();
		echo "</div>";
	}
	function loadPendingAcctsManager(){
		$this->load->view("AccountManagement/PendingAcctsManagerUI",$_POST);
	}
	function loadUserAcctsManager(){
		$this->load->view("AccountManagement/UserAcctsManagerUI");
	}
}
?>