<?php 

@session_start();
require_once('classes/common.php');
$act=new Common();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php
//print_r($_POST);
//Array ( [exam_id] => 24 [selected_category] => Array ( [0] => 1 [1] => 22 [2] => 30 [3] => 35 [4] => 47 ) [addtoexam] => Add to exam ) 
$sql="INSERT INTO `exam_category`(`id`, `exam`, `category`) VALUES ";
foreach($_POST['selected_category'] as $catid)
$sql.="(NULL,'".$_POST['exam_id']."','".$catid."'),";
$sql=$act->TrimLastComma($sql);
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
if($res)
echo"Success";
?>
</body>
</html>