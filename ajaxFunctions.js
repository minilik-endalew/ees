// JavaScript Documentfunction showSignUpForm()
function ajax_load(where,what)
{   
//alert("huh");
try{
	var xmlhttp;
	document.getElementById("loading").style.display='block';
	//alert(where +"," + what);	
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
				  //alert("this")
          }
        else
          {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  //alert("that")
          }
        xmlhttp.onreadystatechange=function()
          {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                  {
                            document.getElementById(where).innerHTML=xmlhttp.responseText;
							document.getElementById("loading").style.display='none';
                  }
          }
        xmlhttp.open("GET",what,true);		
        xmlhttp.send();		
}
catch(e)
{
	alert(e);
}

}

//##################################################################################
//## FORM SUBMIT WITH AJAX                                                        ##
//## @Author: Millo                                                               ##
//##################################################################################
function ajaxPost(strURL,formname,responsediv) {
	//alert(strURL +" , "+ formname +" , "+ responsediv );
    var xmlHttpReq = false;
    var self = this;
    // Xhr per Mozilla/Safari/Ie7
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // per tutte le altre versioni di IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
	document.getElementById("loading").style.display='block';
	/*
	document.getElementById("loading").style.position='fixed';
	document.getElementById("loading").style.width='500px';
	document.getElementById("loading").style.zIndex=1;
	document.getElementById("loading").style.left='100px';
	
	display:none;
	position:fixed;
	clear:both;
	width: 900px;
	height:auto;
	z-index: 1;
	left: 100px;
	top: 179px;
	margin-left:10px;
	*/
	
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
			//alert(strURL);
			// Quando pronta, visualizzo la risposta del form
			//alert(strURL +" , "+ formname +" , "+ responsediv +" , "+ responsemsg)
            updatepage(self.xmlHttpReq.responseText,responsediv);
        }
		else{
			// In attesa della risposta del form visualizzo il msg di attesa
			//alert(responsediv);
			//updatepage(self.xmlHttpReq.responseText,responsediv);
			updatepage(responsemsg,responsediv);
		}
    }
    self.xmlHttpReq.send(getquerystring(formname));
	}
function shake(){
    $('#div').animate({
        'margin-left': '-=5px',
        'margin-right': '+=5px'
    }, 200, function() {
        $('#div').animate({
            'margin-left': '+=5px',
            'margin-right': '-=5px'
        }, 200, function() {
            //and so on...
        });
    });
}
function getquerystring(formname) {
    var form = document.forms[formname];
	var qstr = "";
	
    function GetElemValue(name, value) {
        qstr += (qstr.length > 0 ? "&" : "")
            + escape(name).replace(/\+/g, "%2B") + "="
            + escape(value ? value : "").replace(/\+/g, "%2B");
			//+ escape(value ? value : "").replace(/\n/g, "%0D");
    }

	var elemArray = form.elements;
    for (var i = 0; i < elemArray.length; i++) {
        var element = elemArray[i];
        var elemType = element.type.toUpperCase();
        var elemName = element.name;
        if (elemName) {
            if (elemType == "TEXT"
                    || elemType == "TEXTAREA"
                    || elemType == "PASSWORD"
					|| elemType == "BUTTON"
					|| elemType == "RESET"
					|| elemType == "SUBMIT"
					|| elemType == "FILE"
					|| elemType == "IMAGE"
                    || elemType == "HIDDEN")
                GetElemValue(elemName, element.value);
            else if (elemType == "CHECKBOX" && element.checked)
                GetElemValue(elemName, element.value ? element.value : "On");
            else if (elemType == "RADIO" && element.checked)
                GetElemValue(elemName, element.value);
            else if (elemType.indexOf("SELECT") != -1)
                for (var j = 0; j < element.options.length; j++) {
                    var option = element.options[j];
                    if (option.selected)
                        GetElemValue(elemName,option.value ? option.value : option.text);
                }
        }
    }
    return qstr;
}
function select_answer(){
	choices=document.getElementsByName('choice');
	for(i=0;i<choices.length;i++)
	{
		if(choices.item(i).checked==true)
		{
		answered=true;
		break;
		}
		else
		{
		answered=false;
		}
		}
		if(answered)
		return true;
		else
		{
			alert("You have to select an answer first.")
		return false;
		}
	}
