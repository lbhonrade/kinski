<?php
class main extends Controller {
	function index(){	
		$this->load->view("main");
	}
	function login(){
		$this->load->model('UserUtil');
		$user=$this->UserUtil->getAcct($_POST);
		session_start();
		if(count($user)>0) $_SESSION["loggedIn"]=$_POST["username"];
		echo json_encode(array(count($user),$_POST["username"]));
	}
	function logout(){
		session_start();
		session_unregister("loggedIn");
	}
	function loadPage($seg1="",$seg2="",$seg3=""){
		session_start();
		if(!isset($_SESSION["loggedIn"])&&$seg1!="HomePage"){
			$this->load->view("unauthorized");
			return;
		}
		$path=$seg1;
		if(strlen($seg2)>0) $path.="/".$seg2;
		if(strlen($seg3)>0) $path.="/".$seg3;
		$this->load->view($path);
	}
	function StdRegistryDB($fxn=-1){
		$this->load->model('CASStdRegistry');
		$this->load->library('table');
		$tmpl = array(
			'table_open'          => '<table class="highlightRow" border="double thin" style="width:100%;" cellpadding="4" cellspacing="0">',
			
			'heading_row_start'   => '<tr>',
			'heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>',
			'heading_cell_end'    => '</th>',

			'row_start'           => '<tr>',
			'row_end'             => '</tr>',
			'cell_start'          => '<td>',
			'cell_end'            => '</td>',

			'row_alt_start'       => '<tr>',
			'row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>',
			'cell_alt_end'        => '</td>',

			'table_close'         => '</table>'
		);
		switch($fxn){
			case 1:print_r($this->CASStdRegistry->addStdReg($_POST));
				break;
			case 2:echo json_encode($this->CASStdRegistry->getStdReg($_POST));
				break;
			case 3:print_r($this->CASStdRegistry->updateStdReg($_POST));
				break;
			case 4:
				break;
			case 5:print_r($this->CASStdRegistry->addSDH($_POST));
				break;
			case 6:$res=$this->CASStdRegistry->getSDH($_POST);
				   foreach($res as $i=>$val){
						switch($res[$i]["Semester"]){
							case 1:$res[$i]["Semester"]="1st";break;
							case 2:$res[$i]["Semester"]="2nd";break;
							case 3:$res[$i]["Semester"]="Summer";break;
						}
				   }
					$this->table->set_heading('Student Number','Semester','AY','Form5','Form5A','Status','Remarks','Date');
					$this->table->set_template($tmpl);
					echo $this->table->generate($res);
				break;
			case 7:echo json_encode($this->CASStdRegistry->getSDH($_POST));
				break;
			case "7.2":print_r($this->CASStdRegistry->updateSDH($_POST));
				break;
			case 8:
				break;
			case 9:print_r($this->CASStdRegistry->addSDT($_POST));
				break;
			case 10:$res=$this->CASStdRegistry->getSDT($_POST);
					foreach($res as $i=>$val){
						switch($res[$i]["Sem"]){
							case 1:$res[$i]["Sem"]="1st";break;
							case 2:$res[$i]["Sem"]="2nd";break;
							case 3:$res[$i]["Sem"]="Summer";break;
						}
					}
					$this->table->set_heading('Student Number','Semester','AY','Case Number','Academic Status','Remarks','Case Status','Date Ordered','Date Effective');
					$this->table->set_template($tmpl);
					echo $this->table->generate($res);
				break;
			case 11:echo json_encode($this->CASStdRegistry->getSDT($_POST));
				break;
			case "11.2":print_r($this->CASStdRegistry->updateSDT($_POST));
				break;
			case 12:
				break;
		}
	}
	function transactionDB($fxn=-1){
		$this->load->model('Win6Transactions');
		$this->load->library('table');
		$tmpl = array(
			'table_open'          => '<table class="highlightRow" border="double thin" style="min-width:1024px;text-align:center" cellpadding="4" cellspacing="0">',
			
			'heading_row_start'   => '<tr>',
			'heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>',
			'heading_cell_end'    => '</th>',

			'row_start'           => '<tr>',
			'row_end'             => '</tr>',
			'cell_start'          => '<td>',
			'cell_end'            => '</td>',

			'row_alt_start'       => '<tr>',
			'row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>',
			'cell_alt_end'        => '</td>',

			'table_close'         => '</table>'
		);
		switch($fxn){
			case 1:print_r($this->Win6Transactions->addTransaction($_POST));
				break;
			case 2:$res=$this->Win6Transactions->getTransactions($_POST);
					if(count($res)==0){
						echo "<div style='text-align:center'>No matching results found.</div>";
						return;
					}
					$this->table->set_heading('','Date In','Name/Unit Who Requested','Student Number','Course/Unit','Indicator','Operation','Code','Count','Signed/Performed By','Received By','Date Out');
					$this->table->set_template($tmpl);
					foreach($res as $i=>$val){
						$id=$res[$i]['Transaction_ID'];
						$res[$i]['Transaction_ID']="<input onclick=\"editTransaction($(this),'".$id."');\" type='button' value='Edit'/><br/><input onclick=\"deleteTransaction($(this),'".$id."');\" type='button' value='Delete'/>";
					}
					echo "<div style='width:100%;overflow-x:scroll'>";
					echo $this->table->generate($res);
					echo "<br/></div>";
				break;
			case "2.1":echo json_encode($this->Win6Transactions->getTransactions($_POST));
				break;
			case 3:print_r($this->Win6Transactions->updateTransaction($_POST));
				break;
			case 4:$this->Win6Transactions->deleteTransaction($_POST);
				break;
		}
	}
}
?>