<!doctype html>
<html>
<head>
<meta charset="utf-8">

</head>

<body>

<?php

@session_start();
require_once('classes/common.php');
$act=new Common();

//SELECT `ID`, `Exam_name`, `Subject_Type`, `Pass_persentage`, `Time_for_single_question_in_minutes`, `Time_for_the_whole_exam`, `One_questioin_at_a_time`, `Exam_Date`, `Active`, `Remark` FROM `exam_plan` WHERE 1
$sql="SELECT `ID`, `Exam_name`, `Subject_Type` as `Type`,   `Exam_Date`, `Active` FROM `exam_plan` WHERE 1";
$cols="`ID`, `Exam_name`, `Subject_Type` as `Type`, `Pass_persentage`, `Exam_Date`, `Active`";
//$act->FilterAssist("exam_plan");
$act->DynamicSearchForAjax('exam_plan','search.php','div_ajax_space',$cols);
$act->DisplayByQueryFull($sql,'exam_plan','modify_exam.php','div_ajax_space');
$_SESSION['modifyer_file']="modify_exam.php";
?>

</body>
</html>