<?php $this->load->helper("url"); ?>
<script type="text/javascript">
	function sendLogin(){
		$.post("<?php echo base_url(); ?>index.php/main/login",
			{"username":$("input[name='username']").val(),"password":$("input[name='password']").val()},
			function(data){
				if(data[0]=='1'){
					$("#loginPanel").html($("#logoutForm").html());
					$("#loginPanel span").html(data[1]);
				}
				//alert(data);
			},"json");
	}
	function logout(){
		$.post("<?php echo base_url(); ?>index.php/main/logout",function(){
			alert("Successfully logged out.");
			$("#loginPanel").html($("#loginForm").html());
		});
	}
</script>

<div id="right">
	<div class="bor">
        <h4>About the System</h4>
			<ul style="padding-left:30px;"><li>Management System for the Following Databases:</li>
				<ul style="padding-left:20px;">
					<li>CAS Students&#39; Delinquency and SDT History</li>
					<li>CAS Shifters and Transferees</li>
					<li>Transactions from the CAS Student Evaluator</li>
					<li>OPES Reference Table</li></ul>
			</ul><br/><br/>
	</div>
</div>

<div id="left">
	<div class="bor">
		<div class="categories">
			<h3>Login</h3>
			<form>
			<div id="loginPanel">
			</div></form><br/>
		</div>
	</div>
	<div class="bor">
		<div class="categories">
			<h3>Developers</h3>
			<ul style="padding-left:60px;">
				<li>Brecenio, Irish N.</li>
				<li>Honrade, Lambert B.</li>
				<li>Jose, Mark Joseph N.</li>
				<li>Manansala, Angelie O.</li>
				<li>Pendon, Ferdinand C.</li>
			</ul>
		</div>
	</div>
</div>

<!--Prototypes-->
<div id="prototypes" style="position:absolute;visibility:hidden;">
	<div id="loginForm">
		<table>
			<tr><td>Username:</td><td><input name="username"/></td></tr>
			<tr><td>Password:</td><td><input name="password" type="password"/></td></tr>
			<tr><td></td><td style="float:right;"><input type="button" value=" Login " name="loginBtn" onclick="sendLogin();"/></td></tr>
		</table>
	</div>
	<div id="logoutForm">
		<table>
			<tr><td>Logged in as </td><td><span></span></td></tr>
			<tr><td></td><td style="float:right;"><input type="button" value=" Logout " name="logoutBtn" onclick="logout();"/></td></tr>
		</table>
	</div>
</div>
<script type="text/javascript">
<?php
if(isset($_SESSION["loggedIn"])){
?>
	$("#loginPanel").html($("#logoutForm").html());
	$("#loginPanel span").html("<?php echo $_SESSION["loggedIn"]; ?>");
<?php }else{?>
	$("#loginPanel").html($("#loginForm").html());
<?php }?>
</script>