function updatepage(str,responsediv){
	//alert(str +" , , "+ responsediv );
    document.getElementById(responsediv).innerHTML = str;
	document.getElementById("loading").style.display='none';
	document.getElementById('').style.display = 'block';
//go to display
//ajax_load("content","personalinf.php");
}
function hideExamDetail(){
	document.getElementById('div_ajax_space').style.display='none';
	}
function validate_category()
{
		//alert(document.getElementById('catagoryname').value);
	if(document.getElementById('catagoryname').value=="") 
		{
		alert("Category name is required");
		document.getElementById('catagoryname').focus();
		return false;
		}
	else if(document.getElementById('instruction').value=="") 
		{
		alert("Instruction is required");
		document.getElementById('instruction').focus();
		return false;
		}
	else if(document.getElementById('q_amount_cat').value=="") 
		{
		alert("Please fill the number of questions that will come in this category");
		document.getElementById('q_amount_cat').focus();
		return false;
		}	
	else if(document.getElementById('has_paragraph').checked==true && 
	document.getElementById('passage_result').style.display=="none") 
		{
		alert("There is no passage saved.");
		document.getElementById('has_paragraph').checked=false;
		return false;
		}
		
		else
		{
		return true;
		}
	}
function passCheck(){
	//alert('passing...');
	for(i=0;i<document.getElementsByName('app[]').length;i++)
		{
			//checkValue(i);
			if(document.getElementsByName('approve[]').item(i).checked=='true')
	document.getElementsByName('app[]').item(n).value=document.getElementsByName('approve[]').item(i).value;
	else
	document.getElementsByName('app[]').item(n).value=0;

			alert(document.getElementsByName('app[]').item(n).value +"=" + document.getElementsByName('approve[]').item(i).value)
		}
	}

function openEditor(textarea) {
	win = window.open(
			'VisualMathEditor/VisualMathEditor.html?runLocal&codeType=Latex&encloseAllFormula=false&textarea=' + textarea
			,'VisualMathEditor'
			,'height=580,width=780,top=100,left=100,status=yes,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=no,modal=no,dependable=yes'
	);
	win.focus();
}

function inlineCKE(name) {
	//alert(name);
	//var editor = CKEDITOR.inline(name);
	CKEDITOR.replace(name, {
		//plugins: 'wysiwygarea,sourcearea,basicstyles,toolbar,undo',
		on: {
			instanceReady: function() {
				// Show textarea for dev purposes.
				this.element.show();
			},
			change: function() {
				// Sync textarea.
				this.updateElement();

				// Fire keyup on <textarea> here?
			}
		}
	} );
}
function test(){
	alert('this is for test')
	
	}
	function hidethis(a){
		document.getElementById(a).style.visibility="hidden";
		}
	
	function getSelectedChbox() {
		var str_list='';
		var form = document.getElementById('form_poulate');
 // var frm='form_poulate';
  //var selchbox = [];        // array that will store the value of selected checkboxes
///////////////////////////////////////
 for(var n=0;n < form.length;n++){
          if(form[n].name == 'question[]' && form[n].checked){
            //count++;
			//selchbox.push(inpfields[i].value);
			//selchbox.push(form[n].value);
			str_list=str_list + form[n].value +',';
          }
 }
//////////////////////////////////
  // gets all the input tags in frm, and their number
 
//alert(str_list);
//alert(selchbox);
window.opener.document.getElementById('question_ids').value=str_list;
  return str_list;
}
function check_account_info(){
	if(confirm("Are you sure you want to modify account data?"))
		{
			if(document.getElementById('username').value=="" || document.getElementById('newpassword').value=="" || document.getElementById('cnewpassword').value=="" ||document.getElementById('oldpassword').value=="")
			{
			alert("All fields are required")
			return false	
			}
			else if(document.getElementById('newpassword').value!=document.getElementById('cnewpassword').value)
			{
				alert("password confirmation did not match")
				return false;
			}
			else 
			return true
		}else
		return false
	}
