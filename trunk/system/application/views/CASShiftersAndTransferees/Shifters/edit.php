<?php $this->load->helper("html"); ?>
<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#editShifterForm td:even").css({"text-align":"right"});
		$("#editShifterForm td:odd *").css({"width":"90%","margin-right":"30px"});
	}
</script>
<div class="bor">
	<h4>Edit Shifter</h4>
	<form id="editShifterForm">
		<table style="width: 100%">
			<tr><td>Student Number</td><td><input/></td></tr>
			<tr><td><input type="button" value="Search Shifter" onclick="$('#prototypes div#shifterProfileForm>table>*').appendTo('#editShifterForm>table');$('#prototypes #shifterProfileForm>input:button').appendTo('#editShifterForm');stylizeForm();"/></td><td></td></tr>
		</table><br/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		<div id="shifterProfileForm">
			<table>
			<tr><td>Previous College</td><td><input/></td></tr>
			<tr><td>Previous Course</td><td><input/></td></tr>
			<tr><td>Accepted Course</td>
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
			</table>
			<input type="button" value="Save Changes" style="width:100%;"/>
		</div>
	</div>
</div>