<?php $this->load->helper("url"); ?>
<div class="bor">
	<h4>Summary Report</h4>
	<?php echo $_POST["summaryReport"]; ?>
	<script type="text/javascript">	
		$("#summaryReportTable tbody tr").append($("#repButtons tr").html());	
		$("#summaryReportTable tbody input:button").button();		
		
		function seeWeek(caller){
			
		}
		function seeMonth(caller){
		}				
	</script>
</div>
<div id="prototypes" style="position:absolute; visibility:hidden;">
	<table id="repButtons">
		<tr>
			<td><input type="button" value="Per Week" onclick="seeWeek($(this));"/></td>
			<td><input type="button" value="Per Month" onclick="seeMonth($(this));"/></td>			
		</tr>
	</table>	
</div>








