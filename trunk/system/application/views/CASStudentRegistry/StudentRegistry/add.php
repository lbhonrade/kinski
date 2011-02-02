<?php $this->load->helper("html");
	  $this->load->helper("url");	  ?>
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
	var stdRegForm={
		"Student Number":{"type":0,"name":"Student_Number"},			
		"Name":{"type":2,
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
		initializeForm(stdRegForm,{"font-weight":"bold","padding-right":"30px"},"addStdRegForm");
		$("#addStdRegForm td:even").css({"text-align":"right"});
		$("#addStdRegForm td:odd *").css({"width":"90%","margin-right":"30px"});
	});
	function sendData(){
		var input={"BasicInfo":{},"PerSemester":{}},field,i=0;
		$("#addStdRegForm .singleValuedInput").each(function(){
			field=$(this);
			try{
				if($(field).attr("name").length>0){
					input["BasicInfo"][$(field).attr("name")]=$(field).val();
				}
			}catch(e){}
		});
		$("#addStdRegForm table div.portlet").each(function(){
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
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/1",input,function(data){
			alert(data);
			alert("Inserted.");
		},"html");
	}
</script>
<div class="bor">
	<h4>Add Student</h4>
	<form id="addStdRegForm">
		<table style="width: 100%"></table><br/>
		<input type="button" value="Add Student" onclick="sendData();" style="width:100%;"/>
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
	</div>
</div>