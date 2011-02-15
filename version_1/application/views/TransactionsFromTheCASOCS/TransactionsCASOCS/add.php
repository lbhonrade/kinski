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
		$("input:button").button();
	});
	function sendData(){
		var input={},i=0;
		$("#addTransaction .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
			$(this).parent().parent().children("td:first").css({"background-color":"#ffffff"});
		});
		$.post("<?php echo base_url();?>index.php/main/transactionDB/1",input,function(data){
			if(data==""){
				alert("Transaction Successfully added.");
			}else{
				var errorList={};
				$(data).each(function(){
					$("#addTransaction *[name='"+$(this).find("p:last").text()+"']").parent().parent().children("td:first").css({"background-color":"red"});
					if(errorList[$(this).find("p:last").text()]==null) errorList[$(this).find("p:last").text()]="";
					errorList[$(this).find("p:last").text()]=errorList[$(this).find("p:last").text()]+"-->"+$(this).find("p:first").text()+"\n";
				});
				var errorSummary="";
				for(i in errorList){
					if(i){
						errorSummary=errorSummary+i+"\n"+errorList[i]+"\n";
					}
				}
				alert("Error Summary:\n"+errorSummary);
			}
		},"text");
	}
</script>
<div class="bor">
	<h4>Add Transaction</h4>
	<form id="addTransaction">
		<table style="width: 100%">
			</table><br/>
		<input type="button" class="add" value="Add Transaction" style="width:100%;" onclick="sendData();"/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
	</div>
</div>