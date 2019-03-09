<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
//print_r($_REQUEST);
// Array ( [action] => reset [exam] => 1 [examinee] => 1 ) 
if(isset($_REQUEST['action'])&&$_REQUEST['action']=="reset"){
$exam_reset="DELETE FROM `examinee_exam` WHERE `examinee`='".$_REQUEST['examinee']."' and `exam`='".$_REQUEST['exam']."'";
$answer_reset="DELETE FROM `examinee_answer` WHERE `exam`='".$_REQUEST['exam']."' AND `examinee`='".$_REQUEST['examinee']."'";
$exam_reset_result=mysqli_query($link,$exam_reset)or die(mysqli_error($link));
$answer_reset_result=mysqli_query($link,$answer_reset)or die(mysqli_error($link));
if($exam_reset_result && $answer_reset_result)
echo"Reset complete. <br>Exam records and Answers of the examinee has been deleted.";
}
else if(isset($_REQUEST['action'])&&$_REQUEST['action']=="delete"){
$delete="DELETE FROM `exam_allocation` WHERE `id`='".$_REQUEST['id']."'";
$res=mysqli_query($link,$delete) or die(mysqli_error($link));
if($res)
echo"Allocation deleted.";
}
?>
</body>
</html>
