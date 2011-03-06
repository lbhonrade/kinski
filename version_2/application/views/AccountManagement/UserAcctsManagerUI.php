<?php $this->load->helper("url"); ?>
<div class="bor">
	<h4>Approved Accounts</h4>
	<div id="UAManagerPortal">
		Enter Query: <input name="key" type="text" onclick="$(this).val('');" onkeypress="getKeyChar();getApprovedUsers('<?php echo base_url(); ?>index.php/AdminController/displayUsers/');"/>
		<input type="button" value="Search" onclick="getApprovedUsers('<?php echo base_url(); ?>index.php/AdminController/displayUsers/');"/>
	</div>
	<div id="approvedAcctsSection"></div>
	<div id="pagingSection" style="text-align:center;"></div>

	<script type="text/javascript">
		var pressedKey="";
		$(document).ready(function(){
			$("#UAManagerPortal input:button").button();
			getApprovedUsers("<?php echo base_url();?>index.php/AdminController/displayUsers/");
		});
		function formatTable(){
			$("#approvedAcctsTable tbody tr").each(function(){
				$(this).append($("#pendingOptionButtons tr").html());
			});
			$("#approvedAcctsTable tbody input:button").button();
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
		function getApprovedUsers(url){
			if(url!='undefined'){
				$("#approvedAcctsSection").html("<div id='pageLoading'></div><br/>");
			}
			$.post(url,{"status":"approved","key":$("input[name='key']").val()+pressedKey},function(data){
				$("#approvedAcctsSection").html(data);
				$("#pagingSection").html("");
				$("#approvedAcctsSection #pageLinks>*").each(function(){
					$("#pagingSection").append("<span style='padding:4px'><a class='"+$(this).attr('class')+"' onclick=\"$(this).css({'font-weight':'bold','text-decoration':'underline'});getApprovedUsers('"+$(this).attr('href')+"');\">"+$(this).html()+"</a></span>");
				});
				$("#pagingSection .cur_page").css({"font-weight":"bold","text-decoration":"underline"});
				formatTable();
			});
		}
		function openUserProfile(caller){
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
						$("#FormWin input[name='"+i+"']").val(data[i]);
					}
				}
				$("#FormWin input").css({"text-align":"center"});
				$("#FormWin").dialog("open");
			},"json");
		}
	</script>
</div>
<div id="prototypes" style="position:absolute;visibility:hidden;">
	<table id="pendingOptionButtons">
		<tr>
			<td><input type="button" value="View/Edit Profile" onclick="openUserProfile($(this));"/></td>
		</tr>
	</table>
	<div id="studentProfileUI">
		<h3>Student Number</h3><input name="0" disabled="disabled"/><br/><br/>
		<h3>Name</h3><input name="1"/>,&nbsp;<input name="2"/>&nbsp;<input name="3"/><br/><br/>
		<h3>Degree</h3><input name="4"/><br/><br/>
		<h3>Home Address</h3><input name="5"/><br/><br/>
		<h3>Contact Number</h3><input name="6"/><br/><br/>
		<h3>Mobile Number</h3><input name="7"/><br/><br/>
		<h3>Email Address</h3><input name="8"/><br/><br/>
	</div>
	<div id="alumniProfileUI">
		<h3>Student Number</h3><input name="0" disabled="disabled"/><br/><br/>
		<h3>Name</h3><input name="1"/>,&nbsp;<input name="2"/>&nbsp;<input name="3"/><br/><br/>
		<h3>Degree/s Earned</h3><div align="center"><table name="4" cellspacing="2"><tr style="font-weight:bold"><td>Degree</td><td>Semester Graduated</td><td>Year Graduated</td></tr></table></div><br/><br/>
		<h3>Home Address</h3><input name="5"/><br/><br/>
		<h3>Office Address</h3><input name="6"/><br/><br/>
		<h3>Contact Number</h3><input name="7"/><br/><br/>
		<h3>Mobile Number</h3><input name="8"/><br/><br/>
		<h3>Email Address</h3><input name="9"/><br/><br/>	
	</div>
</div>