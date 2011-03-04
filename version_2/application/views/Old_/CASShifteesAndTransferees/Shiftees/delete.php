<?php $this->load->helper("html");?>
<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#delShifterForm table td:even").css({"text-align":"right"});
		$("#delShifterForm table td:odd *").css({"width":"90%","margin-right":"30px"});
	}
</script>
<div class="bor">
	<h4>Remove Shifter</h4>
	<form id="delShifterForm">
		<table style="width:100%">
			<tr><td>Student Number</td><td><input/></td></tr>
		</table>
		<?php echo nbs(50);?><input type="button" value="Search Shifter"/><br/>
		<br/><input type="button" value="Delete Shifter" style="width:100%;"/>
	</form>
</div>