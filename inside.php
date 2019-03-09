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
function select_first()
{
	var form=document.getElementById('form_multiple_delete');
	for(i=0;i<form.length;i++){
	if(document.getElementsByName('check_mul_del[]').item(i).checked==false)
	{
		alert("you must select atleast one question");
		return false;
		}
}
}
function hideMenu(){document.getElementById('div_examinee_menu').style.display=none;}
<!--
function Popup(n,t) {
window.open("populate_question.php?amount="+n +"&type="+t, "Populate question", 
"status = 1, height = 500, width =700, resizable = 0 ,screenX=300 ,screenY=30" )
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
include("mainmenu.html");
?>

<div id="templatemo_content_wrapper_"><!-- end of sidebar -->
    
  <div id="templatemo_content" align="center">
    
    	<div class="content_box">
        
       
        <?php
        //Array ( [] => username [] => password [roll] => examinee )
		//print_r($_POST);
if(isset($_POST)){
$username=mysql_real_escape_string($_POST['username']);
$password=mysql_real_escape_string($_POST['password']);
$roll=$_POST['roll'];

$sql="SELECT * FROM `user` WHERE `User_Name`='". $username."' AND `Password`='".md5($password)."' AND `Roll`='$roll' AND `Active`='Yes'";
//echo $sql;
$userResult=mysqli_query($link,$sql)or die("Query Error : ".mysqli_error($link));
$row=mysql_fetch_array($userResult);
//echo mysql_num_rows($userResult);
if(mysql_num_rows($userResult)==1)
{
	$_SESSION['fullname']=$row['First_Name']." ".$row['Middle_Name'];
	$_SESSION['logged']=true;
	$_SESSION['username']=$username;
	$_SESSION['roll']=$roll;
	$_SESSION['user_id']=$row['ID'];
}
else
{
echo "You used invalid user credential.";
//print_r($_SESSION);
}
}//end of isset
else
{
echo"Anautorized !";
}
		?>
        
        <div id="div_exam">
        	<h2>Welcome to AAU Digital Test Center</h2>
            
            <p>&nbsp;</p>
            
          
            <?php
			//Array ( [username] => username [password] => password [roll] => examinee )
        //print_r($_SESSION);
if($_SESSION['logged']==true && $_SESSION['roll']=="Administrator")
{
	//show administrator menu
	//$_SESSION['logged_user']="Administrator";
	echo"<div>Administrator Window <hr><br>";
	echo"Welcome ".$_SESSION['fullname'].", You are logged in as ".$_SESSION['roll'];
	echo"[<a href='logout.php'>Log out</a>]  [<a href=# onclick=\"ajax_load('div_ajax_space','changepassword.php')\">Change password</a>]</div>";
	?>
    
	<div align='left'>
	  <p><a href='#' onclick="ajax_load('div_ajax_space','create_exam.php')"><img src="images/document.png" width="16" height="16" alt="Exam"  />Create Exam </a></p>
	  <p><a href="#" onclick="ajax_load('div_ajax_space','manage_exams.php')"><img src="images/settings.gif" width="16" height="16" alt="Setting" />Manage Exams</a><br>
	    <a href='#' onclick="ajax_load('div_ajax_space','manage_users.php')"><img src="images/user_group.gif" width="16" height="16" alt="Users" />Manage Users</a></p>
	  <p><a href="#" onclick="ajax_load('div_ajax_space','allocate_exam.php')"><img src="images/addmaillist.png" width="16" height="16" alt="allocation" />Exam Allocation</a></p>
	  <p><a href="#" onclick="ajax_load('div_ajax_space','score.php')" ><img src="images/chart_bar.gif" width="16" height="16" alt="scores" />Scores</a>
	    </p>
	</div>
	<?php
}
else if($_SESSION['logged']==true && $_SESSION['roll']=="Instructor")
{
	echo"Instructor Window <hr><br>";
	echo"Welcome ".$_SESSION['fullname'].", You are logged in as ".$_SESSION['roll'];
	echo"[<a href='logout.php'>Log out</a>]    [<a href=# onclick=\"ajax_load('div_ajax_space','changepassword.php')\">Change password</a>]<hr><br>";
	?>
	<div align='left'>
	<a href='#' onclick="ajax_load('div_ajax_space','create_question_form.php')">Create Question </a><br>
	<a href='#' onclick="ajax_load('div_ajax_space','review_questions.php')">Review My Questions </a><br>
	</div>
    
    <?php
}
else if($_SESSION['logged']==true && $_SESSION['roll']=="Examinee")
{
	echo"Examinee Window <hr><br>";
	echo"Welcome ".$_SESSION['fullname'].", You are logged in as ".$_SESSION['roll'];
	echo"  [<a href='logout.php'>Log out</a>]    [<a href=# onclick=\"ajax_load('div_ajax_space','changepassword.php')\">Change password</a>]<hr><br>";
	$e_sql="SELECT `ID` FROM `examinee` WHERE `UserID`='".$_SESSION['user_id']."'";
	$e_res=mysqli_query($link,$e_sql)or die(mysqli_error($link));
	$e_row=mysql_fetch_row($e_res);
	$_SESSION['examinee']=$e_row[0];
	?>
 	<div align='left' id="div_examinee_menu">
	<a href='#' onclick="ajax_load('div_ajax_space','MyExam.php?user_id=<?php echo $_SESSION['user_id'];?>')">Take Exam </a><br>
	<a href='#' onclick="ajax_load('div_ajax_space','MyStatus.php?user_id=<?php echo $_SESSION['user_id'];?>')">View my status </a><br>
	</div>
   
	<?php
}
else
{
	?>
  
    <div align="left">
      <p>Sorry, you are not authorized to log into the system </p>
      <p><a href="index.php">Back to Login page</a></p>
    </div>
    <?php
	//print_r($_SESSION);
	//header("location:index.php");
	 }

		 ?>
          
          <hr />
          <div id="div_ajax_space"></div>
            
            <div class="image_fl"></div>
          <div class="cleaner"></div>
            <div id="loading" style="display:none;" class="loading">
            <img src="images/loading.gif"></div>

        </div>
        </div><!-- end of Exam -->
        <div class="content_box_bottom"></div>
    </div> 
    <!-- end of content -->
    
    <div class="cleaner"></div>

</div>

<div id="templatemo_footer_wrapper">

    <div id="templatemo_footer">
    
        <ul class="footer_menu">
                    <li></li>
        Copyright © 2014 <a href="#">Addis Ababa University ICT Office</a><a href="http://www.templatemo.com" target="_parent"></a>
        </ul>
    </div>
    
</div>
<div align=center></div></body>
</html>