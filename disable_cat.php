<!doctype html>
<html>
<head>
<meta charset="utf-8">

</head>

<body>
<?php
session_start();
require_once('classes/common.php');
$act=new Common();
if(isset($_REQUEST['action'])&& $_REQUEST['action']=="disable"){
$sql="UPDATE `aau_pgees`.`question_category` SET `active` = 'No' WHERE `question_category`.`id` ='".$_REQUEST['cid']."';";
//echo $sql;
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
if($res)
echo "The selected category is disabled successfully";
}
?>
</body>
</html>