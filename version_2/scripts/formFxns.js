/*
Type:
	0-textbox
	1:select
	2:composite
	3:multivalued
	4:ranged
	5:date
	6:Checkbox
*/
function initializeForm(formArray,labelStyle,destID){
	var row;
	for(i in formArray){
		switch(formArray[i]["type"]){
			case 0:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td><input class='singleValuedInput' type='text' name='"+formArray[i]["name"]+"'/></td>");
				   $("#"+destID+">table").append(row);
				break;
			case 1:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td><select class='singleValuedInput' type='text' name='"+formArray[i]["name"]+"'></select></td>");
				   for(j in formArray[i]["options"]){
						$(row).find("select").append("<option value='"+formArray[i]["options"][j]+"'>"+j+"</option>");
				   }
				   $("#"+destID+">table").append(row);
				break;
			case 2:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td></td>");
				   $("#"+destID+">table").append(row);
				   initializeForm(formArray[i]["childFields"],{},destID);
				break;
			case 3:row=$("<tr></tr>").append($("<td style='vertical-align:center;'>"+i+"</td>").css(labelStyle)).append("<td><div id='"+formArray[i]["destDiv"]+"'></div><span><input type='button' value='"+formArray[i]["btnValue"]+"' name='' onclick=\""+formArray[i]["clickFxn"]+"\"/></span></td>");
				   $("#"+destID+">table").append(row);
				break;
			case 4:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td><span><input class='singleValuedInput' type='text' name='"+formArray[i]["name"]+"'/>-<input type='text' id='"+formArray[i]["name2"]+"'/></span></td>");
				   $("#"+destID+">table").append(row);
				break;
			case 5:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td><span><div class='singleValuedInput dateInput' id='"+formArray[i]["name"]+"' name='"+formArray[i]["name"]+"'></div></span></td>");
				   $("#"+destID+">table").append(row);
				break;
			case 6:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td><input class='singleValuedInput' type='checkbox' name='"+formArray[i]["name"]+"'/></td>");
				   $("#"+destID+">table").append(row);
				break;
			case 7:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td><textarea style='height:50px;' class='singleValuedInput' type='text' name='"+formArray[i]["name"]+"'></textarea></td>");
				   $("#"+destID+">table").append(row);
				break;
			case 8:row=$("<tr></tr>").append($("<td>"+i+"</td>").css(labelStyle)).append("<td>"+formArray[i]["value"]+"</td>");
				   $("#"+destID+">table").append(row);
				break;
			case 9:row=$("<tr></tr>").append($("<td>"+i+"<br/>Confirm "+i+"</td>").css(labelStyle)).append("<td><input class='singleValuedInput' type='"+formArray[i]["formType"]+"' name='"+formArray[i]["name"]+"'/><br/><input type='"+formArray[i]["formType"]+"' id='"+formArray[i]["name"]+"2'/></td>");
				   $("#"+destID+">table").append(row);
				break;
			
		}
	}
}