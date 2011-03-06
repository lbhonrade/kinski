<?php
class ServiceController extends CI_Controller {
	function requestService($fxn=-1){
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
			case 1:
				break;
			case 2:
				break;
			case 3:
				break;
			case 4:
				break;
		}
	}
}
?>