<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
//ajax_load(where,what)
//ajaxPost(strURL,formname,responsediv)
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>AAU - Graduate Studeis Competence Assessment System</title>

        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
        
        <script src="ajaxFunctions.js"></script>
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="ckeditor/styles.js"></script>
        <link rel="stylesheet" href="ckeditor/samples/css/samples.css">



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
//function (){document.getElementById('div_examinee_menu').style.display=none;}

function Popup(n,t) {
	//alert(n );
window.open("populate_question.php?amount="+n +"&type="+t, "Populate question","status = 1, height = 500, width =700, resizable = 0 ,screenX=300 ,screenY=30" )
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


#note {
    position: absolute;
    z-index: 6001;
    top: 0;
    left: 0;
    right: 0;
    background: #fde073;
    text-align: center;
    line-height: 2.5;
    overflow: hidden;
    -webkit-box-shadow: 0 0 5px black;
    -moz-box-shadow:    0 0 5px black;
    box-shadow:         0 0 5px black;
}
.cssanimations.csstransforms #note {
    -webkit-transform: translateY(-50px);
    -webkit-animation: slideDown 2.5s 1.0s 1 ease forwards;
    -moz-transform:    translateY(-50px);
    -moz-animation:    slideDown 2.5s 1.0s 1 ease forwards;
}

#close {
    position: absolute;
    right: 10px;
    top: 9px;
    text-indent: -9999px;
    /*background: url(images/close.png);*/
    height: 16px;
    width: 16px;
    cursor: pointer;

}
.cssanimations.csstransforms #close {
    display: none;
}

@-webkit-keyframes slideDown {
    0%, 100% { -webkit-transform: translateY(-50px); }
    10%, 90% { -webkit-transform: translateY(0px); }
}
@-moz-keyframes slideDown {
    0%, 100% { -moz-transform: translateY(-50px); }
    10%, 90% { -moz-transform: translateY(0px); }
}
</style>
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
             <div class="codrops-top" id="banner" align="center">
              <div class="clr"><img src="images/templatemo_header.jpg" width="980" height="156"></div>
            </div><!--/ Codrops top bar --><h1>&nbsp;</h1>
            <section>				
                <div id="container_demo" >
                    
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="main">
                         <?php
        //Array ( [] => username [] => password [roll] => examinee )
		//print_r($_POST);
