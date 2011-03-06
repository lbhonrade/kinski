<?php
class main extends CI_Controller {
	function index(){
		session_start();
		$this->load->model('ConstantData');
		$availableCourses=$this->ConstantData->getAvailableCourses();
		$_SESSION["availableCourses"]=array();
		foreach($availableCourses as $course){
			$_SESSION["availableCourses"][$course["DegreeName"]]=$course["DegreeAbbr"];
		}
		$this->load->view("main");
	}
	function login(){
		$this->load->model('UserUtil');
		$user=$this->UserUtil->getAcct($_POST);
		session_start();
		if(count($user)>0){
			$AccountInfo=$this->UserUtil->getAcctInfo($user[0]);
			$_SESSION["loggedIn"]=array_merge($user[0],$AccountInfo);
		}
		echo json_encode(array(count($user),$_POST["username"]));
	}
	function logout(){
		session_start();
		unset($_SESSION["loggedIn"]);
	}
	function loadPage($seg1="",$seg2="",$seg3=""){
		session_start();
		if(!isset($_SESSION["loggedIn"])&&$seg1!="HomePage"&&$seg1!="sign_up"){
			$this->load->view("unauthorized");
			return;
		}
		$path=$seg1;
		if(strlen($seg2)>0) $path.="/".$seg2;
		if(strlen($seg3)>0) $path.="/".$seg3;
		if(isset($_POST["newUserType"])){
			
		}
		$this->load->view($path,$_POST);
	}
	/*function genPDFReport($type){
		$this->load->model('ModelTransactions');
		$data=array();$headings=NULL;
		
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
	}*/
}
?>