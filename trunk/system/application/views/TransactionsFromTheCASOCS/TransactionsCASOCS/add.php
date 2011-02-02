<?php $this->load->helper("html");
	  $this->load->helper("url"); ?>
<script type="text/javascript">
	var transForm={
		"Date(IN)":{"type":5,"name":"Date_In"},
		"Name/Unit Who Requested":{"type":0,"name":"Name_Unit_Who_Requested"},
		"Student Number":{"type":0,"name":"Student_Number"},
		"Course/Unit":{"type":0,"name":"Course_Unit"},
		"Indicator":{"type":0,"name":"Indicator"},
		"Operation":{"type":0,"name":"Operation"},
		"Code":{"type":0,"name":"Code"},
		"Count":{"type":0,"name":"Count"},
		"Signed/Performed By":{"type":0,"name":"Signed_Performed_By"},
		"Received By":{"type":0,"name":"Received_By"},
		"Date(OUT)":{"type":5,"name":"Date_Out"}
	};
	$(document).ready(function(){
		initializeForm(transForm,{"font-weight":"bold","padding-right":"30px"},"addTransaction");
		$("#addTransaction td:even").css({"text-align":"right"});
		$("#addTransaction td:odd>*").css({"width":"90%","margin-right":"30px"});
		$(".dateInput").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
	});
	function sendData(){
		var input={},i=0;
		$(".singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/transactionDB/1",input,function(data){
			alert(data);
			//alert("Inserted.");
		},"html");
	}
</script>
<div class="bor">
	<h4>Add Transaction</h4>
	<form id="addTransaction">
		<table style="width: 100%">
			</table><br/>
		<input type="button" value="Add Transaction" style="width:100%;" onclick="sendData();"/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		
	</div>
</div>