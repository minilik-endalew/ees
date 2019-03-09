<?php

@session_start();
require_once('classes/common.php');
$act=new Common();

$eid=$_REQUEST['id'];
//print_r($_REQUEST);//Array ( [action] => view [id] => 1 )
if($_REQUEST['action']=="view")
{
	$sql="SELECT * FROM `exam_plan` WHERE `ID`='".$eid."'";
	$act->DisplaySingle($sql);
	echo"<br><a href=# onClick=\"ajax_load('div_ajax_space','cat_under_exam.php?eid=".$eid."')\" class='myButton'>Get categories</a>";
}
else if ($_REQUEST['action']=="edit")
{
	
	include("create_exam.php");
	
	}
else if($_REQUEST['action']=="delete")
{
	include("exam_setup.php");
	}
?>