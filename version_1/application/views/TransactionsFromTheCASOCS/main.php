<?php $this->load->helper("url");$this->load->helper("html"); ?>
<style>
	#panelLoading { background-image: url('<?php echo base_url(); ?>images/maroon/loading.gif'); width:100%; height:22px;}
</style>
<script type="text/javascript">
	var subMenu={"Functions":
					{/*"Add":"sendData();",*/
					 "Search":"requestTransaction();"}
				}
	var transForm={
		"Date(IN)":{"type":0,"name":"Date_In"},
		"Name/Unit Who Requested":{"type":0,"name":"Name_Unit_Who_Requested"},
		"Student Number":{"type":0,"name":"Student_Number"},
		"Course/Unit":{"type":0,"name":"Course_Unit"},
		"Indicator":{"type":7,"name":"Indicator"},
		"Operation":{"type":7,"name":"Operation"},
		"Code":{"type":0,"name":"Code"},
		"Count":{"type":0,"name":"Count"},
		"Signed/Performed By":{"type":0,"name":"Signed_Performed_By"},
		"Received By":{"type":0,"name":"Received_By"},
		"Date(OUT)":{"type":0,"name":"Date_Out"}
	};
	function loadFunctionUI(pageURL){
		$(".right").html("<?php echo br(7); ?><div id='pageLoading' onload=\"$('#panelLoading').progressbar({value:100});\"></div>");
		$.post("<?php echo base_url();?>index.php/main/loadPage/"+pageBaseURL+"/"+pageURL,function(data){
			$(".right").html(data);
		},"html");
	}
	$(document).ready(function(){
		var i=0,panel="";
		for(category in subMenu){
			for(menu in subMenu[category]){
				if(subMenu[category][menu]!=null){
					$("<input type=\"button\" id=\"fxnBtn"+i+"\" name=\"fxnButton\" value=\""+menu+"\" onclick=\""+subMenu[category][menu]+"\" style=\"width:100%\"/><br/>").appendTo("#transactionForm");
					i++;
				}else{
					panel=panel+menu;
				}
			}
			$(panel).appendTo(".left");
		}
		$(".left input:button,input:reset").button();
		initializeForm(transForm,{"font-weight":"bold"},"transactionForm");
		$("#editWin>table").html("");
		initializeForm(transForm,{"font-weight":"bold"},"editWin");
		$("<input type=\"button\" onclick='updateTransaction();' value=\"Save Changes\" style=\"width:100%;\"/>").appendTo("#editWin").button();
		stylizeForm("transactionForm");
		stylizeForm("editWin");
		$( "#editWin" ).dialog({
			width:'auto',
			autoOpen: false,
			closeOnEscape: false,
			title: "Edit Transaction",
			resizable: false,
			draggable:false,
			modal: true
		});
	});
	function stylizeForm(id){
		$("#"+id+" table td:even").css({"text-align":"right","width":"40%"});
		$("#"+id+" td:odd>*").css({"width":"98%","margin-right":"2%"});
		$("#"+id+" td:odd").css({"width":"60%"});
		$("#"+id+" td").css({"padding-top":"2px","padding-bottom":"2px"});
		$("input[name='Date_In'],input[name='Date_Out']").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
	}
	function requestTransaction(){
		var input={};
		var resPanel=$("<div class='bor'><h4>Results</h4></div>");
		$("#transactionForm .singleValuedInput").each(function(){
			if($(this).val().length>0){
				input[$(this).attr("name")]=$(this).val();
			}
		});
		$(".right").html("<?php echo br(7); ?><div id='pageLoading' onload=\"$('#panelLoading').progressbar({value:100});\"></div>");
		$.post("<?php echo base_url();?>index.php/main/transactionDB/2",input,function(data){
			$(resPanel).append(data);
			$(resPanel).find("table:first").css({"margin":"5px"});
			$(resPanel).find("table tr>td>input:button").each(function(){
				$(this).css({"width":"100%","height":"20px","padding":"0"}).button();
			});
			$(".right").html(resPanel);
		},"html");
	}
	var editingId=-1,editingRow="";
	function editTransaction(caller,id){
		$.post("<?php echo base_url();?>index.php/main/transactionDB/2%2e1",{"Transaction_ID":id},function(data){
			for(i in data[0]){
				$("#editWin *[name='"+i+"']").val(data[0][i]);
			}
			$("#editWin div[name='Date_In']").datepicker("setDate",data[0]['Date_In']);
			$("#editWin div[name='Date_Out']").datepicker("setDate",data[0]['Date_Out']);
			editingId=id;
			editingRow=caller;
			$("#editWin").dialog("open");
		},"json");
	}
	function updateTransaction(){
		var input={"primaryKey":{"Transaction_ID":editingId},"nonPrimaryKey":{}},i=0;
		$("#editWin .singleValuedInput").each(function(){
			input["nonPrimaryKey"][$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/transactionDB/3",input,function(data){
			$("#editWin").dialog("close");
			alert(data);
			editingRow.parent().siblings().each(function(){
				$(this).remove();
			});
			editingRow=editingRow.parent().parent();
			for(i in input["nonPrimaryKey"]){
				editingRow.append("<td>"+input["nonPrimaryKey"][i]+"</td>");
			}
		},"html");
	}
	function deleteTransaction(caller,id){
		if(confirm("Delete this transaction?")){
			$.post("<?php echo base_url();?>index.php/main/transactionDB/4",{"Transaction_ID":id},function(data){
				alert("Transaction Deleted.");
				caller.parent().parent().remove();
			});
		}
	}
</script>
<div class="right">
</div>
<div class="left">
	<div class="bor categories">
		<h3>Admin Panel</h3>
		<form>
			<table style="width: 100%">
			</table>
			<input type="button" value="Add Transaction" onclick="loadFunctionUI('TransactionsCASOCS/add');" style="width:100%"/>
			<a href="<?php echo base_url(); ?>index.php/main/genPDFReport/6"><input type="button" value="Generate Report" style="width:100%"/></a>
		</form>
	</div>
	<div class="bor categories">
		<h3>Search/Edit/Delete Panel</h3>
		<form id="transactionForm">
			<table style="width: 100%">
			</table>
			<input type="reset" value="Reset Form" style="width:100%"/>
		</form>
	</div>
</div>
<!--Prototypes-->
<div id="prototypes" style="position:absolute;visibility:hidden;">
	<div id="editWin">
		<table style="width: 100%"></table>
	</div>
</div>