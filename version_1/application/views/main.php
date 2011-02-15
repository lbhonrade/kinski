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
		echo script_tag("scripts/ui/minified/jquery.ui.accordion.min.js");
		echo script_tag("scripts/ui/minified/jquery.ui.progressbar.min.js");
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
		var currentPage=-1;
		var pageBaseURL="";
		var menuLbl=new Array("Home","CAS Student Registry","CAS Shiftees and Transferees","Transactions from the<br/>CAS-OCS"),
		    menuBaseDIR=new Array("HomePage","CASStudentRegistry","CASShifteesAndTransferees","TransactionsFromTheCASOCS");
		$(document).ready(function(){
			for(i in menuLbl){
				$("#menu>ul").append("<li id=\"menu"+i+"\"><a href=\"#\" style=\"border-right: 1px solid #ffffff;\" onclick=\"loadPage('"+menuBaseDIR[i]+"','main',"+i+");\">"+menuLbl[i]+"</a></li>");
			}
			loadPage("HomePage","main",0);
			$("input[name='AY']").live("change",function(){
				$(this).siblings("input[id='AY2']").attr("value",$(this).val()*1+1)
			});
		});
		function loadPage(baseDIR,pageURL,id){//<img src='<?php echo base_url(); ?>images/maroon/loading.gif'/>
			if(id==currentPage) return;
			document.getElementById("content").innerHTML="<div class=\"right\" style=\"text-align:center;width:100%;\"><div id='pageLoading' onload=\"$('#pageLoading').progressbar({value: 100});\"></div></div>";
			if(currentPage>=0){
				$("#menu"+currentPage).removeClass("current");
			}
			$("#menu"+id).addClass("current");
			currentPage=id;
			pageBaseURL=baseDIR;
			$.post("<?php echo base_url();?>index.php/main/loadPage/"+baseDIR+"/"+pageURL+"/",function(data){
				$("#content").html(data);
			},"html");
		}
	</script>
</head>
<body>
<div id="header_bg">
	<div id="header"> 
		<img src="<?php echo base_url(); ?>images/maroon/caslogo.png"/>
		<div id="logo">
			<h1><a>database management system for cas student registry<br/>and student records evaluator transactions</a></h1>
			<h2><a id="metamorph">Project in CMSC 128 AB1L</a></h2>
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
	<p>The Team<br/>CMSC 128 AB-1L Group 1</p>
</div>
</body>
</html>
