<?php

@session_start();
require_once('classes/common.php');
$act=new Common();
//print_r($_POST);Array ( [select_field] => Question_Type [] => = [search_key] => English ) [table]=>xxx
if($_POST['operator']=="contains")
$sql="SELECT ".$_POST['display_cols']." FROM `".$_POST['table']."` WHERE `".$_POST['select_field']."` LIKE('%".$_POST['search_key']."%') ";
else
$sql="SELECT ".$_POST['display_cols']." FROM `".$_POST['table']."` WHERE `".$_POST['select_field']."`".$_POST['operator']."'".$_POST['search_key']."'";
$act->DynamicSearchForAjax($_POST['table'],'search.php','div_ajax_space',$_POST['display_cols']);
$act->DisplayByQueryFull($sql,$_POST['table'],$_SESSION['modifyer_file'],'div_ajax_space');

?>