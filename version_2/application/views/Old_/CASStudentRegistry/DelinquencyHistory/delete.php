<?php $this->load->helper("html");?>
<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#delStdDelinForm table td:even").css({"text-align":"right"});
		$("#delStdDelinForm table td:odd *").css({"width":"90%","margin-right":"30px"});
	}
</script>
<div class="bor">
	<h4>Remove Delinquency</h4>
	<form id="delStdDelinForm">
		<table style="width:100%">
			<tr><td>Student Number</td><td><input/></td></tr>
		</table>
		<div style="width:90%;text-align:right;margin-right:30px;">Semester:<select><option>1<sup>st</sup></option><option>2<sup>nd</sup></option><option>Summer</option></select>AY<input type='text'/>-<input type='text'/></div>
		<?php echo nbs(50);?><input type="button" value="Search Delinquency"/><br/>
		<br/><input type="button" value="Delete Delinquency" style="width:100%;"/>
	</form>
</div>