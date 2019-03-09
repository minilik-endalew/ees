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
$exam_sql="SELECT `ID`, `Exam_name` as `Exam Name`, `Subject_Type` as `Type`, `Time_for_single_question_in_minutes` as `Approximate time for single question`, `Time_for_the_whole_exam` as `Time for the whole examination`, `One_questioin_at_a_time` as `One question at a time`, `Remark` FROM `exam_plan` WHERE `ID`='".$row_e['Exam']."' AND `Active`='Yes'";
//echo $exam_sql;
echo"Your exam information";

$act->DisplaySingle($exam_sql);
/******************************************************************************/
$exam_sql="SELECT `ID`, `Exam_name`, `Subject_Type`, `Pass_persentage`, `Time_for_single_question_in_minutes`, `Time_for_the_whole_exam`, `One_questioin_at_a_time`, `Exam_Date`, `Active`, `Remark` FROM `exam_plan` WHERE `ID`='".$row_e['Exam']."' AND `Active`='Yes'";
//echo $exam_sql;
$res=mysqli_query($link,$exam_sql)or die(mysqli_error($link));
$row=mysql_fetch_array($res);
//$questions=$act->TrimLastComma($row['Questions']);

$one_by_one=$row['One_questioin_at_a_time']=="Yes"?1:0;
$delay41=$row['Time_for_single_question_in_minutes'];
$delay4all=$row['Time_for_the_whole_exam'];
//global $q_array;
//$q_array=explode(',',$questions);
//check if all questions are avilable
/*------------getting the categories------------*/
$catq="SELECT `category` FROM `exam_category` WHERE `exam`='".$row_e['Exam']."'";
$catr=mysqli_query($link,$catq)or die(mysqli_error($link));
$exam_complete=NULL;
$q_array=array();
while($crow=mysql_fetch_row($catr)){
$qq="SELECT `ID`, `Type`, `Question`, `Instructor` FROM `question` WHERE `category`='".$crow[0]."' AND `Active`='Yes'";
$qres=mysqli_query($link,$qq)or die(mysqli_error($link));

while($q_row=mysql_fetch_array($qres))
{
	array_push($q_array,$q_row['Question']);
	//if(mysql_num_rows($qres)==1)
	//$exam_complete =true;
	//else
	//$exam_complete =false;
	}
//print_r($questions);

foreach($q_array as $q)
{
	$check_sql="SELECT `Question` FROM `question` WHERE `ID`='".$q."'";
	$check_res=mysqli_query($link,$check_sql) or die(mysqli_error($link));
	if(mysql_num_rows($check_res)==1)
	$exam_complete =true;
	else
	$exam_complete =false;
}

}
shuffle($q_array);
//
$_SESSION['exam']=$row_e['Exam'];
$_SESSION['questions']=$q_array;
$_SESSION['all']=count($q_array);
/*************************************************************************/
if(!$act->exam_taken($_REQUEST['user_id'],$row_e['Exam']) && $row_e['Exam']!=0)//$row_e['Exam']!=0 means if the user is assigned for an exam
{
	if($exam_complete){
?>
<input type="button" value="Start Exam" onFocus="hideMenu();" onclick="ajax_load('div_ajax_space','exam_sheet.php?all=<?php echo $_SESSION['all'];?>&start=true&exam=<?php echo end($q_array)?>')" />
<?php
	}
	else
	{echo"Sorry, you cann not proceed with this exam. some or all questions has been deleted.";}
}
else if($row_e['Exam']==0)
echo "You are not assigned to an exam.";
else
echo"You already took this exam.";
?>