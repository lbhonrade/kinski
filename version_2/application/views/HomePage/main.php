<?php
	$this->load->helper("url");
?>
<div class="right">
	<div class="bor">
        <h4>About the System</h4>
			<ul style="padding-left:30px;"><li>College of Arts and Sciences Office of the College Secretary Transactions:</li>
				<ul style="padding-left:20px;">
					<li>CAS Students</li>
					<li>CAS Alumni</li>
					<li>Non-CAS Students</li>
				</ul>
			</ul><br/><br/>
			<ul style="padding-left:30px;"><li>Window Reference Guides:</li>
				<ul style="padding-left:20px;">
					<li>Window 1: </li>
					<li>Window 2: </li>
					<li>Window 3: </li>
					<li>Window 4: </li>
					<li>Window 5: </li>
					<li>Window 6: </li>
					</ul>
			</ul><br/><br/>
						<ul style="padding-left:30px;"><li><b>How to make a request?</b></li> 
						<br/>Availing any services from the CAS-OCS? Here's how:
				<ol style="padding-left:20px;">
					<li>If you haven't made a user account here, please do so with your student number as the username. If you already have one, please proceed t step 3. Please finish all the fields required in signing up.</li>
					<li>Wait for the confirmation of any of the administrators for the activation of your account.</li>
					<li>Log-in using your student-number as the username.</li>
					<li>Select the service you want (e.g. TCG).</li>
					<li>Fill-up the form accordingly. Please finish filling up all the fields.</li>
					<li>Don't forget to log-out after you have made the necessary online transactions.</li>
					<li>After you've finished making an online request, have your request validated at the Office of the College Secretary. Take note of your transaction number and the specific window assigned to you.</li>
					<li>Fill-up the manual forms at the College Secretary and pay the fees.</li>
					<li>Have the Office of the College Secretary verify your payment. Again, take note of your specific window assignment.</li>
					<li>Regularly consult the system if your request is already available for pick-up.</li>
					</ol>
			</ul><br/><br/>
	</div>
</div>

<div class="left">
<?php if(isset($_SESSION["loggedIn"])){
	  switch($_SESSION["loggedIn"]["Role"]){
	  case "admin":?>
			<script type="text/javascript">
				function loadPendingRequests(){
					loadUI('AdminController','loadPendingAcctsManager','',{},'.right');
				}
				function manageUserAccts(){
					loadUI('AdminController','loadUserAcctsManager','',{},'.right');
				}
				function loadGenerateReport(){
					loadUI('ReportController','loadSummaryReport','',{}, '.right');
				}
			</script>
			<div class="bor">
				<div class="categories">
					<h3>Administrator Panel</h3>
					<form>
						<input type="button" class="homeButton" value="Manage Approved User Accounts" style="width:100%;" onclick="manageUserAccts();"/>
						<input type="button" class="homeButton" value="Pending User Requests" style="width:100%;" onclick="loadPendingRequests();"/>
						<input type="button" class="homeButton" value="Manage Transactions" style="width:100%;" onclick=""/>
						<input type="button" class="homeButton" value="Generate Report" style="width:100%;" onclick="loadGenerateReport();"/>
					</form>
				</div>
			</div>
	  <?php break;
	  case "alumni":
	  case "student":?>
		<script type="text/javascript">
			function getTCGForm(){
				loadUI("main","loadPage","Services/request",{"service":"True Copy of Grades"},".right");
			}
			function getCertificateForm(){
				loadUI("main","loadPage","Services/request",{"service":"Certificate of Enrolment"},".right");
			}
			function getGoodMoralForm(){
				loadUI("main","loadPage","Services/request",{"service":"Certificate of Good Moral Character"},".right");
			}
			function getClearanceForm(){
				loadUI("main","loadPage","Services/request",{"service":"Clearance"},".right");
			}
			function getRemovalForm(){
				loadUI("main","loadPage","Services/request",{"service":"Removal Slip"},".right");
			}
			function getDismissalForm(){
				loadUI("main","loadPage","Services/request",{"service":"Certificate of Honorable Dismissal"},".right");
			}
		</script>
		<div class="bor">
			<div class="categories">
				<h3>Services</h3>
				<form>
					<input type="button" class="homeButton" value="True Copy of Grades(TCG)" style="width:100%;" onclick="getTCGForm();"/>
					<input type="button" class="homeButton" value="Certificate of Enrolment" style="width:100%;" onclick="getCertificateForm();"/>
					<input type="button" class="homeButton" value="Certificate of Good Moral" style="width:100%;" onclick="getGoodMoralForm();"/>
					<input type="button" class="homeButton" value="Cert. of Honorable Dismissal" style="width:100%;" onclick="getDismissalForm();"/>
					<input type="button" class="homeButton" value="Clearance" style="width:100%;" onclick="getClearanceForm();"/>
					<input type="button" class="homeButton" value="Removal Slip" style="width:100%;" onclick="getRemovalForm();"/>
				</form>
			</div>
		</div>
		<div class="bor">
			<div class="categories">
				<h3>User Panel</h3>
				<form>
					<input type="button" class="homeButton" value="View Transaction Summary" style="width:100%;" onclick=""/>
				</form>
			</div>
		</div>
	<?php }
	}else{ ?>
	<script type="text/javascript">
		function emailResetPassword(){
			var stdNo=$("#DefaultPasswordProvider input[name='0']").val();
			$("#DefaultPasswordProvider input:button").attr("value","Processing...");
			$.post("<?php echo base_url(); ?>index.php/EmailController/sendLoginInfo",{"stdNo":stdNo},function(data){
				$("#DefaultPasswordProvider input:button").attr("value","Reset Password");
				alert(data);
			},"html");
		}
	</script>
	<div class="bor">
		<div class="categories">
			<h3>For Forgetful CAS Registered Students</h3>
			<form id="DefaultPasswordProvider" style="text-align:center;">
				<h2>Enter the following</h2>
				Student Number:<br/>
				<input name="0"/><br/><br/>
				<input class="homeButton" type="button" value="Reset Password" onclick="emailResetPassword();"/><br/><br/>
			</form>
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
			<?php echo date("F/d/Y ");echo ((date("h")+8)%12).":".date("i A");?>
		</div>
	</div>
	<?php } ?>
</div>
<script>
	$(document).ready(function(){
		$(".homeButton").button();
	});
</script>
<!--Prototypes-->
<div id="prototypes" style="position:absolute;visibility:hidden;"></div>