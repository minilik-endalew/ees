<?php
@session_start();
require_once('classes/common.php');
$act=new Common();



$sql="SELECT `ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Roll`, `User_Name`,`Active` FROM `user`";
$cols="`ID`,`First_Name`, `Middle_Name`, `Last_Name`, `Roll`, `User_Name`,`Active`";//cols must include ID's
$act->DynamicSearchForAjax('user','search.php','div_ajax_space',$cols);
$act->DisplayByQueryFull($sql,'user','modify_users.php','div_ajax_space');
$_SESSION['modifyer_file']="modify_users.php";

?>