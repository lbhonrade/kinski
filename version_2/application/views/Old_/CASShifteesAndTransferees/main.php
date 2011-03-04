<?php $this->load->helper("url");
	  $category=array(array("CAS Shiftees","stdShifteesDiv","Add Shiftee","Shiftees/add"),
					  array("CAS Transferees","stdTransfereesForm","Add Transferee","Transferees/add")
				);
?>
<script type="text/javascript">
	var subMenu={"<?php echo $category[0][1]; ?>":
					{
					    "Student Number":{"type":0,"name":"Student_Number"}
					 },
				 "<?php echo $category[1][1];?>":
					{
						"Student Number":{"type":0,"name":"Student_Number"}
					 }
				};
	var callerDialog,searchResult;
	function loadFunctionUI(callr,pageURL,mode,input){
		$.post("<?php echo base_url(); ?>index.php/main/loadPage/"+pageBaseURL+"/"+pageURL,input>=0?searchResult[input]:{},function(data){
			switch(mode){
				case 1:$(".right").html(data);break;
				case 2:$("#stdSTDialog").html(data);
					   $("#stdSTDialog").dialog("open");break;
			}
			callerDialog={"src":callr,"pageURL":pageURL,"mode":mode,"input":input};
		},"html");
	}
	$(document).ready(function(){
		var i=0,children,newChild;
		for(category in subMenu){
			initializeForm(subMenu[category],{"font-weight":"bold","padding-right":"30px"},category+">*>.formTable");
			children=$("#"+category+" .formTable>table tr");
			children.each(function(){
				newChild=$("<tr></tr>");
				newChild.append($(this).find("td:odd"));
				$(this).find("td:odd").remove();
				newChild.insertAfter($(this));
			});
			children.find("td").css({"text-align":"center"});
			$("#"+category+" .formTable>table tr:odd *").css({"width":"98%"});
		}
		$("#stdSTAccordion").accordion({
			clearStyle: true,
			fillSpace: false,
			collapsible: true,
			active: -1
		});
		$(".left .fxnBtn").button();
		$( "#stdSTDialog" ).dialog({
			width:'700',
			height:'400',
			top:'0',
			left:'0',
			autoOpen: false,
			closeOnEscape: false,
			title: "Edit",
			resizable: false,
			draggable:false,
			modal: true
		});
	});
	function searchData(category){
		var input={},type;
		var resPanel=$("<div class='bor'><h4>Results</h4></div>");
		$("#"+category+" .singleValuedInput").each(function(){
			if($(this).val().length>0){
				input[$(this).attr("name")]=$(this).val();
			}
		});
		$("#"+category+" .singleValuedInput:checkbox").each(function(){
			input[$(this).attr("name")]=$(this).attr("checked")?"X":"O";
		});
		if(category=="<?php echo $category[0][1]; ?>"){
			type="2%2e1";
		}else if(category=="<?php echo $category[1][1]; ?>"){
			type="6";
		}
		$.post("<?php echo base_url();?>index.php/main/StdShifteesTransfereesDB/"+type,input,function(data){
			//alert(data);
			$(resPanel).append(data);
			$(resPanel).find("table:first").css({"margin":"5px"});
			$(resPanel).find("table tr>td>input:button").each(function(){
				$(this).css({"width":"100%","height":"20px","padding":"0"}).button();
			});
			$(".right").html(resPanel);
		},"html");
	}
</script>
<div class="right"></div>
<div class="left">
	<div id="stdSTAccordion" style="">
	<?php foreach($category as $x){ ?>
		<h3 style="text-indent:30px;padding-bottom:10px;"><?php echo $x[0]; ?></h3>
		<div id="<?php echo $x[1]; ?>">
				<div class="bor categories">
					<h3 style="width:100%;">Insertion Panel</h3>
					<form><input type="button" class="addBtn fxnBtn" value="<?php echo $x[2]; ?>" onclick="loadFunctionUI($(this),<?php echo "'".$x[3]."'";?>,1,-1);" style="width:100%"/></form>
				</div>
				<div class="SEDpanel bor categories">
					<h3 style="width:100%;">Search/Edit/Delete Panel</h3>
					<form class="formTable">
						<table style="width:100%"></table>
						<input type="reset" class="fxnBtn" value="Reset Form" style="width:100%"/>
						<input type="button" class="fxnBtn" value="Search" onclick="searchData('<?php echo $x[1]; ?>');" style="width:100%"/>
					</form>
				</div>
			</div>
	<?php } ?>
	</div>
</div>

<div id="prototypes" style="position:absolute;visibility:hidden;">
<div id="stdSTDialog"></div>
</div>