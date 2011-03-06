<?php $this->load->helper("html");
	  $this->load->helper("url"); ?>
<style type="text/css">
	.column { width:550px; float:left; cursor: pointer;}
	.portlet { margin: 0 0 0 0; width:540px;}
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
	var transForm={
		"Date In":{
			"type":8,
			"value":"<?php echo date("m/d/Y"); ?>"
		},
		"Name":{
			"type":8,
			"value":"<?php echo $_SESSION["loggedIn"]["Last_Name"].", ".$_SESSION["loggedIn"]["First_Name"]." ".$_SESSION["loggedIn"]["Middle_Initial"]; ?>"
		},
		"Student Number":{
			"type":8,
			"value":"<?php echo $_SESSION["loggedIn"]["Student_Number"]; ?>"
		},
		"Classification":{
			"type":1,
			"name":"0",
			"options":{
				"New Freshman":"NF",
				"Old Freshman":"OF",
				"Sophomore":"So",
				"Junior":"J",
				"Senior":"Se"
			}
		},
		<?php if($_SESSION["loggedIn"]["Role"]=="student"){ ?>
		"Course":{
			"type":8,
			"value":"<?php echo $_SESSION["loggedIn"]["Course"]; ?>"
		},
		<?php }else{ ?>
		"Course":{
			"type":0,
			"name":"1"
		},
		<?php } ?>
		"Service":{
			"type":8,
			"value":"<?php echo $_POST["service"]; ?>"
		},
		"Purpose":{
			"type":3,
			"btnValue":"Add Purpose",
			"clickFxn":"addPurposeInfo('purposeInfo');",
			"destDiv":"purposeInfo"
		},
		"Number Of Copies":{
			"type":0,
			"name":"2"
		}
	};
	$(document).ready(function(){
		initializeForm(transForm,{"font-weight":"bold","padding-right":"30px"},"addTransaction");
		$("#addTransaction td:even").css({"text-align":"right"});
		$("#addTransaction tr:odd td:even").css({"background-color":"#fed7b0"});
		$("#addTransaction td:odd>*").css({"width":"90%","margin-right":"30px"});
		$(".dateInput").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
		$("input:button").button();
	});
	function sendData(){
		var input={},i=0;
		$("#addTransaction .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
			$(this).parent().parent().children("td:first").css({"background-color":"#ffffff"});
		});
		$.post("<?php echo base_url();?>index.php/main/transactionDB/1",input,function(data){
			alert("TCG Successfully requested.");
		},"text");
	}
</script>
<div class="bor">
	<h4>Request for <?php echo $_POST["service"]; ?></h4>
	<form id="addTransaction">
		<table style="width: 100%">
			</table><br/>
		<input type="button" class="add" value="Add Transaction" style="width:100%;" onclick="sendData();"/>
	</form>
	<script type="text/javascript">
		function addPurposeInfo(outputDiv){
			$("#"+outputDiv).append($("#prototypes>div.portlet:first").clone());
			formatPortlet($("#"+outputDiv).children("div.portlet:last-child"));
		}
	</script>
	<!--Prototypes-->
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		<div class='portlet'>
			<div class='portlet-header'>
				<input type='text' style="width:250px;margin-top:4px;" name="1"/>
				<span style='float:right'><!--<input class='detailToggleButton' type='button' value='Fill Details' style='width:150px;'/>-->
					<input name='removeButton' type='button' value='Remove Purpose' onclick='$(this).parent().parent().parent().remove();' style='width:150px;'/>
				</span>
			</div>
		</div>
	</div>
</div>