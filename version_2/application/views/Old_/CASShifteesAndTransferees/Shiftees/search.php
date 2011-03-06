<?php $this->load->helper("html");?>
<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#searchShifterForm table td:even").css({"text-align":"right"});
		$("#searchShifterForm table td:odd *").css({"width":"90%","margin-right":"30px"});
	}
</script>
<div class="bor">
	<h4>Search Shifter</h4>
	<form id="delShifterForm">
			Student Number<input/>
		<input type="button" value="Search Shifter"/><br/><br/>
	</form>
</div>