<?php $this->load->helper("html");?>
<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#searchTransfereeForm table td:even").css({"text-align":"right"});
		$("#searchTransfereeForm table td:odd *").css({"width":"90%","margin-right":"30px"});
	}
</script>
<div class="bor">
	<h4>Search Transferee</h4>
	<form id="delTransfereeForm">
			Student Number<input/>
		<input type="button" value="Search Transferee"/><br/><br/>
	</form>
</div>