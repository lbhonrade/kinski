<?php $this->load->helper("html"); ?>
<script type="text/javascript">
	var shifterForm={
		"Student Number":{"type":0,"name":"Student_Number"},
		"Previous College":{"type":0,"name":"PrevCollege"},
		"Previous Course":{"type":0,"name":"PrevCollege"},
		"Accepted Course":{"type":1,"name":"AccCourse",
			  "options":{
				"BS Computer Science":"BSCS",
				"BA Communication Arts":"BACA",
				"BS Biology":"BSBio",
				"BA Sociology":"BSSocio",
				"BS Applied Physics":"BSAP",
				"BS Statistics":"BSStat",
				"BS Mathematics":"BSMath",
				"BS Applied Mathematics":"BSAM",
				"BS Chemistry":"BSChem"}},
		"Deficiency":{"type":0,"name":"Deficiency"}
	}
	$(document).ready(function(){
		initializeForm(shifterForm,{"font-weight":"bold","padding-right":"30px"},"addShifterForm");
		$("#addShifterForm td:even").css({"text-align":"right"});
		$("#addShifterForm td:odd>*").css({"width":"90%","margin-right":"30px"});
	});
	
</script>
<div class="bor">
	<h4>Add Shifter</h4>
	<form id="addShifterForm">
		<table style="width: 100%">
		</table><br/>
		<input type="button" value="Add Shifter" style="width:100%;" onclick="sendData();"/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		
	</div>
</div>