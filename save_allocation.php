
<?php
//mysqli_connect('localhost','root','root@lh','aau_pgees')or die(mysqli_error());
@session_start();
require_once('classes/common.php');
$act=new Common();
?>
<?php
//print_r($_POST);//Array ( [] => Array ( [0] => 1 [1] => 4 ) [selected_exam] => 1 )
$exam=$_POST['selected_exam'];
//echo "exam=".$exam;
if(isset($_POST['generic_checkbox'])){
//$sql="INSERT INTO `exam_allocation`(`id`, `examinee`, `exam`, `remark`) VALUES ";
//$sql="UPDATE `aau_pgees`.`examinee` SET `Exam` = '".$_POST['selected_exam']."' WHERE `examinee`.`ID` IN (";
//for late debug !!!!!!!!!!!!!!!!!!!!!!!!!!!
//Check all button for some reason deactivates the selected exam. So i am resolving this with a fake way
$count=0;
for($i=0;$i<count($_POST['generic_checkbox']);$i++)
{
	if($exam=="all active exams")
	{
		//get all active exams
		$aeq="SELECT `ID`, `Exam_name` FROM `exam_plan` WHERE `Active`='Yes'";
		$aeqr=mysqli_query($link,$aeq)or die(mysqli_error($link));
		while($active_exam_list=mysql_fetch_assoc($aeqr)){
			$sql="INSERT INTO `exam_allocation`(`id`, `examinee`, `exam`, `remark`) VALUES(NULL,'".$_POST['generic_checkbox'][$i]."','".$active_exam_list['ID']."','')";//1 was supposed to be $exam
			$check=mysqli_query($link,"SELECT * FROM `exam_allocation` WHERE `examinee`='".$_POST['generic_checkbox'][$i]."' and `exam`='".$active_exam_list['ID']."'");

			if(mysql_num_rows($check)==0)
			{
				$res=mysqli_query($link,$sql)or die(mysqli_error($link));
				echo "<div id='note'>Allocation was successful</div>";

			}

			else
				echo"<div id='note'>One or more allocation instance is already in the list. Allocation must be unique</div>";
		}
	}else{
		//print_r($_POST['generic_checkbox']);
	$sql="INSERT INTO `exam_allocation`(`id`, `examinee`, `exam`, `remark`) VALUES(NULL,'".$_POST['generic_checkbox'][$i]."','$exam','')";//1 was supposed to be $exam
$check=mysqli_query($link,"SELECT * FROM `exam_allocation` WHERE `examinee`='".$_POST['generic_checkbox'][$i]."' and `exam`='$exam'");
if(mysql_num_rows($check)==0) {
	$res = mysqli_query($link,$sql) or die(mysqli_error($link));
	echo "<div id='note'>Allocation was successful</div>";
}
else
	echo"<div id='note'>One or more allocation instance is already in the list. Allocation must be unique</div>";
//$sql="INSERT INTO `exam_allocation`(`id`, `examinee`, `exam`, `remark`) VALUES(NULL,'".$_POST['generic_checkbox'][$i]."','2','')";//delete this after fixing the bug
//$check=mysqli_query($link,"SELECT * FROM `exam_allocation` WHERE `examinee`='".$_POST['generic_checkbox'][$i]."' and `exam`='2'");
//if(mysql_num_rows($check)==0){
//$res=mysqli_query($link,$sql)or die(mysqli_error($link));
//echo $sql;
}}
//$count++;
}
//$sql=$act->TrimLastComma($sql);
//$sql.=")";

//

else
echo"<div id='note'>You have to select atleast one candidate to complete this operation</div>";
?>
</body>
</html>