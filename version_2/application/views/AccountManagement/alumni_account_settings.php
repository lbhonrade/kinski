<?php $this->load->helper("url"); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#content>.bor :button").button();
	});
	function goBackToHome(){
		loadUI("main","loadPage","HomePage/main",{},"#content");
	}
	function updateContactInfo(){
		data={};
		$("#alumniAccount input:text").each(function(){
			data[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url(); ?>index.php/UserController/updateContactInfo",data,function(data){
			alert(data);
		},"html");
	}
</script>
<div class="bor" style="text-align:left">
	<h4>Account Settings of Alumni <?php echo $_SESSION["loggedIn"]["Username"]; ?></h4>
	<form id="alumniAccount" style="text-align:center;">
		<table style="width:100%;"><tr><td style="vertical-align:top;">
		<h3>Student Number</h3><?php echo $_SESSION["loggedIn"]["Student_Number"]; ?><br/><br/>
		<h3>Name</h3><?php echo $_SESSION["loggedIn"]["Last_Name"].", ".$_SESSION["loggedIn"]["First_Name"]." ".$_SESSION["loggedIn"]["Middle_Initial"]; ?><br/><br/>
		<h3>Degree/s Earned</h3><div align="center"><table id="degreesEarned"><tr style="font-weight:bold"><td>Degree</td><td>Semester Graduated</td><td>Year Graduated</td></tr></table></div><br/>
		</td><td style="vertical-align:top;">
		<h3>Password</h3><input type="button" value="Change Password" style="text-align:center;width:300px;" onclick="showPasswordChanger();"/><br/><br/>
		<h3>Home Address</h3><input name="4" type="text" value="<?php echo $_SESSION["loggedIn"]["Home_Address"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		<h3>Office Address</h3><input name="5" type="text" value="<?php echo $_SESSION["loggedIn"]["Office_Address"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		<h3>Contact Number</h3><input name="6" type="text" value="<?php echo $_SESSION["loggedIn"]["Contact_Number"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		<h3>Mobile Number</h3><input name="7" type="text" value="<?php echo $_SESSION["loggedIn"]["Mobile_Number"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		<h3>Email Address</h3><input name="8" type="text" value="<?php echo $_SESSION["loggedIn"]["Email_Address"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		</td></tr>
		</table>
		<input type="button" class="add" value="Save Changes" style="width:88%;margin-left:1%;" onclick="updateContactInfo();"/>
		<input type="button" value="Go Back" onclick="goBackToHome();" style="width:10%;margin-right:0px;"/>
	</form>
	<script type="text/javascript">
		var degreesEarned=<?php echo json_encode($_SESSION["loggedIn"]["Degrees"]); ?>;
		for(i in degreesEarned){
			$("#degreesEarned").append("<tr><td>"+degreesEarned[i]["DP"]+"</td><td>"+degreesEarned[i]["SG"]+"</td><td>"+degreesEarned[i]["YG"]+"</td></tr>");
		}
	</script>
</div>
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
			Degree<select name="0"><?php foreach($_POST["availableCourses"] as $i => $val) echo "<option value=\"".$val."\">".$i."</option>"; ?></select>
			Semester Graduated<select name="1"><option value="1">1st</option><option value="2">2nd</option><option value="S">Summer</option></select>
			Year Graduated<input type='text' style="margin-top:4px;width:60px;" name="2"/>
			<span>
				<input name='removeButton' type='button' value='Remove Degree' onclick='$(this).parent().parent().parent().remove();' style='width:110px;text-align:center;padding-left:2px;'/>
			</span>
		</div>
	</div>
	<div id="PasswordChanger">
		<script type="text/javascript">
			function showPasswordChanger(){
				$("#FormWin").dialog("option","title","Account Settings");
				$("#FormWin").html($("#PasswordChanger").html());
				$("#FormWin :button").button();
				$("#FormWin").dialog("open");
			}
			function checkAndSubmitPassword(){
				var data={},i=0;
				$("#FormWin input:password").each(function(){
					data[$(this).attr("name")]=$(this).val();
				});
				if(data["new_password"]===data["confirm_new_password"]){
					$.post("<?php echo base_url(); ?>index.php/UserController/changePassword",data,function(data){
						alert(data);
					},"html");
				}else{
					alert("Confirmation failed.");
				}
			}
		</script>
		<form style="text-align:center;">
			<h3>Current Password</h3><input type="password" value="" name="current_password"/><br/>
			<h3>New Password</h3><input type="password" value="" name="new_password"/><br/>
			<h3>Confirm New Password</h3><input type="password" value="" name="confirm_new_password"/><br/><br/>
			<input type="button" value="Change Password" onclick="checkAndSubmitPassword();"/>
		</form>
	</div>
</div>