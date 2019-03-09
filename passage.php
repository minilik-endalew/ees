<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="ckeditor/sample.css">

<title>Passage</title>
</head>

<body>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
$sql="SELECT `id`, `paragraph`, `questions`, `category`, `remark` FROM `passage` WHERE `id`='".$_REQUEST['id']."'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$row=mysql_fetch_array($res);

//print_r($_REQUEST);

?>
<div>
<table width="618" height="67"><tr>
  <td><?php print($row['paragraph'])?>
</td></tr></table>
</div>
</body>
</html>