<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

</head>

<body>
<?php
//print_r($_REQUEST);
//print_r($_SESSION['exam_category']);//examinee
/*
$exams="SELECT `exam` FROM `examinee_exam` WHERE `examinee`='".$_SESSION['examinee']."'";
$res_exams=mysqli_query($link,$exams)or die(mysqli_error($link));
while($row_exams=mysql_fetch_assoc($res_exams)){
*/
//print_r($_SESSION);//Array ( [fullname] => nardos gulilat [logged] => 1 [username] => nardos@gmail.com [roll] => Examinee [user_id] => 12 [examinee] => 11 [exam] => 34 [mode] => All questions in exam [exam_category] => Array ( [0] => 49 [1] => 50 ) )
//$sql="SELECT `id`, `exam`, `examinee`, `score`, `remark` FROM `examinee_score` WHERE `examinee`=(SELECT `ID` FROM `examinee` WHERE `UserID`='".$_SESSION['user_id']."')";
//echo $sql;

$sql="SELECT `id`, `exam`, `examinee`, `category`, `question`, `answer_choice`
FROM `examinee_answer`
WHERE `examinee` = '".$_SESSION['examinee']."'
AND `exam`='".$_REQUEST['exam']."'
GROUP BY(`category`)
";
//echo $sql;
$res=mysqli_query($link,$sql)or die(mysqli_error($link));

//if(mysql_num_rows($res)>0){
//;
?>
<table width="585" border="0">
<tr>
	<th width="348">Category</th>
    <th width="92">Your Score</th>
    <th width="131">Number of question</th>
</tr>
<?php 
$total=0;
$gtotal=0;
while($row=mysql_fetch_array($res)){
?>
  <tr>
	  
    <td><?php echo $act->GetField("category_name","question_category",$row['category']);?></td>
    <td><?php
      $res_q="SELECT COUNT(`id`) as `score` FROM `examinee_answer` WHERE `exam`='".$row['exam']."' and `examinee`='".$row['examinee']."' and `category`='".$row['category']."'  and `answer_choice` IN(
SELECT `ID` FROM `choice` WHERE `Answer`='Yes'
)";
      $result=mysqli_query($link,$res_q);
      $score=mysql_fetch_row($result);
      //print_r($score);
      $total+=$score[0];
      echo $score[0];
      ?></td>
    <td><?php 
	//
	$noq=$act->GetFieldByQuery("SELECT COUNT(`Question`) FROM `question` WHERE `category`='".$row['category']."' and `Active`='yes'");
	//$noq=$act->GetField("amount","question_category",$row['category']);
	echo $noq; 
	$gtotal+=$noq;
	?></td>
  </tr>
  <?php }?>
  <tr>
    <td ><strong>Total</strong></td>
    <td><strong><u><?php echo $total; ?></u></strong></td>
    <td><strong><u><?php echo $gtotal; ?></u></strong></td>
  </tr>
</table>

<?php //}
//}
//else
//echo "No record found.";
?>
</body>
</html>