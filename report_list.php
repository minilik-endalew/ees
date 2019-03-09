<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Report</title>
</head>

<body>
<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
//ajax_load(where,what)
//ajaxPost(strURL,formname,responsediv)
?>
Pick an active exam:
<form name="frm_pick_exam">
<input type="hidden" name="sprogram" value="<?php echo $_POST['program']?>">
    <select name="exam" onchange="ajaxPost('report_analysis.php','frm_pick_exam','div_report_analysis')">
        <option>--select one--</option>
        <?php $act->DropDownItems("SELECT `ID`,`Exam_name` FROM `exam_plan`");?>
    </select>
</form>
<hr>
<div id="div_report_analysis"></div>
<hr>
<button onclick="<?php //$act->test();?>">Show detail</button>
<?php
if(1==2){
//$act->DynDropDownByQuery("SELECT `ID`,`Exam_name` FROM `exam_plan` WHERE `Active`='yes'");
//print_r($_POST); //[sel_department] => 14
//$sql="SELECT `First_Name`, `Middle_Name`, `Last_Name`, `Sex`, `Enrollment_Level`, `Study_Subject`, `exam`, `examinee`, `category`, `question`, `answer_choice`, `Answer` FROM `view_result` WHERE `Study_Subject`='".$_POST['sel_department']."'";

/*$analyticq="SELECT  `Study_Subject` ,  `exam` ,  `examinee`  ,  `question` , SUM(  `mark` )
FROM  `view_exam_result`
WHERE `exam`='14' and `Study_Subject`='15'

GROUP BY  `examinee` ,  `exam`
ORDER BY SUM(  `mark` ) ASC ";*/



//$act->DisplayByQuery($sql,"examinee");
$sql="SELECT `ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Sex`, `Enrollment_Level` FROM `examinee` WHERE `Study_Subject`='".$_POST['program']."' and `Approved`='yes' AND `ID` IN( SELECT `examinee` FROM `examinee_answer`) order by(`First_Name`)";
//$act->DisplayByQuery("view_result");
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
?>
<table border="1" width="100%">
  <tr>
    <td>No</td>
    <td>First name</td>
    <td>Middle name</td>
    <td>Last name</td>
    <td>Sex</td>
   <!-- <td>Enrollement level</td>-->
   
  </tr>
  <?php 
  $i=0;
  
  while($row=mysql_fetch_array($res)){ 
  $total=0;
  $gtotal=0;
	  $i++;
	?>
	 <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $row['First_Name'];?></td>
    <td><?php echo $row['Middle_Name'];?></td>
    <td><?php echo $row['Last_Name'];?></td>
    <td><?php echo $row['Sex'];?></td>
    <!--<td><?php /*echo $row['Enrollment_Level'];*/?></td>--></tr>
    <tr><td colspan="6">
    
	<?php  
	  
	$sub_sql="SELECT  `exam`, `examinee`, `category`, `question`, `answer_choice`, count(`Answer`) score FROM `view_result`  WHERE `examinee`='".$row['ID']."' group by(`category`)";
 $sub_res=mysqli_query($link,$sub_sql) or die(mysqli_error($link));
 //$rows=mysql_num_rows($sub_res);
   ?>
 
   <table border="1"> 
   <tr><th>Category</th><th>Score</th><th>Out of</th></tr>
   <tr>
     <!--<td>Exam</td><td><?php //echo $act->GetField('exam_name','exam_plan',$row['exam']);?></td>-->
   <?php 
    while($sub_row=mysql_fetch_array($sub_res)){
 $total+=$sub_row['score'];
 $outof=$act->GetFieldByQuery("SELECT count(`Question`) FROM `question` WHERE `category`='".$sub_row['category']."' and `Active`='yes'");
 $gtotal+=$outof;
   ?>
    
    <tr><td><?php echo $act->GetField('category_name','question_category',$sub_row['category']);?></td>    
    <td><?php echo $sub_row['score'];?></td>
    <td><?php echo $outof;?></td>
  
  
  
   <?php 
 }
  
  ?><tr>
    <th><div align="right">Total</div></th>
    <td><strong><?php echo $total;?></strong></td>
    <td><?php echo $gtotal;?></td>
  </tr>
  </table>
  <?php 
 
  }
}//end of if 1=1
  ?>
</table>

</body>
</html>