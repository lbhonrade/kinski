<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>CMSC 128</title>
	<?php
		$this->load->helper("html");
		$this->load->helper("url");
		echo link_tag("css/themes/smoothness/jquery-ui.css");
		echo link_tag("css/styleMaroon.css");
		//echo link_tag("css/themes/cupertino/jquery-ui.css");
		//echo link_tag("css/styleViolet.css");
		echo script_tag("scripts/jquery-1.4.4.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.core.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.widget.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.button.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.datepicker.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.progressbar.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.draggable.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.position.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.resizable.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.dialog.min.js");
		//echo script_tag("scripts/ui/minified/jquery.ui.accordion.min.js");
		//echo script_tag("scripts/ui/minified/jquery.ui.progressbar.min.js");
		// echo script_tag("scripts/ui/jquery.ui.core.js");
		// echo script_tag("scripts/ui/jquery.ui.widget.js");
		// echo script_tag("scripts/ui/jquery.ui.button.js");
		// echo script_tag("scripts/ui/jquery.ui.datepicker.js");
		// echo script_tag("scripts/ui/jquery.ui.progressbar.js");
		// echo script_tag("scripts/ui/jquery.ui.draggable.js");
		// echo script_tag("scripts/ui/jquery.ui.position.js");
		// echo script_tag("scripts/ui/jquery.ui.resizable.js");
		// echo script_tag("scripts/ui/jquery.ui.dialog.js");
		echo script_tag("scripts/formFxns.js");
		//echo script_tag("scripts/ui/jquery.ui.mouse.js");
		//echo script_tag("scripts/ui/jquery.ui.sortable.js");
		//echo script_tag("scripts/ui/jquery.ui.tabs.js");
		//echo script_tag("scripts/ui/jquery.effects.core.js");
		//echo script_tag("scripts/ui/jquery.effects.bounce.js");
		//echo script_tag("scripts/ui/jquery.effects.explode.js");
		//echo script_tag("scripts/ui/jquery.effects.fold.js");
		//echo script_tag("scripts/ui/jquery.effects.scale.js");
	?>
	<style>
		#pageLoading { background-image: url('<?php echo base_url(); ?>images/maroon/loading.gif'); width:50%; height:22px; margin-left:25%;}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			loadUI("main","loadPage","HomePage/main",{},"#content");
			<?php
			if(isset($_SESSION["loggedIn"])){
			?>
				$("#loginPanel").html($("#logoutForm").html());
				$("#loginPanel span").html("<?php echo $_SESSION["loggedIn"]["Username"]; ?>");
			<?php }else{?>
				$("#loginPanel").html($("#loginForm").html());
			<?php }?>
			$("#loginPanel :button").button();
			$( "#FormWin" ).dialog({
				width:'auto',
				autoOpen: false,
				closeOnEscape: false,
				title: "",
				resizable: false,
				draggable:false,
				modal: true
			});
			$( "#RoleSelector" ).dialog({
				width:'auto',
				autoOpen: false,
				closeOnEscape: true,
				title: "Sign Up",
				resizable: false,
				draggable:false,
				modal: true,
				buttons: {
					"Student": function() {
						loadUI('main','loadPage','sign_up',{"newUserType":"Student"},'#content');
						$( this ).dialog( "close" );
					},
					"Alumni": function() {
						loadUI('main','loadPage','sign_up',{"newUserType":"Alumni"},'#content');
						$( this ).dialog( "close" );
					}
				}
			});
		});
		function loadUI(CI_Class,CI_Fxn,CI_Params,data,destDiv){
			$(destDiv).html("<div id='pageLoading' onload=\"$('#panelLoading').progressbar({value:100});\"></div>");
			$.post("<?php echo base_url();?>index.php/"+CI_Class+"/"+CI_Fxn+"/"+CI_Params,data,function(data){
				$(destDiv).html(data);
			},"html");
		}
	</script>
	<script type="text/javascript">
		function sendLogin(){
			$.post("<?php echo base_url(); ?>index.php/main/login",
				{"username":$("input[name='username']").val(),"password":$("input[name='password']").val()},
				function(data){
					if(data[0]=='1'){
						$("#loginPanel").html($("#logoutForm").html());
						$("#loginPanel span").html(data[1]);
						$("#loginPanel :button").button();
						loadUI("main","loadPage","HomePage/main",{},"#content");
					}else{
						alert("Logging In Failed!");
					}
					//alert(data);
				},"json");
		}
		function logout(){
			$.post("<?php echo base_url(); ?>index.php/main/logout",function(){
				loadUI("main","loadPage","HomePage/main",{},"#content");
				$("#loginPanel").html($("#loginForm").html());
				$("#loginPanel :button").button();
				alert("Successfully logged out.");
			});
		}
		function new_user(){
			$("#RoleSelector").dialog("open");
		}
	</script>
</head>
<body>
<div id="header_bg">
	<div id="header">
		<img src="<?php echo base_url(); ?>images/maroon/caslogo.png"/>
		<div id="logo">
			<h1><a>CAS-OCS Window Transaction Management System</a></h1>
			<div id="loginPanel" style="color:#ffffff" align="center"></div>
		</div>
	</div>
</div>
<div id="menu_bg">
	<div id="menu"><ul></ul></div>
</div>
<div id="main">
	<div id="content"></div>
</div>
<div id="footer">
	<p>The Team<br/>Project of CMSC 128 AB-1L Group 1</p>
</div>
<!--Prototypes-->
<div id="prototypes" style="position:absolute;visibility:hidden;">
	<div id="loginForm">
		<table>
			<tr><td>Username:</td><td><input name="username"/></td><td>Password:</td><td><input name="password" type="password"/></td><td><input type="button" value=" Login " name="loginBtn" onclick="sendLogin();"/></td><td><input type="button" value=" Sign Up " name="signupBtn" onclick="new_user();"/></td></tr>
		</table>
	</div>
	<div id="logoutForm">
		<table>
			<tr><td>Logged in as</td><td><span></span></td><td></td><td style="float:right;"><input type="button" value=" Logout " name="logoutBtn" onclick="logout();"/><input type="button" value=" Account Settings " name="accountBtn" onclick="loadUI('UserController','ViewUserAccount','',{},'#content');"/></td></tr>
		</table>
	</div>
	<div id="FormWin">
		<table style="width: 100%"></table>
	</div>
	<div id="RoleSelector" style="text-align:center;"><br/><h3>Select User Type</h3></div>
</div>
</body>
</html>