function validateNGconv(){
	if(document.getElementsByName("selected_grade").item(0).value=='--select one--'){
		alert("you must select a grade");
		return false;
	}
	else
	return true;
	}
function validateStudStat()
{
	if(document.getElementById('aauid').value=='')
	{
		alert("you must provide a valid AAU ID");
		return false;
		}
		else
		return true;
	}
function validregrade(){
	if(document.getElementById('studID').value=='--select one--')
	{//alert(document.getElementsByName('selected_grade').item(0).value);
	alert("you must select a student ID");
	
	document.getElementById('studID').focus();
	return false;
	}
	else if(document.getElementById('final').checked==false && document.getElementById('other').checked==false && document.getElementById('both').checked==false)
	{
		alert("you must select one way to provide the new mark");
		return false;
		}
	else if(document.getElementById('onenewmark').style.display=="block" && document.getElementById('newmark').value=='')
	{
	alert("you must provide a new mark");
	document.getElementById('newmark').focus();
	return false;
		}
		else if(document.getElementById('onenewmark').style.display=="block" && document.getElementById('newmark').value>50)
		{
			alert("Mark can not exceed 50 points")
			document.getElementById('newmark').focus();
			return false;
			}
		else if(document.getElementById('both').checked==true && (document.getElementById('finalmark').value=="" || document.getElementById('othermark').value==""))
		{
			alert("you must provide both final and other new marks");
			return false;
			}
		else if(document.getElementById('reason').value=="")
		{
			alert("you need to provide a reason for change of grade")
			document.getElementById('reason').focus();
			return false;
		}
		
		else {
			if(confirm("You are about to submit students grade change\nYou will NOT have any option to make modefications to this change.You can apply changes only once for a student.\n Are you sure you want to continue?"))
				return true;
			else
			return false;
		}
	}
function checksum()
{
	ok=false;
	for(i=0;i<document.getElementsByName('studid[]').length;i++)
	{
		var fin=document.getElementsByName('final[]').item(i).value;
		var oth=document.getElementsByName('other[]').item(i).value;
		var egrade=document.getElementsByName('E_grade[]').item(i).value;
		if(eval(fin)>50)
		{
		alert('Final exam result can not exceed 50');
		document.getElementsByName('final[]').item(i).focus();
		ok=false;
		break;
		}
		
		if(eval(fin)+eval(oth) >100)
		{
			alert('Sum of Final and Other evaluations can not exceed 100');
			document.getElementsByName('final[]').item(i).style.borderColor='red';
			document.getElementsByName('other[]').item(i).style.borderColor='red';
			ok=false;
			break;
		}
		else
		{
			//alert('ok');
			ok=true;
		}
		if((fin==''||oth=='')&& egrade=='--select one--')
		{
			alert('You can not leave marks blank\nFill 0 If necessary.');
			document.getElementsByName('final[]').item(i).focus();
			ok=false;
			break;
		}
	}
	if(ok)
	return true;
	else
	return false;	
}
function check_uncheck_all(ckeckbox_name,state)
{
	if(state==true){
	for(i=0;i<document.getElementsByName(ckeckbox_name).length;i++)
	document.getElementsByName(ckeckbox_name).item(i).checked=true;
	}
	else
	{
	for(i=0;i<document.getElementsByName(ckeckbox_name).length;i++)
	document.getElementsByName(ckeckbox_name).item(i).checked=false;		
		}
	}
function forceblur(){
	document.getElementById('newmark').focus();
	}
