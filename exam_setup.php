<?php 

@session_start();
require_once('classes/common.php');
$act=new Common();


//print_r($_POST);
//Array ( [exam_name] => Exam for PG [type] => English [pupulate] => ... [question_ids] => 1,2,4,9,11,14,15,17, [time_for_singl] => 2 [time_for_full_exam] => 45 [one_by_one] => Yes [remark] => Entrance scheduled )
//Array ( [exam_name] => the test [type] => English [pass_percentage] => 1 [time_for_singl] => 2 [time_for_full_exam] => 3 [Mode] => Yes [exam_date] => 12/3/2015 [active] => Yes [remark] => rem )
if($_REQUEST['action']=="save"){
$sql="INSERT INTO `exam_plan`(`ID`, `Exam_name`, `Subject_Type`, `Pass_persentage`, `Time_for_single_question_in_minutes`, `Time_for_the_whole_exam`, `Mode`, `Exam_Date`, `Active`, `Remark`) VALUES (NULL,'".$_POST['exam_name']."','".$_POST['type']."','".$_POST['pass_percentage']."','".$_POST['time_for_singl']."','".$_POST['time_for_full_exam']."','".$_POST['mode']."','".$_POST['exam_date']."','".$_POST['active']."','".$_POST['remark']."')";

$result=mysqli_query($link,$sql)or die(mysqli_error($link));
$examID=mysql_insert_id();
$cat_sql="SELECT `id`, `category_name`, `Instruction`, `amount`, `passage`, `active`, `remark` FROM `question_category` WHERE `active`='Yes' AND `Subject`='".$_POST['type']."'";
$cat_res=mysqli_query($link,$cat_sql)or die(mysqli_error($link));
?>
<p>&nbsp;</p>
<form name="select_cat_form">
<input type="hidden" name="exam_id" value="<?php echo $examID ?>">
<table width="200" border="0">
<?php 
while($cat_row=mysql_fetch_array($cat_res)){
?>
  <tr>
    <td><input type="checkbox" name="selected_category[]" value="<?php echo $cat_row['id']?>"></td>
    <td>
    <ul>
    	<li style="background-color:#FFF"><b><?php echo $cat_row['category_name'];?></b>
        <li><?php echo $cat_row['Instruction'];?>
        <li style="background-color:#FFF"><?php echo $cat_row['amount'];?>
        <li><?php if($cat_row['passage']==0)echo "No passage"; else echo "Has passage"?>
     </ul>
    </td>
  </tr>
  <?php } ?>
  <tr>
  <td>&nbsp;</td><td><input type="button" value="Add to exam" id="addtoexam" name="addtoexam" onClick="ajaxPost('save_exam.php','select_cat_form','div_ajax_space')"></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
<?php
}
else if($_REQUEST['action']=="update")
{
	//Array ( [exam_name] => the test [type] => English [pass_percentage] => 1 [time_for_singl] => 2 [time_for_full_exam] => 3 [Mode] => Yes [exam_date] => 12/3/2015 [active] => Yes [remark] => rem )

	$sql="UPDATE `exam_plan` SET `Exam_name`='".$_POST['exam_name']."',`Subject_Type`='".$_POST['type']."',`Pass_persentage`='".$_POST['pass_percentage']."',`Time_for_single_question_in_minutes`='".$_POST['time_for_singl']."',`Time_for_the_whole_exam`='".$_POST['time_for_full_exam']."',`Mode`='".$_POST['mode']."',`Exam_Date`='".$_POST['exam_date']."',`Active`='".$_POST['active']."',`Remark`='".$_POST['remark']."' WHERE `ID`='".$_REQUEST['eid']."'";
		//$sql="UPDATE `exam_plan` SET `Exam_name`='".$_POST['exam_name']."',`Subject_Type`='".$_POST['type']."',`Amount`='".$_POST['amount']."',`Questions`='".$_POST['Questions']."',`pass_mark`='".$_POST['pass_mark']."',`Time_for_single_question_in_minutes`='".$_POST['time_for_singl']."',`Time_for_the_whole_exam`='".$_POST['time_for_full_exam']."',`Mode`='".$_POST['mode']."',`Exam_Date`='".$_POST['exam_date']."',`Active`='".$_POST['active']."',`Remark`='".$_POST['remark']."' WHERE `ID`='".$_REQUEST['eid']."'";
	$result=mysqli_query($link,$sql)or die(mysqli_error($link));
}
else if($_REQUEST['action']=="delete")
{
	$sql="DELETE FROM `exam_plan` WHERE `ID`='".$_REQUEST['id']."'";
	$result=mysqli_query($link,$sql)or die(mysqli_error($link));
	//
	}
	//echo $sql;

if($result)
echo"Success.";

?>