<?php $this->load->helper("html");?>
<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#delTransfereeForm table td:even").css({"text-align":"right"});
		$("#delTransfereeForm table td:odd *").css({"width":"90%","margin-right":"30px"});
	}
</script>
<div class="bor">
	<h4>Remove Transferee</h4>
	<form id="delTransfereeForm">
		<table style="width:100%">
			<tr><td>Student Number</td><td><input/></td></tr>
		</table>
		<?php echo nbs(50);?><input type="button" value="Search Transferee"/><br/>
		<br/><input type="button" value="Delete Transferee" style="width:100%;"/>
	</form>
</div>