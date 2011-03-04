<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#delStdSDTForm table td:even").css({"text-align":"right"});
		$("#delStdSDTForm table td:odd *").css({"width":"90%","margin-right":"30px"});
	}
</script>
<div class="bor">
	<h4>Remove SDT Case</h4>
	<form id="delStdSDTForm">
		<table style="width: 100%">
			<tr><td>Student Number</td><td><input/></td></tr>
			<tr><td>Case Number</td><td><input/></td></tr>
			<tr><td><input type="button" value="Search SDT Case"/></td></tr>
		</table><br/>
		<input type="button" value="Delete SDT Case" style="width:100%;"/>
	</form>
</div>