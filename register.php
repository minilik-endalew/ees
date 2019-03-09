<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
//ajax_load(where,what)
//ajaxPost(strURL,formname,responsediv)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Education</title>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<script src="ajaxFunctions.js"></script>
<script type="text/javascript">
function validate()
{
    //alert(document.getElementById('sel_prog').value);
	if(document.getElementById('confirmPWD').value!=document.getElementById('password').value)
	{
		alert('Password confirmation did not match');
		document.getElementById('password').focus();
		return false;
	
	}

    else

	return true;
}
</script>

<link rel="stylesheet" href="button.css" />
<style>
.loading{
	top:200px;
	left:45%;
	position: fixed;
    width: 150px;
   
    vertical-align: middle;
    
    text-align: center;
	}
</style>
</head>
<body>
<div id="templatemo_header_wrapper">
    <div id="templatemo_header">
    	<div id="site_title">
            <h1>&nbsp;</h1>
        </div>
        <p>&nbsp;</p>
    
    </div> <!-- end of templatemo_header -->

</div> <!-- end of templatemo_menu_wrapper -->

<?php
//Array ( [] => username [] => password [roll] => examinee )
include("mainmenu.html");
session_start();
include("simple-php-captcha-master/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
//print_r($_SESSION['captcha']);
?>

<div id="templatemo_content_wrapper_"><!-- end of sidebar -->
    
  <div id="templatemo_content" align="center">
    
    	<div class="content_box">
        
        	<h2>Welcome to AAU Digital Test Center</h2>
            
            
            <div id="kk">
            <form action="save_register.php" method="post" name="form_register">
              <table width="610" border="0" cellpadding="3" cellspacing="2">

                <tr>
                  <td>School/College/Department</td>
                  <td><select required name="department" required="required" class="custom-combo" id="sel_dep" onchange="id=this.value;ajax_load('div_prog','pickprogram.php?id='+id);">
                     <option></option>
                    <?php
                    //echo "check point";
                    $act->DropDownItems("SELECT `ID`, `Department` FROM `department` ORDER BY(`Department`)");
                    ?>
                  </select></td>
                </tr>
                  <tr>
                      <td>Study Program</td>
                      <td><div id="div_prog">Select a School/college/department to get list</div></td>
                  </tr><tr>
                      <td>Pick your name</td>
                      <td><div id="div_name">Select a program to get list</div></td>
                  </tr>
                  <!--<tr>
                      <td width="307">First Name</td>
                      <td width="293"><input type="text" name="firstname" id="firstname" required="required" /></td>
                  </tr>
                  <tr>
                      <td>Middle Name</td>
                      <td><input type="text" name="middlename" id="middlename" required="required" /></td>
                  </tr>
                  <tr>
                      <td>Last Name</td>
                      <td><input type="text" name="lastname" id="lastname" required="required" /></td>
                  </tr>
                  <tr>
                      <td>Sex</td>
                      <td><label >Male<input type="radio" name="sex" value="Male" required="required" /></label>
                          <label >Femal<input type="radio" name="sex" value="Female" required="required" /></label></td>
                  </tr>-->
                <tr>
                  <td title="Please remember what you create">Username <br />
                   </td>
                  <td><input type="text" name="username" id="username" required="required" /></td>
                </tr>
                <tr>
                  <td>Password</td>
                  <td><input type="password" name="password" id="password" required="required" /></td>
                </tr>
                <tr>
                  <td>Confirm Password</td>
                  <td><input type="password" name="confirmPWD" id="confirmPWD" required="required" /></td>
                </tr>
                <!--<tr>
                  <td>Country</td>
                  <td><input type="text" name="country" id="country" /></td>
                </tr>
                <tr>
                  <td>City</td>
                  <td><input type="text" name="city" id="city" /></td>
                </tr>
                <tr>
                  <td>Telephone</td>
                  <td><input type="text" name="telephone" id="telephone"  /></td>
                </tr>-->

                  <tr><td></td><td><img src="<?php echo $_SESSION['captcha']['image_src'];?>" ><?php  //echo $_SESSION['captcha']['code'];?>
                          <input type="text" name="txt_captcha" title="Please enter the captcha" required="required" placeholder="enter the text at the left"/></td></tr>
                <tr>
                  <td><input type="submit" class="myButton" value="Register" onclick="return(validate())"></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              </form>
            </div>
          <div id="div_ajax_space"> </div>
            <br>
            <div><a href="index.php">Back to Login</a></div>
            <div class="cleaner"></div>
            <div id="loading" style="display:none;" class="loading"><img src="images/loading.gif"></div>

        </div><div class="content_box_bottom"></div>
    </div> 
    <!-- end of content -->
    
    <div class="cleaner"></div>

</div>

<div id="templatemo_footer_wrapper">

    <div id="templatemo_footer">
    
        <ul class="footer_menu">
                    <li></li>
        Copyright © 2015 <a href="http://www.aau.edu.et/services/ict/overview/" target="_blank">Addis Ababa University ICT Office</a>
        </ul>
    </div>
    
</div>
<div align=center></div></body>
</html>