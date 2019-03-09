<?php
@session_start();
require_once('classes/common.php');
$act=new Common();

//print_r($_POST);Array ( [] => instFN [] => instMN [] => instLN [] => Instructor [] => email@domain.com [] => inst [password] => 183224d27b72b647391e179fa311b891 [] => Yes [] => remark )
$sql="UPDATE `user` SET `First_Name`='".$_POST['firstname']."',`Middle_Name`='".$_POST['middlename']."',`Last_Name`='".$_POST['lastname']."',`Roll`='".$_POST['roll']."',`Email`='".$_POST['email']."',`User_Name`='".$_POST['username']."',`Active`='".$_POST['active']."',`Remark`='".$_POST['remark']."' WHERE `ID`='".$_POST['ID']."'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));

$uuser="UPDATE `aau_pgees`.`examinee` SET `Approved` = 'Yes' WHERE `examinee`.`UserID` ='".$_POST['ID']."';";
$uresult=mysqli_query($link,$uuser)or die(mysqli_error($link));
if($res && $uresult)
echo"Success";
?>