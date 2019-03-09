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
$sql="SELECT `id`, `exam`, `examinee`, `score`, `remark` FROM `examinee_score`";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));

?>
<table width="603" border="0">
  <tr bgcolor="#FFC68C">
    <td>Candidate Name</td>
    <td>Exam</td>
    <td>Pass mark</td>
    <td>Score</td>
    <td>Status</td>
  </tr>
  <tr>
  <?php
  while($row=mysql_fetch_array($res)){
  ?>
    <td><?php echo $act->GetFullName('examinee',$row['examinee']);?></td>
    <td><?php echo $act->GetField('Exam_name','exam_plan',$row['exam']);?></td>
    <td><?php echo $act->GetField('pass_mark','exam_plan',$row['exam']);?></td>
    <td><?php echo $row['score'];?></td>
    <td><?php
    if($row['score']>=$act->GetField('pass_mark','exam_plan',$row['exam']))
	echo "Pass";
	else
	echo "Fail";
	?></td>
  </tr>
  <?php }?>
</table>
</body>
</html>