<?php $this->load->helper("url");
$category=array(array("CAS Student Registry","stdRegDiv","Add Student","StudentRegistry/add"),
				array("CAS Students' Delinquency History","stdDelinForm","Add Delinquency Case","DelinquencyHistory/add"),
				array("CAS Students' SDT History","stdSDTDiv","Add SDT Case","SDTHistory/add"));
?>
<script type="text/javascript">
	var subMenu={"<?php echo $category[0][1]; ?>":
					{
					    "Student Number":{"type":0,"name":"Student_Number"},			
						"Name":{"type":2,
								"childFields":{
									"Last Name":{"type":0,"name":"Last_Name"},
									"First Name":{"type":0,"name":"First_Name"},
									"Middle Initial":{"type":0,"name":"Middle_Initial"}}},
						"Degree Program":{"type":1,
										  "name":"Course",
										  "options":{
											"":"",
											"BS Computer Science":"BSCS",
											"BA Communication Arts":"BACA",
											"BS Biology":"BSBio",
											"BA Sociology":"BSSocio",
											"BS Applied Physics":"BSAP",
											"BS Statistics":"BSStat",
											"BS Mathematics":"BSMath",
											"BS Applied Mathematics":"BSAM",
											"BS Chemistry":"BSChem"}},
						"Major":{"type":0,"name":"Major"},
						"Title of Thesis":{"type":0,"name":"Title_Thesis"},
						"Classification at the Start of Semester":{"type":1,
										 "name":"Classification_Start",
										 "options":{
											"":"",
											"New Freshman":"NF",
											"Old Freshman":"OF",
											"Sophomore":"So",
											"Junior":"J",
											"Senior":"Se"}},
						"Classification at the End of Semester":{"type":1,
										 "name":"Classification_End",
										 "options":{
											"":"",
											"None":"None",
											"New Freshman":"NF",
											"Old Freshman":"OF",
											"Sophomore":"So",
											"Junior":"J",
											"Senior":"Se"}},
						"General Weighted Average":{"type":0,"name":"GWA"},
						"Total Number of Units":{"type":0,"name":"Unit"},
						"RES":{"type":0,"name":"Res"},
						"Adviser":{"type":0,"name":"Adviser"},
						"Registration Adviser":{"type":0,"name":"Reg_Adviser"}
					 },
				 "<?php echo $category[1][1];?>":
					{
						"Student Number":{"type":0,"name":"Student_Number"},
						"Semester":{"type":1,
									 "name":"Semester",
									 "options":{
										"":"",
										"1st":"1",
										"2nd":"2",
										"Summer":"3"}},
						"AY":{"type":4,"name":"AY","name2":"AY2"},
						"Has Form 5":{"type":6,"name":"Form5"},
						"Form5A":{"type":0,"name":"Form5A"},
						"Academic Status":{"type":1,
									 "name":"Status",
									 "options":{
										"":"",
										"University Scholar":"University Scholar",
										"College Scholar":"College Scholar",
										"Honor Roll":"Honor Roll",
										"Good":"Good",
										"Warning":"Warning",
										"Probation":"Probation",
										"Dismissed":"Dismissed"}},
						"Remarks":{"type":0,"name":"Remarks"},
						"Date":{"type":0,"name":"Date"}
					 },
				 "<?php echo $category[2][1];?>":
					{
						"Student Number":{"type":0,"name":"Student_Number"},
						"Case Number":{"type":0,"name":"Case_Number"},
						"Semester":{"type":1,
									 "name":"Sem",
									 "options":{
										"":"",
										"1st":"1",
										"2nd":"2",
										"Summer":"3"}},
						"AY":{"type":4,"name":"AY","name2":"AY2"},
						"Academic Status":{"type":1,
									 "name":"Academic_Status",
									 "options":{
										"":"",
										"University Scholar":"University Scholar",
										"College Scholar":"College Scholar",
										"Honor Roll":"Honor Roll",
										"Good":"Good",
										"Warning":"Warning",
										"Probation":"Probation",
										"Dismissed":"Dismissed"}},
						"Remarks":{"type":0,"name":"Remarks"},
						"Case Status":{"type":0,"name":"Case_Status"},
						"Date Ordered":{"type":0,"name":"Date_Ordered"},
						"Date Effective":{"type":0,"name":"Date_Effective"}
					 }
				};
	var callerDialog,searchResult;
	function loadFunctionUI(callr,pageURL,mode,input){
		$.post("<?php echo base_url(); ?>index.php/main/loadPage/"+pageBaseURL+"/"+pageURL,input>=0?searchResult[input]:{},function(data){
			switch(mode){
				case 1:$(".right").html(data);break;
				case 2:$("#stdRegDialog").html(data);
					   $("#stdRegDialog").dialog("open");break;
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
		$("input[name='Date'],input[name='Date_Ordered'],input[name='Date_Effective']").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd"
		});
		$("#stdRegAccordion").accordion({
			clearStyle: true,
			fillSpace: false,
			collapsible: true,
			active: -1
		});
		$(".left .fxnBtn").button();
		$( "#stdRegDialog" ).dialog({
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
		}else if(category=="<?php echo $category[2][1]; ?>"){
			type="10";
		}
		$.post("<?php echo base_url();?>index.php/main/StdRegistryDB/"+type,input,function(data){
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
	<div id="stdRegAccordion" style="">
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
<div id="stdRegDialog"></div>
</div>