<script type="text/javascript">
	$(document).ready(function(){
		$("#content>.bor :button").button();
	});
	function goBackToHome(){
		loadUI("main","loadPage","HomePage/main",{},"#content");
	}
</script>
<div class="bor" style="text-align:left">
	<h4>Account Settings of <?php echo $_SESSION["loggedIn"]["Username"]; ?></h4>
	<pre><?php print_r($_SESSION["loggedIn"]); ?></pre>
	<input type="button" value="Go Back" onclick="goBackToHome();" style="width:100%;"/>
</div>