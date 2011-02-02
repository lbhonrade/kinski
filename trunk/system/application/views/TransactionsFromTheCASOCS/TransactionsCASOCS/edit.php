<?php $this->load->helper("html");
	  $this->load->helper("url"); ?>
<script type="text/javascript">
	var preLoaded={
		"Student Number":{"type":0,"name":"Student_Number"},
		"Case Number":{"type":0,"name":"Case_Number"}
	}
	var sdtForm={
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
		initializeForm(preLoaded,{"font-weight":"bold","padding-right":"30px"},"editStdSDTForm");
		$("#editStdSDTForm>table").append($("<tr></tr>").append("<td></td>").append("<td><input type='button' value='Search SDT Case' onclick='requestData();'/></td>"));
		stylizeForm();
		$(".dateInput").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
	});
	function stylizeForm(){
		$("#editStdSDTForm table td:even").css({"text-align":"right"});
		$("#editStdSDTForm td:odd>*").css({"width":"90%","margin-right":"30px"});
	}
	function requestData(){
		var input={};
		$("#editStdSDTForm>table .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/11",input,function(data){
			$("#editStdSDTForm>table .singleValuedInput").each(function(){
				$(this).removeClass("singleValuedInput").addClass("primaryKey");
			});
			initializeForm(sdtForm,{"font-weight":"bold","padding-right":"30px"},"editStdSDTForm");
			stylizeForm();
			$(".dateInput").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat:"yy-mm-dd"
			});
			for(i in data[0]){
				$("*[name='"+i+"']").val(data[0][i]);
			}
			$("input:[id='AY2']").attr("value",data[0]['AY']*1+1);
			$("div[name='Date_Ordered']").datepicker("setDate",data[0]['Date_Ordered']);
			$("div[name='Date_Effective']").datepicker("setDate",data[0]['Date_Effective']);
			$("#prototypes>#stdSDTForm>input").appendTo("#editStdSDTForm");
		},"json");
	}
	function sendData(){
		var input={"primaryKey":{},"nonPrimaryKey":{}};
		$("#editStdSDTForm>table .singleValuedInput").each(function(){
			input["nonPrimaryKey"][$(this).attr("name")]=$(this).val();
		});
		$("#editStdSDTForm>table .primaryKey").each(function(){
			input["primaryKey"][$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/11%2e2",input,function(data){
			alert(data);
		},"html");
	}
</script>
<div class="bor">
	<h4>Edit SDT Case</h4>
	<form id="editStdSDTForm">
		<table style="width: 100%">			
		</table><br/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		<div id="stdSDTForm">
			<input type="button" value="Save Changes" style="width:100%;" onclick="sendData();"/>
		</div>
	</div>
</div>