<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();

$sql="SELECT `ID` , `Question` FROM `question` WHERE  `category`='".$_REQUEST['cid']."' AND `Active` = 'Yes'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$i=1;
?>
<div align="right"></div>
<form name="form_multiple_delete" method="post">
  <table width="781" border="0" bgcolor="#CCCCFF">
    <?php
	$questions=array();
while($row=mysql_fetch_array($res)){
array_push($questions,$row['ID']);
}
print_r($_SESSION);
shuffle($questions);
$_SESSION['questions']=$questions;
//after randomization....
foreach($_SESSION['questions']as $quest){
	?>
    <tr>
      <td width="26"><?php echo $i?></td>
      <td width="680"><?php echo $row['Question']?></td>
     
    
    <!-- check this out --> 
    <tr>
      <td colspan='2'><?php 
	$sub_sql="SELECT `Choice_label`,`Choice`,`Answer` FROM `choice` WHERE `Question`='".$quest."'";
	$sub_res=mysqli_query($link,$sub_sql)or die(mysqli_error($link));
	?>
        <!--<table border='0' bgcolor='#FFFFFF' width='100%'>-->
        <ul style="padding:3px;">
          <?php
	while($sub_row=mysql_fetch_array($sub_res))
	{
		echo"<li style='padding:2px;'>".$sub_row['Choice_label'].". &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_row['Choice']."</li>";
	}
	?>
    </ul>
	<!--</table>-->
	<?php
    $i++;
}

?>
       </td></tr> 
  </table>
</form>
</body>
</html>