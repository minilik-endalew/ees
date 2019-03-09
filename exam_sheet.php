<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
//$list=$_SESSION['questions'];
//print_r($_SESSION['questions']);
//print_r($q_array_rand);
//for($i=0;$i<count($q_array);$i++)
if(isset($_POST['submitAnswer']))
{//$_SESSION['examinee']
//$_SESSION['exam']
//print_r($_SESSION);
	//print_r($_POST);Array ( [question] => 20 [choice] => 51 [submitAnswer] => Submit and Next ) 
$act->write_answer($_SESSION['exam'],$_SESSION['examinee'],$_POST['choice']);	
	}
if(count($_SESSION['questions'])==0)
{
	
	$sql_complete="INSERT INTO `examinee_exam`(`id`, `examinee`, `exam`, `remark`) VALUES (NULL,'".$_SESSION['examinee']."','".$_SESSION['exam']."','')";
	$res_complete=mysqli_query($link,$sql_complete)or die(mysqli_error($link));
	
	//
	//print score
	$sql_score="SELECT * FROM `examinee_answer` WHERE `choice` IN ( SELECT `ID` FROM `choice` WHERE `Answer` = 'YES' )";
	
	$res_score=mysqli_query($link,$sql_score)or die(mysqli_error($link));
	$score=mysql_num_rows($res_score);
	//$row_score=mysql_fetch_row($res_score);
	echo"<b>you scored ". $score." out of ". $_SESSION['all']."</b>";
	
	$sql_log_score="INSERT INTO `examinee_score`(`id`, `exam`, `examinee`, `score`, `remark`) VALUES (NULL,'".$_SESSION['exam']."','".$_SESSION['examinee']."','".$score."','')";
	$res_log_score=mysqli_query($link,$sql_log_score)or die(mysqli_error($link));
	
		if($res_complete && $res_log_score)
	echo"You have completed your exam.<br>";
	
}
	else
	{
		//print_r($_SESSION['questions']);
if(isset($_REQUEST['start'])&&$_REQUEST['start']=="true")
{
	//echo $q_array[$i]."<br>";
	$act->PrintExam($_REQUEST['exam']);
	array_pop($_SESSION['questions']);
}
else
{
	
	//print_r($_SESSION['questions']);
	$act->PrintExam(end($_SESSION['questions']));
	array_pop($_SESSION['questions']);
	
	}
echo $_SESSION['all']-count($_SESSION['questions'])." of ".$_SESSION['all'];	

	}
	
	?>
