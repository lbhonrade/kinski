<?php
class ReportController extends CI_Controller {
	function loadSummaryReport(){
		$this->load->model("Report");
		$summaryReport=$this->Report->getReport();
		$this->load->library('table');
		$tmpl = array(
			'table_open'          => '<table id="summaryReportTable" class="highlightRow" style="text-align:center;" cellpadding="4" cellspacing="2">',
			
			'heading_row_start'   => '<tr>','heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<th>','heading_cell_end'    => '</th>',

			'row_start'           => '<tr>','row_end'             => '</tr>',
			'cell_start'          => '<td style="border:1px solid #000;padding:2px;">','cell_end'            => '</td>',

			'row_alt_start'       => '<tr>','row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td style="border:1px solid #000;padding:2px;">','cell_alt_end'        => '</td>',

			'table_close'         => '</table>'
		);
		$this->table->set_heading('Transaction Number', 'Date_In');
		$this->table->set_template($tmpl);
		$_POST["summaryReport"]=$this->table->generate($summaryReport);
		$this->load->view("ReportGeneration/admin_generate_report",$_POST);
		
	}	

}
?>