if(isset($_POST)){
$username=mysqli_real_escape_string($link,$_POST['username']);
$password=mysqli_real_escape_string($link,$_POST['password']);
$roll=$_POST['roll'];

$sql="SELECT * FROM `user` WHERE `User_Name`='". $username."' AND `Password`='".md5($password)."' AND `Roll`='$roll' AND `Active`='Yes'";
//echo $sql;
$userResult=mysqli_query($link,$sql)or die("Query Error : ".mysqli_error($link));
$row=mysqli_fetch_array($userResult);
//echo mysql_num_rows($userResult);
if(mysqli_num_rows($userResult)==1)
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
        	
            
          
            <?php
			//Array ( [username] => username [password] => password [roll] => examinee )
        //print_r($_SESSION);
if($_SESSION['logged']==true)//WHO ever logged in, write log
{
    $proxy = (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : false;

    if(!!$proxy){
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        echo "Warning: Your cliend is using proxy, may could not determine hostname";
    }else{
        $ipaddress = $_SERVER['REMOTE_ADDR']; //
    }
    $hostname = gethostbyaddr($ipaddress); //Its will return domain + machine-name inside a private network.

    /* if($ipaddress  == $hostname){
      echo "Impossible to determine hostname for: ", $ipaddress ;
     }else{
       echo "The hostname for ", $ipaddress, "is : ",  $hostname;
     }*/
    $log_sql="INSERT INTO `action_log`(`id`, `Name`, `type`, `IP`, `Actioin`, `remark`) VALUES (NULL,'".$_SESSION['fullname']."','".$_SESSION['roll']."','".$hostname."-".$ipaddress."','".$_SESSION['username']." has logged in','')";
    //echo $log_sql;
    mysqli_query($link,$log_sql)or die(mysqli_error($link));

    //------------------------------------

}
if($_SESSION['logged']==true && $_SESSION['roll']=="Administrator")
{
	echo "<h2>Welcome to AAU Digital Test Center</h2>            
            <p>&nbsp;</p>";
	//show administrator menu
	//$_SESSION['logged_user']="Administrator";
	echo"<div>Administrator Window <hr><br>";
	echo"Welcome ".$_SESSION['fullname'].", <br>You are logged in as ".$_SESSION['roll'];
	echo"[<a href='logout.php'>Log out</a>]  [<a href=# onclick=\"ajax_load('div_ajax_space','changepassword.php')\">Change password</a>]</div>";
	?>
	<div>
    <table width="351" height="106" border="0" align="center" cellspacing="3" cellpadding="3">
  <tr>
    <td><a href='#' onClick="ajax_load('div_ajax_space','create_exam.php')"   class="myButton" ><img src="images/document.png" width="16" height="16" alt="Exam"  />Create Exam </a></td>
    <td><a href='#' onClick="ajax_load('div_ajax_space','manage_users.php')"  class="myButton" ><img src="images/user_group.gif" width="16" height="16" alt="Users" />Manage Users</a></td>
  </tr>
  <tr>
    <td><a href="#" onClick="ajax_load('div_ajax_space','manage_exams.php')"   class="myButton" ><img src="images/settings.gif" width="16" height="16" alt="Setting" />Manage Exams</a></td>
    <td><a href="#" onClick="ajax_load('div_ajax_space','importlist.php')"  class="myButton" ><img src="images/import_wiz.gif" width="16" height="16" alt="Import">Import Examinees</a></td>
  </tr>
  <tr>
    <td><a href="#" onClick="ajax_load('div_ajax_space','allocate_exam.php')"  class="myButton" ><img src="images/addmaillist.png" width="16" height="16" alt="allocation" />Exam Allocation</a></td>
    <td><a href="#" onClick="ajax_load('div_ajax_space','reports.php')"  class="myButton" ><img src="images/chart_bar.gif" width="16" height="16" alt="scores"/>Reports</a></td>
  </tr>
</table>

	 
	</div>
	<?php
	
 
}
else if($_SESSION['logged']==true && $_SESSION['roll']=="Instructor")
{
	echo"Instructor Window <hr><br>";
	echo"Welcome ".$_SESSION['fullname'].", You are logged in as ".$_SESSION['roll'];
	echo"[<a href='logout.php'>Log out</a>]    [<a href=# onclick=\"ajax_load('div_ajax_space','changepassword.php')\">Change password</a>]<hr><br>";
	
	unset($_SESSION['categoryID']);
	unset($_SESSION['cat_amount']);
	unset($_SESSION['passageID']);
	unset($_SESSION['passage_q_amount']);
	?>
	<div align='left' id="question_creator_div">
	<a href='#' onclick="ajax_load('div_ajax_space','create_question_form.php')">Create Question Category</a><br>
    
	<a href='#' onclick="ajax_load('div_ajax_space','review_questions.php')">Review My Questions </a><br>
        <a href='#' onclick="ajax_load('div_ajax_space','upload_form.php')">Upload resource </a><br>
	</div>
    
    <?php
}
else if($_SESSION['logged']==true && $_SESSION['roll']=="Reviewer")
{
	echo"Reviewer Window <hr><br>";
	echo"Welcome ".$_SESSION['fullname'].", You are logged in as ".$_SESSION['roll'];
	echo"[<a href='logout.php'>Log out</a>]    [<a href=# onclick=\"ajax_load('div_ajax_space','changepassword.php')\">Change password</a>]<hr><br>";
	
	unset($_SESSION['categoryID']);
	unset($_SESSION['cat_amount']);
	unset($_SESSION['passageID']);
	unset($_SESSION['passage_q_amount']);
	?>
	<div align='left' id="question_creator_div">
	
    
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
	$e_row=mysqli_fetch_row($e_res);
	$_SESSION['examinee']=$e_row[0];
	
	?>
 	<div align='left' id="div_examinee_menu">
    <div style="color:#dd4444; background-color:khaki">
        <ol style="list-style: disc">
            <li>Click on "Take Exam" to activate the respective exam</li>
            <li>Click on "Start Exam" to start the exam and respond for each categories</li>
            <li>When you click on the "Respond" button, the button disappears and loads the associated questions at the bottom of the page</li>
            <li>Do NOT click on an other "Respond" button before you complete responding and submit for an open category</li>
            <li>Do Not forget to "Submit" each category set associated for each respond button</li>
            <li>Make sure that you get "You have successfully submitted" message at the bottom of the page when you submit</li>
            <li>If you do not get the success message when you submit for a category, there might have been disconnection and you need to refresh or reload the page</li>
            <li>In some case, the system may log you off your sessions, please log-in again if you see an error message or the log-in page at the bottom</li>
            <li>Your successfully submitted answers will not be lost if the power goes off or if network discontinuity happen</li>
            <li>DO NOT OPEN ANY OF THE BUTTONS ON A NEW TAB OR NEW PAGE</li>
            <hr>
            <li>Note that attempting to take the exam more than once is considered as irregularity </li>
            <li>If you have applied for multiple programs and passed the programs entrance exams,
                please select you priority program preference on this online competency exam. Note that you are not allowed to take the online exam multiple times evenif
            you applied for multiple programs.</li>

        </ol>

    </div>
	<?php
    $activ_exams="SELECT `id`, `examinee`, `exam`, `remark` FROM `exam_allocation` WHERE 
	`examinee`='".$_SESSION['examinee']."' and `exam` IN (SELECT `ID` FROM `exam_plan` WHERE 1 )";
	//echo $activ_exams;
	$activ_exams_result=mysqli_query($link,$activ_exams)or die(mysqli_error($link));
	?>
    <table width="100%" border="1" id="starter_table">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="241">Active Exam List</td>
    <td width="148">&nbsp;</td>
  </tr>
  <?php 
  $i=0;
  while($row=mysqli_fetch_array($activ_exams_result)){
  //is row[exam] active?
  $i++;
  ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $act->GetField('Exam_name', 'exam_plan', $row['exam']); ?></td>
            <td>
                <?php
                //echo "taken:". $act->exam_taken($row['examinee'],$row['exam']);
                //allowed to take or resume exam?
                $allowedq = "SELECT `ID` FROM `examinee` WHERE `Approved`='Yes' AND `ID`='".$row['examinee']."'";
                //echo $allowedq;
                if (mysqli_num_rows(mysqli_query($link,$allowedq))==1){
                    if (!$act->exam_taken($row['examinee'], $row['exam'])) {
                        ?>
                        <div>
                            <button
                                title="Once you start submitting answers for this exam, the button changes to 'Resume Exam'"
                                onclick="if(confirm('This action activates the exam session. The button disappears after you start submitting answers. Continue?')){document.getElementById('starter_table').style.visibility='hidden';ajax_load('div_ajax_space','MyExam2.php?user_id=<?php
                                echo $_SESSION['user_id']; ?>&exam=<?php echo $row['exam']; ?>')}" class="myButton">Take
                                Exam
                            </button>
                        </div>
                    <?php } else {
                        ?>
                        <?php
                        //echo "nn:".$act->exam_complete($row['examinee'],$row['exam']);
                        if (!$act->exam_complete($row['examinee'], $row['exam'])) {
                            ?>
                            <a href='#'
                               title="Click this button to resume the exam from where you have stopped. The answers submitted in categories will be kept. "
                               onclick="if(confirm('This action activates the exam session. The button disappears after you start submitting answers. Continue?')){document.getElementById('starter_table').style.visibility='hidden';ajax_load('div_ajax_space','MyExam2.php?user_id=<?php
                               echo $_SESSION['user_id']; ?>&exam=<?php echo $row['exam']; ?>')}" class="myButton">Resume
                                Exam </a>
                            <?php
                        } ?>


                        <a href='#' title="Here, you can see your current score"
                           class="myButton"
                           onclick="ajax_load('div_ajax_space','MyStatus.php?exam=<?php echo $row['exam']; ?>')">View my
                            status </a>
                        <?php
                    }
                }
                else
                echo "You are not allowed to take or continue this exam";
 ?>
 </td>
  </tr>
  <?php }?>
</table>

   <!-- <a href='#' onclick="ajax_load('div_ajax_space','MyExam2.php?user_id=<?php //echo $_SESSION['user_id'];?>')">Take Exam </a><br>-->
	<!--<a href='#' onclick="ajax_load('div_ajax_space','MyStatus.php?user_id=<?php //echo $_SESSION['user_id'];?>')">View my status </a><br>-->
	</div>
   
	<?php
}
elseif($_SESSION['logged']==true && $_SESSION['roll']=='Invigilator')
{
    echo"Invigilators Window <hr><br>";
    echo"Welcome ".$_SESSION['fullname'].", You are logged in as ".$_SESSION['roll'];
    echo"  [<a href='logout.php'>Log out</a>]    [<a href=# onclick=\"ajax_load('div_ajax_space','changepassword.php')\">Change password</a>]<hr><br>";

    include("users.php");
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
          <div id="div_ajax_space" class="CSSTableGenerator">
          </div>
          <div id="div_exam_space">
          </div>
                        </div>

                       
					</div>	
                    </div>
                     <div id="loading" style="display:none;" class="loading">
            <img src="images/loading.gif"></div>
              </div>  
          </section>
        </div>
    </body>
</html>