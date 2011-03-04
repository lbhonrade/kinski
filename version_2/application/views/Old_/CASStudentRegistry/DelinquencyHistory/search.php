<?php $this->load->helper("url"); ?>
<script type="text/javascript">
	$(document).ready(function(){
		stylizeForm();
	});
	function stylizeForm(){
		$("#searchStdDelinForm td:even").css({"text-align":"right"});
		$("#searchStdDelinForm td:odd>*").css({"width":"90%","margin-right":"30px"});
	}
	function changeDelinCategory(x){
		$("#delinCategoryInput").html("");
		$("#searchCategories>*[name='"+x+"']").appendTo("#delinCategoryInput");
	}
	function requestData(){
		var input={};
		$("#searchStdDelinForm .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/6",input,function(data){
			//alert(data);
			$("#delinSearchResults").html(data);
		},"html");
	}
</script>
<div class="bor">
	<h4>Search Student Delinquents</h4>
	<form style="margin-left:10px;" id="searchStdDelinForm">
		Semester:<select class="singleValuedInput" name="Semester"><option value="1">1st</option><option value="2">2nd</option><option value="3">Summer</option></select>AY<input class="singleValuedInput" type='text' name="AY"/>-<input type='text' id="AY2"/><br/>
		<select style="margin-left:57px;" onchange="changeDelinCategory($(this).val());"><option>Remarks</option><option>Status</option></select>
		<span id="delinCategoryInput"><input class="singleValuedInput" name="Remarks"/></span>
		<input type="button" value="Search Delinquency History" onclick="requestData();"/><br/><br/>
	</form>
	<pre id="delinSearchResults"></pre>
	<div id="prototypes" style="position:absolute;visibility:hidden;">
		<div id="searchCategories">
			<select class="singleValuedInput" name="Status"><option>University Scholar</option><option>College Scholar</option><option>Honor Roll</option><option>Good</option><option>Warning</option><option>Probation</option><option>Dismissed</option></select>
			<input class="singleValuedInput" name="Remarks"/>
		</div>
	</div>
</div>