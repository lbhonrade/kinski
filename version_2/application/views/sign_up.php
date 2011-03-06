<?php $this->load->helper("url"); ?>
<script type="text/javascript">
	var new_user_type="<?php echo $_POST["newUserType"]; ?>";
	<?php if($_POST["newUserType"]=="Student"){ ?>
		var signUpForm={
			"Student Number":{"type":0,"name":"1"},
			"Password":{"type":9,"name":"0","formType":"password"},
			"Name":{"type":2,
					"childFields":{
						"Last Name":{"type":0,"name":"2"},
						"First Name":{"type":0,"name":"3"},
						"Middle Initial":{"type":0,"name":"4"}}},
			"Degree Program":{"type":1,
							  "name":"5",
							  "options":<?php echo json_encode($_POST["availableCourses"]); ?>
			},
			"Home Address":{"type":0,"name":"6"},
			"Contact Number":{"type":0,"name":"7"},
			"Mobile Number":{"type":0,"name":"8"},
			"Email Address":{"type":0,"name":"9"}
		};
		function sendNewAccount(){
			var data={};
			$("#signUpForm>table>tbody>tr>td>.singleValuedInput").each(function(){
				data[$(this).attr("name")]=$(this).val();
			});
			$.post("<?php echo base_url(); ?>index.php/UserController/createPendingAccount/Student",data,function(data){
				alert(data);
			},"html");
		}
	<?php }else{ ?>
		var signUpForm={
			"Student Number":{"type":0,"name":"2"},
			"Password":{"type":9,"name":"0","formType":"password"},
			"Name":{"type":2,
					"childFields":{
						"Last Name":{"type":0,"name":"3"},
						"First Name":{"type":0,"name":"4"},
						"Middle Initial":{"type":0,"name":"5"}}},
			"Degree Earned":{
				"type":3,
				"btnValue":"Add Degree",
				"clickFxn":"addDegreeInfo('degreeInfo');",
				"destDiv":"degreeInfo"
			},
			"Home Address":{"type":0,"name":"6"},
			"Office Address":{"type":0,"name":"7"},
			"Contact Number":{"type":0,"name":"8"},
			"Mobile Number":{"type":0,"name":"9"},
			"Email Address":{"type":0,"name":"10"}
		};
		function sendNewAccount(){
			var data={},i=-1;
			$("#signUpForm>table>tbody>tr>td>.singleValuedInput").each(function(){
				data[$(this).attr("name")]=$(this).val();
			});
			data["1"]={};
			$("#signUpForm>table>tbody>tr>td>div.#degreeInfo .singleValuedInput").each(function(){
				if($(this).attr("name")==0){
					data["1"][++i]={};
				}
				data["1"][i][$(this).attr("name")]=$(this).val();
			});
			$.post("<?php echo base_url(); ?>index.php/UserController/createPendingAccount/Alumni",data,function(data){
				alert(data);
			},"html");
		}
	<?php } ?>
	$(document).ready(function(){
		initializeForm(signUpForm,{"font-weight":"bold","padding-right":"30px"},"signUpForm");
		$("#signUpForm td:even").css({"text-align":"right"});
		$("#signUpForm td:odd>*").css({"width":"90%","margin-right":"30px"});
		$(":button").button();
	});
	function goBackToHome(){
		loadUI("main","loadPage","HomePage/main",{},"#content");
	}
</script>
<?php if($_POST["newUserType"]!="Student"){ ?>
	<style type="text/css">
		.column { width:550px; float:left; cursor: pointer;}
		.portlet { margin: 0 0 0 0; width:790px;}
		.portlet-header { margin: 0.3em; padding-bottom: 0px; padding-left:0.2em; display:block; overflow:hidden;}
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
		function addDegreeInfo(outputDiv){
			$("#"+outputDiv).append($("#prototypes>div.portlet:first").clone());
			formatPortlet($("#"+outputDiv).children("div.portlet:last-child"));
		}
		
	</script>
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		<div class='portlet'>
			<div class='portlet-header'>
				Degree<select name="0" class="singleValuedInput"><?php foreach($_POST["availableCourses"] as $i => $val) echo "<option value=\"".$val."\">".$i."</option>"; ?></select>
				Semester Graduated<select name="1" class="singleValuedInput"><option value="1">1st</option><option value="2">2nd</option><option value="S">Summer</option></select>
				Year Graduated<input type='text' style="margin-top:4px;width:60px;" name="2" class="singleValuedInput"/>
				<span>
					<input name='removeButton' type='button' value='Remove Degree' onclick='$(this).parent().parent().parent().remove();' style='width:110px;text-align:center;padding-left:2px;'/>
				</span>
			</div>
		</div>
	</div>
<?php } ?>
<div class="bor" style="text-align:left">
	<h4><?php echo $_POST["newUserType"]; ?> Sign Up</h4>
	<form id="signUpForm">
		<table style="width: 100%"></table><br/>
		<input type="button" class="add" value="Sign Up" style="width:88%;margin-left:1%;" onclick="sendNewAccount();"/>
		<input type="button" value="Go Back" onclick="goBackToHome();" style="width:10%;margin-right:0px;"/>
	</form>
</div>