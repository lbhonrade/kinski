<?php $this->load->helper("html");
	  $this->load->helper("url"); ?>
<style type="text/css">
	.column { width:550px; float:left; cursor: pointer;}
	.portlet { margin: 0 0 0 0; }
	.portlet-header { margin: 0.3em; padding-bottom: 4px; padding-left:0.2em; display:block; overflow:hidden;}
	.portlet-header .ui-icon { float: right; }
	.portlet-content { padding: 0.4em;}
	.ui-sortable-placeholder { border: 1px dotted black; visibility: visible !important; height: 50px !important; }
	.ui-sortable-placeholder * { visibility: hidden; }
</style>
<script>
	//$(function(){$(".column").sortable();});
	function formatPortlet(obj){
		$(obj).addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
			.find(".portlet-header")
				.addClass("ui-widget-header ui-corner-all")
				.end()
			.find(".portlet-content");
		$(obj).find(".detailToggleButton").click(function(){
			$(this).parents(".portlet:first").find(".portlet-content").toggle();
		});
		//$(obj).find(".detailToggleButton").trigger("click");
	}
</script>
<script type="text/javascript">
	var stdRegForm={"Name":{"type":2,
							"childFields":{
								"Last Name":{"type":0,"name":"Last_Name"},
								"First Name":{"type":0,"name":"First_Name"},
								"Middle Initial":{"type":0,"name":"Middle_Initial"}}},
					"Degree Program":{"type":1,
									  "name":"Course",
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
					"Major":{"type":0,"name":"Major"},
					"Title of Thesis":{"type":0,"name":"Title_Thesis"},
					"Classification at the Start of Semester":{"type":1,
									 "name":"Classification_Start",
									 "options":{
										"New Freshman":"NF",
										"Old Freshman":"OF",
										"Sophomore":"So",
										"Junior":"J",
										"Senior":"Se"}},
					"Classification at the End of Semester":{"type":1,
									 "name":"Classification_End",
									 "options":{
										"None":"None",
										"New Freshman":"NF",
										"Old Freshman":"OF",
										"Sophomore":"So",
										"Junior":"J",
										"Senior":"Se"}},
					"General Weighted Average":{"type":0,"name":"GWA"},
					"Total Number of Units":{"type":0,"name":"Unit"},
					"GWA Per Semester":{"type":3,
										"btnValue":"Add Semester",
										"clickFxn":"addSemInfo('semInfo');",
										"destDiv":"semInfo"},
					"RES":{"type":0,"name":"Res"},
					"Adviser":{"type":0,"name":"Adviser"},
					"Registration Adviser":{"type":0,"name":"Reg_Adviser"},
					"Home Address":{"type":2,
									"childFields":{
										"Number/Street":{"type":0,"name":"Home_Number_Street_Vill"},
										"Barangay":{"type":0,"name":"Home_Barangay"},
										"Town/City":{"type":0,"name":"Home_Town_City"},
										"Province":{"type":0,"name":"Home_Province"}}},
					"Contact Number":{"type":0,"name":"Contact_Number"},
					"College Address":{"type":2,
									"childFields":{
										"Number/Street":{"type":0,"name":"College_Number_Street_Vill"},
										"Barangay":{"type":0,"name":"College_Village_Barangay"},
										"Town/City":{"type":0,"name":"College_Town_City"}}},
					};
	$(document).ready(function(){
		stylizeForm();
		$("input[name='AY']").live("change",function(){
			$(this).siblings("input[id='AY2']").attr("value",$(this).val()*1+1)
		});
	});
	function stylizeForm(){
		$("#editStdRegForm table td:even").css({"text-align":"right"});
		$("#editStdRegForm table td:odd *").css({"width":"90%","margin-right":"30px"});
	}
	function requestInfo(lbl,val){
		var input={};
		input[lbl]=val;
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/2",input,function(data){
			//alert(data);
			initializeForm(stdRegForm,{"font-weight":"bold","padding-right":"30px"},"editStdRegForm");
			stylizeForm();
			//return;
			for(i in data[0]){
				$("#editStdRegForm>table input[name='"+i+"']").attr("value",data[0][i]);
				$("#editStdRegForm>table select[name='"+i+"']").attr("value",data[0][i]);
			}
			for(i in data[1]){
				addSemInfo('semInfo');
				var panel=$("#editStdRegForm>table div.portlet:last-child");
				for(j in data[1][i]){
					$(panel).find("*:[name='"+j+"']").attr("value",data[1][i][j]);
				}
				$(panel).find("input:[id='AY2']").attr("value",data[1][i]['AY']*1+1);
			}
		},"json");
	}
	function updateInfo(){
		var input={"BasicInfo":{},"PerSemester":{}},field,i=0;
		$("#editStdRegForm .singleValuedInput").each(function(){
			field=$(this);
			try{
				if($(field).attr("name").length>0){
					input["BasicInfo"][$(field).attr("name")]=$(field).val();
				}
			}catch(e){}
		});
		$("#editStdRegForm table div.portlet").each(function(){
			input["PerSemester"][i]={};
			$(this).find("select,input:text").each(function(){
				try{
					if($(this).attr("name").length>0){
						input["PerSemester"][i][$(this).attr("name")]=$(this).val();
					}
				}catch(e){}
			});
			i++;
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/3",input,function(data){
			alert(data);
			alert("Updated.");
		},"text");
	}
</script>
<div class="bor">
	<h4>Edit Student</h4>
	<form id="editStdRegForm" onsubmit="return false">
		<table style="width: 100%">
			<tr>
				<td>Student Number</td>
				<td><input name="Student_Number" class="singleValuedInput"/><input type="button" value="Search Student Record" onclick="requestInfo('Student_Number',$('input[name=\'Student_Number\']').val());$('#prototypes>#editSaveChangesBtn').appendTo('#editStdRegForm');stylizeForm();"/></td>
			</tr>
		</table><br/>
	</form>
	<script type="text/javascript">
		function addSemInfo(outputDiv){
			$("#"+outputDiv).append($("#prototypes>div.portlet:first").clone());
			formatPortlet($("#"+outputDiv).children("div.portlet:last-child"));
		}
	</script>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		<div class='portlet'>
			<div class='portlet-header'>
				Semester:<select name="Semester"><option value="1">1st</option><option value="2">2nd</option><option value="3">Summer</option></select>AY<input type='text' style="width:100px" name="AY"/>-<input type='text' style="width:100px" disabled="disabled" id="AY2"/>
				<span style='float:right'><!--<input class='detailToggleButton' type='button' value='Fill Details' style='width:150px;'/>-->
					<input name='removeButton' type='button' value='Remove Semester' onclick='$(this).parent().parent().parent().remove();' style='width:150px;'/>
				</span>
			</div>
			<div class='portlet-content'>
				<table style="width:100%">
					<!--<tr><td>Classification:</td><td><select style="width:90%"><option>New Freshman</option><option>Old Freshman</option><option>Sophomore</option><option>Junior</option><option>Senior</option></select></td></tr>-->
					<tr><td>GWA:</td><td><input type='text' name="GWA" style="width:90%"/></td></tr>
					<tr><td>Status:</td><td><select name="Status" style="width:90%"><option>University Scholar</option><option>College Scholar</option><option>Honor Roll</option><option>Good</option><option>Warning</option><option>Probation</option><option>Dismissed</option></select></td></tr>
				</table>
			</div>
		</div>
		<input id="editSaveChangesBtn" type="button" value="Save Changes" style="width:100%;" onclick="updateInfo();"/>
	</div>
</div>