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
		$("#studentAccount input:text").each(function(){
			data[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url(); ?>index.php/UserController/updateContactInfo",data,function(data){
			alert(data);
		},"html");
	}
</script>
<div class="bor" style="text-align:left">
	<h4>Account Settings of <?php echo $_SESSION["loggedIn"]["Username"]; ?></h4>
	<form id="studentAccount" style="text-align:center;">
		<table style="width:100%;"><tr><td style="vertical-align:top;">
		<h3>Student Number</h3><?php echo $_SESSION["loggedIn"]["Student_Number"]; ?><br/><br/>
		<h3>Name</h3><?php echo $_SESSION["loggedIn"]["Last_Name"].", ".$_SESSION["loggedIn"]["First_Name"]." ".$_SESSION["loggedIn"]["Middle_Initial"]; ?><br/><br/>
		<h3>Degree</h3><?php echo $_SESSION["loggedIn"]["Degree"]; ?><br/><br/>
		</td><td style="vertical-align:top;">
		<h3>Password</h3><input type="button" value="Change Password" style="text-align:center;width:300px;" onclick="showPasswordChanger();"/><br/><br/>
		<h3>Home Address</h3><input name="5" type="text" value="<?php echo $_SESSION["loggedIn"]["Home_Address"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		<h3>Contact Number</h3><input name="6" type="text" value="<?php echo $_SESSION["loggedIn"]["Contact_Number"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		<h3>Mobile Number</h3><input name="7" type="text" value="<?php echo $_SESSION["loggedIn"]["Mobile_Number"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		<h3>Email Address</h3><input name="8" type="text" value="<?php echo $_SESSION["loggedIn"]["Email_Address"]; ?>" style="text-align:center;width:300px;"/><br/><br/>
		</td></tr>
		</table>
		<input type="button" class="add" value="Save Changes" style="width:88%;margin-left:1%;" onclick="updateContactInfo();"/>
		<input type="button" value="Go Back" onclick="goBackToHome();" style="width:10%;margin-right:0px;"/>
	</form>
</div>
<div id="prototypes" style="position:absolute;visibility:hidden;">
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