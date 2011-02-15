<?php
class main extends CI_Controller {
	function index(){	
		$this->load->view("main");
		/*
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->view("validationtest");
		//*/
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
		$this->load->view($path,$_POST);
	}
	function StdRegistryDB($fxn=-1){
		$this->load->model('CASStdRegistry');
		$this->load->library('table');
		$tmpl = array(
			'table_open'          => '<table class="highlightRow" border="double thin" style="text-align:center" cellpadding="4" cellspacing="0">',
			
			'heading_row_start'   => '<tr>','heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>','heading_cell_end'    => '</th>',

			'row_start'           => '<tr>','row_end'             => '</tr>',
			'cell_start'          => '<td>','cell_end'            => '</td>',

			'row_alt_start'       => '<tr>','row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>','cell_alt_end'        => '</td>',

			'table_close'         => '</table>'
		);
		switch($fxn){
			case 1:print_r($this->CASStdRegistry->addStdReg($_POST));
				break;
			case 2:echo json_encode($this->CASStdRegistry->getStdReg($_POST));
				break;
			case "2.1":$res=$this->CASStdRegistry->searchStdReg($_POST,"Student_Number,Last_Name,First_Name,Middle_Initial,Course");
						if(count($res)==0){
							echo "<div style='text-align:center'>No matching results found.</div>";
							return;
						}
						?>
						<script type="text/javascript">searchResult=<?php echo json_encode($res); ?></script>
						<?php
						$this->table->set_heading('','Student Number','Last Name','First Name','Middle Initial','Course');
						$this->table->set_template($tmpl);
						foreach($res as $i=>$val){
							$res[$i]=array_merge(array('<input onclick=\'loadFunctionUI($(this),"StudentRegistry/edit",2,'.$i.')\' type="button" value="Edit"/><br/><input onclick=\'deleteData($(this),'.$i.',4);\' type="button" value="Delete"/>'),$res[$i]);
						}
						echo "<div style='width:100%;overflow-x:scroll'>";
						echo $this->table->generate($res);
						echo "<br/></div>";
				break;
			case 3:print_r($this->CASStdRegistry->updateStdReg($_POST));
				break;
			case 4:print_r($this->CASStdRegistry->delStdReg($_POST));
				break;
			case 5:print_r($this->CASStdRegistry->addSDH($_POST));
				break;
			case 6:$res=$this->CASStdRegistry->getSDH($_POST);
					if(count($res)==0){
						echo "<div style='text-align:center'>No matching results found.</div>";
						return;
					}
					?>
					<script type="text/javascript">searchResult=<?php echo json_encode($res); ?></script>
					<?php
					foreach($res as $i=>$val){
						$res[$i]=array_merge(array('<input onclick=\'loadFunctionUI($(this),"DelinquencyHistory/edit",2,'.$i.')\' type="button" value="Edit"/><br/><input onclick=\'deleteData($(this),'.$i.',8);\' type="button" value="Delete"/>'),$res[$i]);
					}
					foreach($res as $i=>$val){
						switch($res[$i]["Semester"]){
							case 1:$res[$i]["Semester"]="1st";break;
							case 2:$res[$i]["Semester"]="2nd";break;
							case 3:$res[$i]["Semester"]="Summer";break;
						}
					}
					$this->table->set_heading('','Student Number','Semester','AY','Form5','Form5A','Status','Remarks','Date');
					$this->table->set_template($tmpl);
					echo "<div style='width:100%;overflow-x:scroll'>";
					echo $this->table->generate($res);
					echo "<br/></div>";
				break;
			case 7:echo json_encode($this->CASStdRegistry->getSDH($_POST));
				break;
			case "7.2":print_r($this->CASStdRegistry->updateSDH($_POST));
				break;
			case 8:print_r($this->CASStdRegistry->delSDH($_POST));
				break;
			case 9:print_r($this->CASStdRegistry->addSDT($_POST));
				break;
			case 10:$res=$this->CASStdRegistry->getSDT($_POST);
					if(count($res)==0){
						echo "<div style='text-align:center'>No matching results found.</div>";
						return;
					}
					?>
					<script type="text/javascript">searchResult=<?php echo json_encode($res); ?></script>
					<?php
					foreach($res as $i=>$val){
						$res[$i]=array_merge(array('<input onclick=\'loadFunctionUI($(this),"SDTHistory/edit",2,'.json_encode($res[$i]).')\' type="button" value="Edit"/><br/><input onclick=\'deleteData($(this),'.$i.',12);\' type="button" value="Delete"/>'),$res[$i]);
					}
					foreach($res as $i=>$val){
						switch($res[$i]["Sem"]){
							case 1:$res[$i]["Sem"]="1st";break;
							case 2:$res[$i]["Sem"]="2nd";break;
							case 3:$res[$i]["Sem"]="Summer";break;
						}
					}
					$this->table->set_heading('','Student Number','Semester','AY','Case Number','Academic Status','Remarks','Case Status','Date Ordered','Date Effective');
					$this->table->set_template($tmpl);
					echo "<div style='width:100%;overflow-x:scroll'>";
					echo $this->table->generate($res);
					echo "<br/></div>";
				break;
			case 11:echo json_encode($this->CASStdRegistry->getSDT($_POST));
				break;
			case "11.2":print_r($this->CASStdRegistry->updateSDT($_POST));
				break;
			case 12:print_r($this->CASStdRegistry->delSDT($_POST));
				break;
		}
	}
	function transactionDB($fxn=-1){
		$validationRule = array(
				array('field'=>'Date_In','label'=>'Date_In','rules'=>'required'),
				array('field'=>'Name_Unit_Who_Requested','label'=>'Name_Unit_Who_Requested','rules'=>'alpha_dash|required'),
				array('field'=>'Student_Number','label'=>'Student_Number','rules'=>'exact_length[10]'),
				array('field'=>'Course_Unit','label'=>'Course_Unit','rules'=>''),
				array('field'=>'Indicator','label'=>'Indicator','rules'=>''),
				array('field'=>'Operation','label'=>'Operation','rules'=>''),
				array('field'=>'Code','label'=>'Code','rules'=>''),
				array('field'=>'Count','label'=>'Count','rules'=>'numeric'),
				array('field'=>'Signed_Performed_By','label'=>'Signed_Performed_By','rules'=>''),
				array('field'=>'Received_By','label'=>'Received_By','rules'=>''),
				array('field'=>'Date_Out','label'=>'Date_Out','rules'=>'')
        );
		$this->load->library('form_validation');
		$this->load->library('table');
		$this->load->model('Win6Transactions');
		$this->form_validation->set_message('required','<p>Required</p><p>%s</p>');
		$this->form_validation->set_message('alpha_dash', '<p>Alpha-Dash</p><p>%s</p>');
		$this->form_validation->set_message('numeric', '<p>Numeric</p><p>%s</p>');
		$this->form_validation->set_message('exact_length', '<p>Required Length</p><p>%s</p>');
		$this->form_validation->set_rules($validationRule);
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
			case 1:if($this->form_validation->run() == FALSE)
				   {
						echo validation_errors('<span class="transactionError">','</span>');
				   }
				   else
				   {
						$this->Win6Transactions->addTransaction($_POST);
				   }
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
	function validate(){
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			//$this->load->view('myform');
			echo validation_errors();
		}
		else
		{
			$this->load->view('formsuccess');
		}
	}
	function genPDFReport($type){
		$this->load->model('CASStdRegistry');
		$data=array();$headings=NULL;
		switch($type){
			case 1:$data=$this->CASStdRegistry->searchStdReg(array(),"*");break;
			case 2:$data=$this->CASStdRegistry->getSDH(array());break;
			case 3:$data=$this->CASStdRegistry->getSDT(array());break;
			case 4:break;
			case 5:break;
			case 6:$this->load->model('Win6Transactions');
				   $data=$this->Win6Transactions->getTransactions(array(),"Date_In,Name_Unit_Who_Requested,Student_Number,Course_Unit,Indicator,Operation,Code,Count,Signed_Performed_By,Received_By,Date_Out");
				   $headings=array( 'Date_In'=>'Date In',
									'Name_Unit_Who_Requested'=>'Name / Unit Who Requested',
									'Student_Number'=>'Student Number',
									'Course_Unit'=>'Course / Unit',
									'Indicator'=>'Indicator',
									'Operation'=>'Operation',
									'Code'=>'Code',
									'Count'=>'Count',
									'Signed_Performed_By'=>'Signed / Performed By',
									'Received_By'=>'Received By',
									'Date_Out'=>'Date Out'
							);
				   break;
		}
		$this->load->library('cezpdf');
		$pdf = new Cezpdf('letter','landscape');
		$pdf->ezSetMargins(72,72,72,72);
		$pdf->selectFont('./fonts/Helvetica.afm');
		$pdf->ezTable($data,$headings,NULL,array('width'=>648,'fontSize' => 7,'cols'=>array('Name_Unit_Who_Requested'=>array('justification'=>'center'))));
		//$pdf->ezStream();
		$this->load->helper('download');
		force_download("report.pdf",$pdf->ezOutput());
	}
	function genXLSReport($type){
		$this->load->model('CASStdRegistry');
		$data=array();$headings=NULL;
		switch($type){
			case 1:$data=$this->CASStdRegistry->searchStdReg(array(),"*");break;
			case 2:$data=$this->CASStdRegistry->getSDH(array());break;
			case 3:$data=$this->CASStdRegistry->getSDT(array());break;
			case 4:break;
			case 5:break;
			case 6:$this->load->model('Win6Transactions');
				   $data=$this->Win6Transactions->getTransactions(array(),"Date_In,Name_Unit_Who_Requested,Student_Number,Course_Unit,Indicator,Operation,Code,Count,Signed_Performed_By,Received_By,Date_Out");
				   $headings=array( 'Date_In'=>'Date In',
									'Name_Unit_Who_Requested'=>'Name / Unit Who Requested',
									'Student_Number'=>'Student Number',
									'Course_Unit'=>'Course / Unit',
									'Indicator'=>'Indicator',
									'Operation'=>'Operation',
									'Code'=>'Code',
									'Count'=>'Count',
									'Signed_Performed_By'=>'Signed / Performed By',
									'Received_By'=>'Received By',
									'Date_Out'=>'Date Out'
							);
				   break;
		}
		$this->load->library('PHPExcel');
				
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set properties
		$objPHPExcel->getProperties()->setCreator("College of Arts and Sciences")
									 ->setLastModifiedBy("College of Arts and Sciences")
									 ->setTitle("Report")
									 ->setSubject("Report")
									 ->setDescription("Report in XLS Format")
									 ->setKeywords("xls report php")
									 ->setCategory("Report");


		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)->fromArray($data);

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('CAS Report');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="report.xls"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
}
?>