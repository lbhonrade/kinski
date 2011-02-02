<?php $this->load->helper("html");
	  $this->load->helper("url"); ?>
<script type="text/javascript">
	var SDHForm={
		"Student Number":{"type":0,"name":"Student_Number"},
		"Semester":{"type":1,
					 "name":"Semester",
					 "options":{
						"1st":"1",
						"2nd":"2",
						"Summer":"3"}},
		"AY":{"type":4,"name":"AY","name2":"AY2"},
		"Has Form 5":{"type":6,"name":"Form5"},
		"Form5A":{"type":0,"name":"Form5A"},
		"Academic Status":{"type":1,
					 "name":"Status",
					 "options":{
						"University Scholar":"University Scholar",
						"College Scholar":"College Scholar",
						"Honor Roll":"Honor Roll",
						"Good":"Good",
						"Warning":"Warning",
						"Probation":"Probation",
						"Dismissed":"Dismissed"}},
		"Remarks":{"type":0,"name":"Remarks"},
		"Date":{"type":5,"name":"Date"}
	}
	$(document).ready(function(){
		initializeForm(SDHForm,{"font-weight":"bold","padding-right":"30px"},"addStdDelinForm");
		$("#addStdDelinForm td:even").css({"text-align":"right"});
		$("#addStdDelinForm td:odd>*").css({"width":"90%","margin-right":"30px"});
		$(".dateInput").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
	});
	function sendData(){
		var input={},i=0;
		$("#addStdDelinForm .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
		});
		input["Form5"]=($("input[name='Form5']").attr("checked")?"X":"O");
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/5",input,function(data){
			alert(data);
			//alert("Inserted.");
		},"html");
	}
</script>
<div class="bor">
	<h4>Add Student Delinquent</h4>
	<form id="addStdDelinForm">
		<table style="width: 100%">
			</table><br/>
		<input type="button" value="Add Delinquency" style="width:100%;" onclick="sendData();"/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		
	</div>
</div>