function printSelection(node){

  var content=node.innerHTML
  var pwin=window.open('','print_content','width=1200');

  pwin.document.open();
  //pwin.document.write(node.innerHTML);
  pwin.document.write('<html><body onload="window.print()">'+content+'</body></html>');
  pwin.document.close();
 
  //setTimeout(function(){pwin.close();},1000);

}
function InstRegValidation()
{
	//[selected_dept] => 7 [studyprogram] => 17 [instructordd] => 33 [] => un [passw] => pwd [cpassw] => pwd
	//alert("checking...")	
	
	if(document.getElementById(passw).value=="" || document.getElementById(cpassw).value=="" ||document.getElementById(username).value=="" )
	   {
		   alert("All fields are required!");
	   		return false;
	   }
	   else
	   return true;
	  
	}
function passwordConfirmation(pass,cpass)
{//alert(document.getElementById(pass).value+","+document.getElementById(cpass).value)
	
	if(document.getElementById(pass).value==document.getElementById(cpass).value)
	return true;
	else
	{
		alert("Password confirmation did not match");
		
	return false;
	}
	
}
	
	
	function validateReq()
{
	if(document.getElementById('fullname').value==''||document.getElementById('email').value==''||document.getElementById('message').value=='')
	{
		return false;
	}
	else
	return true;
	}
	
	
function showSinglId()
{
	//alert(document.getElementById('singleStudcheck').checked)
	
	if(document.getElementById('singleStudcheck').checked==true)
	document.getElementById('singleStud').style.display='block';
	else
	{
	document.getElementById('singleStud').style.display='none';
	document.getElementById('AAU_ID').value='';
	}
	}

/*******************************************************************/
 // sort function - ascending (case-insensitive)
        function sortFuncAsc(record1, record2) {
            var value1 = record1.optText.toLowerCase();
            var value2 = record2.optText.toLowerCase();
            if (value1 > value2) return(1);
            if (value1 < value2) return(-1);
            return(0);
        }

        // sort function - descending (case-insensitive)
        function sortFuncDesc(record1, record2) {
            var value1 = record1.optText.toLowerCase();
            var value2 = record2.optText.toLowerCase();
            if (value1 > value2) return(-1);
            if (value1 < value2) return(1);
            return(0);
        }

        function sortSelect(selectToSort, ascendingOrder) {
            if (arguments.length == 1) ascendingOrder = true;    // default to ascending sort

            // copy options into an array
            var myOptions = [];
            for (var loop=0; loop<selectToSort.options.length; loop++) {
                myOptions[loop] = { optText:selectToSort.options[loop].text, optValue:selectToSort.options[loop].value };
            }

            // sort array
            if (ascendingOrder) {
                myOptions.sort(sortFuncAsc);
            } else {
                myOptions.sort(sortFuncDesc);
            }

            // copy sorted options from array back to select box
            selectToSort.options.length = 0;
            for (var loop=0; loop<myOptions.length; loop++) {
                var optObj = document.createElement('option');
                optObj.text = myOptions[loop].optText;
                optObj.value = myOptions[loop].optValue;
                selectToSort.options.add(optObj);
            }
        }

function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
//alert("Passage saved.");
}
function pass_to_parent(id)
{
	//opener.document.getElementById('passageID').value=id;
	alert(id + "passed")
	}
function show_result(){
	opener.document.getElementById('passage_result').style.display="block";
	}

//***********************************************************************/
var myWindow;
function openCenteredWindow(url) {
    var width = 1000;
    var height = 600;
    var left = parseInt((screen.availWidth/2) - (width/2));
    var top = parseInt((screen.availHeight/2) - (height/2));
    var windowFeatures = "width=" + width + ",height=" + height +
        ",status,resizable,left=" + left + ",top=" + top + 
        ",screenX=" + left + ",screenY=" + top+",scrollbars=yes";
    myWindow = window.open(url, "subWind", windowFeatures,  "POS");
}

function majorpointsexpand(expand)
    {
		//alert("expanding")
        if (expand == " + ")
            {
                document.getElementById('div_passgae_display').style = "display:inherit";
                document.getElementById('btn').innerHTML = " - ";
				document.getElementById('btn').title="Collaps passage";
            }
        else
            {
                document.getElementById('div_passgae_display').style = "display:none";
                document.getElementById('btn').innerHTML = " + ";
            }
    }