<?php $this->load->helper("html");
	  $this->load->helper("url"); ?>
<script type="text/javascript">
	var preLoaded={
	"Student Number":{"type":0,"name":"Student_Number"},
		"Semester":{"type":1,
					 "name":"Semester",
					 "options":{
						"1st":"1",
						"2nd":"2",
						"Summer":"3"}},
		"AY":{"type":4,"name":"AY","name2":"AY2"}
	}
	var SDHForm={
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
		initializeForm(preLoaded,{"font-weight":"bold","padding-right":"30px"},"editStdDelinForm");
		$("#editStdDelinForm>table").append($("<tr></tr>").append("<td></td>").append("<td><input type='button' value='Search Delinquency' onclick='requestData();'/></td>"));
		stylizeForm();
	});
	function stylizeForm(){
		$("#editStdDelinForm table td:even").css({"text-align":"right"});
		$("#editStdDelinForm td:odd>*").css({"width":"90%","margin-right":"30px"});
	}
	function requestData(){
		var input={};
		$("#editStdDelinForm>table .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/7",input,function(data){
			$("#editStdDelinForm>table .singleValuedInput").each(function(){
				$(this).removeClass("singleValuedInput").addClass("primaryKey");
			});
			initializeForm(SDHForm,{"font-weight":"bold","padding-right":"30px"},"editStdDelinForm");
			stylizeForm();
			$(".dateInput").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat:"yy-mm-dd"
			});
			for(i in data[0]){
				$("*[name='"+i+"']").val(data[0][i]);
			}
			$("div[name='Date']").datepicker("setDate",data[0]['Date']);
			$("input[name='Form5']").attr("checked",data[0]["Form5"]=="X"?true:false);
			$("#prototypes>#stdDelinForm>input").appendTo("#editStdDelinForm");
		},"json");
	}
	function updateDelinquency(){
		var input={"primaryKey":{},"nonPrimaryKey":{}};
		$("#editStdDelinForm>table .singleValuedInput").each(function(){
			input["nonPrimaryKey"][$(this).attr("name")]=$(this).val();
		});
		input["nonPrimaryKey"]["Form5"]=($("input[name='Form5']").attr("checked")?"X":"O");
		$("#editStdDelinForm>table .primaryKey").each(function(){
			input["primaryKey"][$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/7%2e2",input,function(data){
			alert(data);
		},"html");
	}
</script>
<div class="bor">
	<h4>Edit SDT Case</h4>
	<form id="editStdDelinForm">
		<table style="width:100%">
		<!--	<tr><td>Student Number</td><td><input class/></td></tr>-->
		</table>
		<!--<div style="width:90%;text-align:right;margin-right:30px;">Semester:<select><option>1<sup>st</sup></option><option>2<sup>nd</sup></option><option>Summer</option></select>AY<input type='text'/>-<input type='text'/></div>-->
		<br/>
	</form>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		<div id="stdDelinForm">
			<input type="button" value="Save Changes" onclick="updateDelinquency();" style="width:100%;"/>
		</div>
	</div>
</div>