<?php $this->load->helper("html");
	  $this->load->helper("url"); ?>
<script type="text/javascript">
	var sdtForm={
		"Student Number":{"type":0,"name":"Student_Number"},
		"Case Number":{"type":0,"name":"Case_Number"},
		"Semester":{"type":1,
					 "name":"Sem",
					 "options":{
						"1st":"1",
						"2nd":"2",
						"Summer":"3"}},
		"AY":{"type":4,"name":"AY","name2":"AY2"},
		"Academic Status":{"type":1,
					 "name":"Academic_Status",
					 "options":{
						"University Scholar":"University Scholar",
						"College Scholar":"College Scholar",
						"Honor Roll":"Honor Roll",
						"Good":"Good",
						"Warning":"Warning",
						"Probation":"Probation",
						"Dismissed":"Dismissed"}},
		"Remarks":{"type":0,"name":"Remarks"},
		"Case Status":{"type":0,"name":"Case_Status"},
		"Date Ordered":{"type":5,"name":"Date_Ordered"},
		"Date Effective":{"type":5,"name":"Date_Effective"}
	};
	$(document).ready(function(){
		initializeForm(sdtForm,{"font-weight":"bold","padding-right":"30px"},"addStdSDTForm");
		$("#addStdSDTForm td:even").css({"text-align":"right"});
		$("#addStdSDTForm td:odd>*").css({"width":"90%","margin-right":"30px"});
		$(".dateInput").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
		$("input:button").button();
	});
	function sendData(){
		var input={},i=0;
		$("#addStdSDTForm .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/9",input,function(data){
			alert(data);
			//alert("Inserted.");
		},"html");
	}
</script>
<div class="bor">
	<h4>Add SDT Case</h4>
	<form id="addStdSDTForm">
		<table style="width: 100%">
			</table><br/>
		<input type="button" value="Add SDT Case" style="width:100%;" onclick="sendData();"/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		
	</div>
</div>