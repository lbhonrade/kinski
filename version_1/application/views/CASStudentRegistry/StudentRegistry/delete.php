<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#delStdRegForm td:even").css({"text-align":"right"});
		$("#delStdRegForm td:odd *").css({"width":"90%","margin-right":"30px"});
	}
	
</script>
<div class="bor">
	<h4>Delete Student</h4>
	<form id="editStdRegForm">
		<table style="width: 100%">
			<tr>
				<td>Student Number</td>
				<td><input name="Student_Number"/><input type="button" value="Search" onclick=""/></td>
			</tr>
			</table><br/>
		<input type="button" value="Delete Student Record" style="width:100%;"/>
	</form>
</div>