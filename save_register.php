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
//include("mainmenu.html");
?>

<div id="templatemo_content_wrapper_"><!-- end of sidebar -->
    
  <div id="templatemo_content" align="center">
    
    	<div class="content_box">
        
        	<h2>Welcome to AAU Digital Test Center</h2>           
            
            <div id="kk">
            <?php
            //print_r($_POST);
            //$_POST['sel_department'];
            /*old
             * Array ( [firstname] => fn [middlename] => mn [lastname] => ln [sex] => Male [department] => 189 [program] => 22 [email] => a@p.c [password] => a [confirmPWD] => a [country] => Ethiopia [city] => Addis Ababa [telephone] => 0987451245 [txt_captcha] => bzeEp )
             */
            		$token = md5(uniqid());
			$checkun=mysqli_query($link,"SELECT `ID` FROM `user` WHERE `User_Name`='".$_POST['username']."'");
            $check_created=mysqli_query($link,"SELECT `ID` FROM `user` WHERE `applicant`='".$_POST['applicant']."'");
			//$checkname=mysqli_query($link,"SELECT * FROM `user` WHERE `First_Name`='".mysql_real_escape_string($_POST['firstname'])."' and `Middle_Name`='".mysql_real_escape_string($_POST['middlename'])."' and `Last_Name`='".mysql_real_escape_string($_POST['lastname'])."'");
			if(mysql_num_rows($checkun)==0 ) {
                if (mysql_num_rows($check_created) == 0) {

                    if ($_SESSION['captcha']['code'] != $_POST['txt_captcha']) {
                        echo "The captcha code you provided was wrong.";
                        echo "<br><a href='register.php' >Back to Registration form</a>";
                    } else {
                        //print_r($_POST);
                        //Array ( [department] => 166 [program] => 76 [applicant] => 1 [username] => un [password] => p [confirmPWD] => p [txt_captcha] => Vm3NR )
                        /*
                        //Array ( [firstname] => Minilik [middlename] => Tesfaye [lastname] => Endalew [sex] => Male [level] => Masters [email] => millo@gmail.com [password] => 132 [confirmPWD] => 123 [country] => Ethiopia [city] => Addis Ababa [telephone] => 251911138737 [subject] => --Select-- )
                        $user_sql = "INSERT INTO `user`(`ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Roll`, `Email`, `User_Name`, `Password`, `Active`, `Remark`)
                VALUES (NULL,'" . mysql_real_escape_string($_POST['firstname']) . "','" . mysql_real_escape_string($_POST['middlename']) . "','" . mysql_real_escape_string($_POST['lastname']) . "','Examinee','" . mysql_real_escape_string($_POST['email']) . "','" . mysql_real_escape_string($_POST['email']) . "','" . md5($_POST['password']) . "','Yes','')";

                        $res_user = mysqli_query($link,$user_sql) or die(mysqli_query($link,));


                        $sql = "INSERT INTO `examinee`(`ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Sex`, `E-mail`, `Password`, `Country`, `City`, `Telephone`, `Academic_Year`, `Study_Subject`, `Confirmation_Code`,`Approved`, `Exam`, `UserID`, `Remark`)
    VALUES (NULL,'" . mysql_real_escape_string($_POST['firstname']) . "','" . mysql_real_escape_string($_POST['middlename']) . "','" . mysql_real_escape_string($_POST['lastname']) . "','" . $_POST['sex'] . "','" . mysql_real_escape_string($_POST['email']) . "','" . md5($_POST['password']) . "','" . mysql_real_escape_string($_POST['country']) . "','" . mysql_real_escape_string($_POST['city']) . "','" . mysql_real_escape_string($_POST['telephone']) . "','" . date('Y') . "','" . $_POST['program'] . "','" . $token . "','Yes','0','" . $user_id . "','')";
                        //echo $sql;
                        $res = mysqli_query($link,$sql) or die("An error happened while inserting into examinee:-- ".mysqli_error($link));

                        */

                        //$applicant_name=$act->GetField('Full_name','applicants',mysql_escape_string($_POST['applicant']));
                        $applicant_name = $act->GetFieldByQuery("SELECT `Full_name` FROM `applicants` WHERE `id`='" . $_POST['applicant'] . "'");
                        //echo $applicant_name."...";
                        //$applicant_email=$act->GetField('Email','applicants',mysql_escape_string($_POST['applicant']));
                        $applicant_email = $act->GetFieldByQuery("SELECT `Email` FROM `applicants` WHERE `id`='" . $_POST['applicant'] . "'");
                        //$applicant_sex=$act->GetField('Gender','applicants',mysql_escape_string($_POST['applicant']));
                        $applicant_sex = $act->GetFieldByQuery("SELECT `Gender` FROM `applicants` WHERE `id`='" . $_POST['applicant'] . "'");
                        $pwd = md5(mysql_escape_string($_POST['password']));
                        //echo $applicant_email;
                        $applicant_name=preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $applicant_name);
                        $names = explode(" ", $applicant_name);
                        //print_r($names);
                        //check if the applicant have applied for multiple departments
                        $multiple_depts="SELECT * FROM `examinee` WHERE `First_Name`='$names[0]' AND `Middle_Name`='$names[1]' AND `Last_Name` ='$names[2]'";
                        //echo $multiple_depts;
                        $multiple_dept_found=mysql_num_rows(mysqli_query($link,$multiple_depts));
                       // echo $multiple_dept_found;

                        //record log
                        //check if exams are activated for allocation

                        $englishq = "SELECT `ID`  FROM `exam_plan` WHERE `Subject_Type`='English' and `Active`='Yes' ORDER BY rand()";
                        $analyticq = "SELECT `ID` FROM `exam_plan` WHERE `Subject_Type`='Analytic' and `Active`='Yes' ORDER BY rand()";
                        $eng_exam = mysqli_query($link,$englishq);
                        $ana_exam = mysqli_query($link,$analyticq);
                        if($multiple_dept_found==0){
                        if (mysql_num_rows($eng_exam) > 0 && mysql_num_rows($ana_exam) > 0) {

                            $insert_user_q = "INSERT INTO `user`(`ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Roll`, `Email`, `User_Name`, `Password`,`applicant`, `Active`, `part`, `Remark`)
 VALUES
 (NULL,'$names[0]','$names[1]','$names[2]','Examinee','$applicant_email','" . mysql_escape_string($_POST['username']) . "','$pwd','" . mysql_escape_string($_POST['applicant']) . "','Yes',NULL,'')";
//echo $insert_user_q;
                            $res_u = mysqli_query($link,$insert_user_q) or die(mysqli_error($link));
                            $user_id = mysql_insert_id();

                        $insert_examinee_q = "INSERT INTO `examinee`(`ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Sex`, `Enrollment_Level`, `E-mail`,
`Password`, `Country`, `City`, `Telephone`, `Academic_Year`, `Study_Subject`, `Confirmation_Code`, `Approved`, `Exam`, `UserID`, `Remark`) VALUES
(NULL,'$names[0]','$names[1]','$names[2]','$applicant_sex','','$applicant_email','$pwd','Ethiopia','City','tel','" . date("Y") . "','" . $_POST['program'] . "','$token','Yes',0,$user_id,'" . date("Y-m-d H:i:s") . "')";
                        $res_e = mysqli_query($link,$insert_examinee_q) or die(mysqli_error($link));
                        $examinee_id = mysql_insert_id();
                        //randomly allocate exams

//echo $insert_examinee_q;

                        if ($res_u && $res_e)
                        {
                            if($act->allocation_possible($examinee_id))
                            {
                               $eng_row = mysql_fetch_array($eng_exam);
                                $ana_row = mysql_fetch_array($ana_exam);
                                //print_r($eng_row);print_r($ana_row);
                                $act->allocate_exam($examinee_id,$eng_row[0]);
                                $act->allocate_exam($examinee_id,$ana_row[0]);
                            }
                            echo "You have successfully registered.<br>.";

                        }

                        else
                            echo "Something gone wrong. Please try again.<br />";

                    }
                        else {
                            echo "Please wait until exams get activated and try again when you are told to register";
                        }

                        }else {echo "You have applied for multiple programs. You can not take the exam more than one times though.
                        Please login with your existing credential. <br>Note: your result is valid for all programs you applied for. ";}

                    }
                    //}
                }
                else {
                    echo"Applicant has already registered.";
                }
            }
			else
			{
				echo "<div style='color:red' onclick='shake()'>This username is already taken please try again</div>";
            }

			?>
            <br />
            <a href="index.php">Back to login page</a> </div>
          <div id="div_ajax_space"></div>
            
            <div class="image_fl"></div>
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
        Copyright © 2014 <a href="#">Addis Ababa University ICT Office</a><a href="http://www.templatemo.com" target="_parent"></a>
        </ul>
    </div>
    
</div>
<div align=center></div></body>
</html>