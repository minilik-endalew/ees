<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
$sql="SELECT `ID`,`First_Name`,`Middle_Name`, `Last_Name`, `Enrollment_Level`,`Exam` FROM `examinee` WHERE `UserID`='".$_REQUEST['user_id']."' AND `Approved`='Yes'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$row_e=mysqli_fetch_array($res);
//$row['Exam']
//print_r($_REQUEST);Array ( [user_id] => 7 )
//SELECT `ID`, `Exam_name`, `Subject_Type`, `Pass_persentage`, `Time_for_single_question_in_minutes`, `Time_for_the_whole_exam`, `One_questioin_at_a_time`, `Exam_Date`, `Active`, `Remark` FROM `exam_plan` WHERE 1
$exam_sql="SELECT `ID`, `Exam_name` as `Exam Name`, `Subject_Type` as `Type`, `Time_for_single_question_in_minutes` as `Approximate time for single question`, `Time_for_the_whole_exam` as `Time for the whole examination`, `Mode` , `Remark` FROM `exam_plan` WHERE `ID`='".$_REQUEST['exam']."' AND `Active`='Yes'";
//echo $exam_sql;
echo"Your exam information";
$_SESSION['exam']=$_REQUEST['exam'];//$row_e['Exam'];<<<<<---------------------------
//print_r($_SESSION);
$act->DisplaySingle($exam_sql);
echo"<p style='color:#dd4444'>
<ul>
<li>Please do NOT open any link on a new tab or click on the browsers back button.
<LI>All submitted answers / in a category are preserved and will not be lost by power failur or refreshing the exam page.
</ul>
</p>";
/******************************************************************************/

$res=mysqli_query($link,$exam_sql)or die(mysqli_error($link));
$row=mysqli_fetch_array($res);
//$questions=$act->TrimLastComma($row['Questions']);
$_SESSION['mode']=$row['Mode'];
//$one_by_one=$row['One_questioin_at_a_time']=="Yes"?1:0;
$delay41=$row['Time_for_single_question_in_minutes'];
$delay4all=$row['Time_for_the_whole_exam'];
//global $q_array;
//$q_array=explode(',',$questions);
//check if all questions are avilable
/*------------getting the categories------------*/
$catq="SELECT `category` FROM `exam_category` WHERE `exam`='".$_REQUEST['exam']."'";
$catr=mysqli_query($link,$catq)or die(mysqli_error($link));
$category_array=array();
while($cats=mysqli_fetch_assoc($catr)){
array_push($category_array,$cats['category']);
}
$_SESSION['exam_category']=$category_array;
//print_r($category_array);
//$exam_complete=NULL;
echo"<div style='background:#F9F'>Categories</div>";
?>
<table bgcolor="#CCCCFF" border="1" bordercolor="#0000FF">
 <?php 
foreach($_SESSION['exam_category'] as $c){
$csql="SELECT  `category_name`, `Instruction`, `amount`, `passage`, `active`, `Subject`, `remark` FROM `question_category` WHERE `id`='$c'";
//-------------------------------------------------------------------
$activeq="SELECT COUNT(`ID`) FROM `question` WHERE `Active`='yes' and `category`='$c'";
$resq=mysqli_query($link,$activeq) or die(mysqli_error($link));
$active_questions_in_catagory=mysqli_fetch_row($resq);

//------------------------------------------------------------------
$cres=mysqli_query($link,$csql)or die(mysqli_error($link));

	 while($crow=mysqli_fetch_assoc($cres)){
	 ?>
  <tr>
    <td width="83"><?php echo $crow['category_name']?></td>
    <td width="593"><?php echo $crow['Instruction']?><br>[<?php echo $active_questions_in_catagory[0];//echo $crow['amount']." questioins avilable";?>]</td>
    
  </tr>
  
  <?php }}?>
</table> 
 <?php 
if(!$act->exam_taken($_SESSION['examinee'],$_SESSION['exam']) )//$row_e['Exam']!=0 means if the user is assigned for an exam
{
?>
<div align="center" style="background-color:#FCF">
<input type="button" value="Start Exam" class="myButton" onclick="hideExamDetail();ajax_load('div_exam_space','exam_sheet2.php?start=true')" />
<br>Clicking this will lock the "take exam", "view my status" and "resume" buttons if avilable
</div>
<?php 
}
else
{echo"You already have completed or has started this exam.";
?>
<div align="center" style="background-color:transparent">
<input type="button" value="Start Exam" class="myButton" onclick="hideExamDetail();ajax_load('div_exam_space','exam_sheet2.php?start=true')" />
<br>Clicking this will lock the "take exam", "view my status" and "resume" buttons if avilable
</div>
<br><a href='#' class="myButton" onclick="ajax_load('div_ajax_space','MyStatus.php?user_id=<?php echo $_SESSION['user_id'];?>')">View my status </a><br>
<?php
}
?>