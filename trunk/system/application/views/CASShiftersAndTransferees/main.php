<?php $this->load->helper("url");?>
<script type="text/javascript">
	var subMenu={"CAS Shifters":
					{"Add":"Shifters/add",
					 "Search":"Shifters/search",
					 "Edit":"Shifters/edit",
					 "Delete":"Shifters/delete"},
				 "CAS Transferees":
					{"Add":"Transferees/add",
					 "Search":"Transferees/search",
					 "Edit":"Transferees/edit",
					 "Delete":"Transferees/delete"}};
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
<div id="left"></div>