<?php $this->load->helper("url"); ?>
<script type="text/javascript">
	var sdtSearchForm={
		"Semester":{
			 "type":1,
			 "name":"Sem",
			 "options":{
				"1st":"1",
				"2nd":"2",
				"Summer":"3"}},
		"AY":{"type":4,"name":"AY","name2":"AY2"}
	}
	$(document).ready(function(){
		initializeForm(sdtSearchForm,{"font-weight":"bold","padding-right":"30px"},"searchStdSDTForm");
		$("#searchStdSDTForm>table").append($("<tr></tr>").append("<td></td>").append("<td><input type='button' value='Search SDT History' onclick='requestData();'/></td>"));
		stylizeForm();
	});
	function stylizeForm(){
		$("#searchStdSDTForm td:even").css({"text-align":"right"});
		$("#searchStdSDTForm td:odd>*").css({"width":"90%","margin-right":"30px"});
	}
	function requestData(){
		var input={};
		$("#searchStdSDTForm>table .singleValuedInput").each(function(){
			input[$(this).attr("name")]=$(this).val();
		});
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/10",input,function(data){
			$("#sdtSearchResults").html(data);
		},"html");
	}
</script>
<div class="bor">
	<h4>Search SDT Case</h4>
	<form id="searchStdSDTForm">
		<table style="width: 100%"></table>
		<pre id="sdtSearchResults"></pre>
	</form>
</div>