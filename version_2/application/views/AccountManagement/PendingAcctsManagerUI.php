<?php $this->load->helper("url"); ?>
<div class="bor">
	<h4>Pending Accounts</h4>
	<div id="PAManagerPortal">
		Enter Query: <input name="key" type="text" onclick="$(this).val('');" onkeypress="getKeyChar();getPendingUsers('<?php echo base_url(); ?>index.php/AdminController/displayUsers/');"/>
		<input type="button" value="Search" onclick="getPendingUsers('<?php echo base_url(); ?>index.php/AdminController/displayUsers/');"/>
	</div>
	<div id="pendingAcctsSection"></div>
	<div id="pagingSection" style="text-align:center;"></div>
	<script type="text/javascript">
		var pressedKey="";
		$(document).ready(function(){
			$("#PAManagerPortal input:button").button();
			getPendingUsers("<?php echo base_url();?>index.php/AdminController/displayUsers/");
		});
		function formatTable(){
			$("#pendingAcctsTable tbody tr").each(function(){
				$(this).append($("#pendingOptionButtons tr").html());
			});
			$("#pendingAcctsTable tbody input:button").button();
		}
		function getKeyChar(){
			if(window.event) // IE
			{
				pressedKey = event.keyCode;
			}
			else if(e.which) // Netscape/Firefox/Opera
			{
				pressedKey = event.which;
			}
			pressedKey=String.fromCharCode(pressedKey);
		}
		function getPendingUsers(url){
			if(url!='undefined'){
				$("#pendingAcctsSection").html("<div id='pageLoading'></div><br/>");
			}
			$.post(url,{"status":"pending","key":$("input[name='key']").val()+pressedKey},function(data){
				$("#pendingAcctsSection").html(data);
				$("#pagingSection").html("");
				$("#pendingAcctsSection #pageLinks>*").each(function(){
					$("#pagingSection").append("<span style='padding:4px'><a class='"+$(this).attr('class')+"' onclick=\"$(this).css({'font-weight':'bold','text-decoration':'underline'});getPendingUsers('"+$(this).attr('href')+"');\">"+$(this).html()+"</a></span>");
				});
				$("#pagingSection .cur_page").css({"font-weight":"bold","text-decoration":"underline"});
				formatTable();
			});
		}
		function approveUser(caller){
			var user=caller.parent().parent().find('td:first').text();
			var role=caller.parent().parent().find('td:eq(4)').text();
			if(confirm("Approve "+role+" "+user+"?")){
				$.post("<?php echo base_url(); ?>index.php/AdminController/approveUser",{"user":user,"role":role},function(data){
					caller.parent().parent().remove();
					alert(data);
				},"html");
			}
		}
		function disapproveUser(caller){
			var user=caller.parent().parent().find('td:first').text();
			var role=caller.parent().parent().find('td:eq(4)').text();
			if(confirm("Disapprove "+role+" "+user+"?")){
				$.post("<?php echo base_url(); ?>index.php/AdminController/disapproveUser",{"user":user,"role":role},function(data){
					caller.parent().parent().remove();
					alert(data);
				},"html");
			}
		}
		function viewUserProfile(caller){
			var user=caller.parent().parent().find('td:first').text();
			var role=caller.parent().parent().find('td:eq(4)').text();
			$.post("<?php echo base_url(); ?>index.php/AdminController/viewUserProfile",{"user":user,"role":role},function(data){
				$("#FormWin").dialog("option","title","User Profile");
				$("#FormWin").html("<div style='text-align:center;' align='center'></div>");
				$("#FormWin>div").html($("#"+role+"ProfileUI").html());
				for(i in data){
					if(i==4&&role=="alumni"){
						for(j in data[i]){
							$("#FormWin table[name='"+i+"']").append("<tr><td>"+data[i][j]["DP"]+"</td><td>"+data[i][j]["SG"]+"</td><td>"+data[i][j]["YG"]+"</td></tr>");
						}
						$("#FormWin table[name='"+i+"'] td").css({"border":"1px solid #000","text-align":"center"});
					}else{
						$("#FormWin span[name='"+i+"']").html(data[i]);
					}
				}
				$("#FormWin").dialog("open");
			},"json");
		}
	</script>
</div>
<div id="prototypes" style="position:absolute;visibility:hidden;">
	<table id="pendingOptionButtons">
		<tr>
			<td><input type="button" value="View Profile" onclick="viewUserProfile($(this));"/></td>
			<td><input type="button" value="Approve" onclick="approveUser($(this));"/></td>
			<td><input type="button" value="Disapprove" onclick="disapproveUser($(this));"/></td>
		</tr>
	</table>
	<div id="studentProfileUI">
		<h3>Student Number</h3><span name="0"></span><br/><br/>
		<h3>Name</h3><span name="1"></span>,&nbsp;<span name="2"></span>&nbsp;<span name="3"></span><br/><br/>
		<h3>Degree</h3><span name="4"></span><br/><br/>
		<h3>Home Address</h3><span name="5"></span><br/><br/>
		<h3>Contact Number</h3><span name="6"></span><br/><br/>
		<h3>Mobile Number</h3><span name="7"></span><br/><br/>
		<h3>Email Address</h3><span name="8"></span><br/><br/>
	</div>
	<div id="alumniProfileUI">
		<h3>Student Number</h3><span name="0"></span><br/><br/>
		<h3>Name</h3><span name="1"></span>,&nbsp;<span name="2"></span>&nbsp;<span name="3"></span><br/><br/>
		<h3>Degree/s Earned</h3><div align="center"><table name="4" cellspacing="2"><tr style="font-weight:bold"><td>Degree</td><td>Semester Graduated</td><td>Year Graduated</td></tr></table></div><br/><br/>
		<h3>Home Address</h3><span name="5"></span><br/><br/>
		<h3>Office Address</h3><span name="6"></span><br/><br/>
		<h3>Contact Number</h3><span name="7"></span><br/><br/>
		<h3>Mobile Number</h3><span name="8"></span><br/><br/>
		<h3>Email Address</h3><span name="9"></span><br/><br/>
	</div>
</div>