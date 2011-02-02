<?php $this->load->helper("url");?>
<script type="text/javascript">
	var subMenu={"CAS Student Registry":
					{"Add":"StudentRegistry/add",
					 "Edit":"StudentRegistry/edit",
					 "Delete":"StudentRegistry/delete"},
				 "CAS Student's Delinquency History":
					{"Add":"DelinquencyHistory/add",
					 "Search":"DelinquencyHistory/search",
					 "Edit":"DelinquencyHistory/edit",
					 "Delete":"DelinquencyHistory/delete"
					 //"<br/>":null,
					 //"Generate Report":""
					 },
				 "CAS Student's SDT History":
					{"Add":"SDTHistory/add",
					 "Search":"SDTHistory/search",
					 "Edit":"SDTHistory/edit",
					 "Delete":"SDTHistory/delete"}};
	function loadFunctionUI(pageURL){
		$.post("<?php echo base_url();?>index.php/main/loadPage/"+pageBaseURL+"/"+pageURL,function(data){
			$("#right").html(data);
		},"html");
	}
	$(document).ready(function(){
		var i=0,panel="";
		for(category in subMenu){
			panel="<div class=\"bor\"><div class=\"categories\"><h3>"+category+"</h3>";
			for(menu in subMenu[category]){
				if(subMenu[category][menu]!=null){
					panel=panel+"<input type=\"radio\" id=\"fxnBtn"+i+"\" name=\"fxnButton\" onclick=\"loadFunctionUI('"+subMenu[category][menu]+"')\"/><label for=\"fxnBtn"+i+"\">"+menu+"</label><br/>";
					i++;
				}else{
					panel=panel+menu;
				}
			}
			$(panel+"</div></div>").appendTo("#left");
		}
		$("#left").buttonset();
	});
</script>
<div id="right"></div>
<form>
	<div id="left"></div>
</form>