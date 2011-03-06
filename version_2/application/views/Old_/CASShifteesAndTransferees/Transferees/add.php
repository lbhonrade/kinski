<?php $this->load->helper("html"); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#addTransfereeForm td:even").css({"text-align":"right"});
		$("#addTransfereeForm td:odd *").css({"width":"90%","margin-right":"30px"});
	});
</script>
<div class="bor">
	<h4>Add Transferee</h4>
	<form id="addTransfereeForm">
		<table style="width: 100%">
			<tr><td>Student Number</td><td><input/></td></tr>
			<tr><td>Accepted College</td><td><input/></td></tr>
			<tr><td>Accepted Course</td><td><input/></td></tr>
			<tr><td>Course</td>
				<td><select>
						<option value="BSCS">BS Computer Science</option>
						<option value="BACA">BA Communication Arts</option>
						<option value="BSBio">BS Biology</option>
						<option value="BSSocio">BS Sociology</option>
						<option value="BSAP">BS Applied Physics</option>
						<option value="BSStat">BS Statistics</option>
						<option value="BSMath">BS Mathematics</option>
						<option value="BSAM">BS Applied Mathematics</option>
						<option value="BSChem">BS Chemistry</option>
					</select></td></tr>
			<tr><td>Deficiency</td><td><input/></td></tr>
			
		</table><br/>
		<input type="button" value="Add Transferee" style="width:100%;"/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		
	</div>
</div>