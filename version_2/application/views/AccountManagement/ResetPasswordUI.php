<html>
<head>
	<?php $this->load->helper("html");
		  $this->load->helper("url");
		  echo script_tag("scripts/jquery-1.4.4.min.js");
	?>
	<script type="text/javascript">
		var a="a";
		var b="b";
		while(!(a===b)||a==""||a==null){
			a=prompt("Enter New Password.");
			b=prompt("Confirm new password.");
		}
		$.post("<?php echo base_url(); ?>index.php/UserController/resetPassword/_/_/"+a,function(data){
			alert(data);
		});
	</script>
</head>
<body></body>
</html>