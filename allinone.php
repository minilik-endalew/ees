<?php
//print_r($_POST);
@session_start();
require_once('classes/common.php');
$act=new Common();
//$_POST['a_exam']
//ajax_load(where,what)
//ajaxPost(strURL,formname,responsediv)
//print_r($_POST);//Array ( [sprogram] => 186 [exam] => 5 )
$dept="SELECT `Department` FROM `department`";
$prog="SELECT `id`, `stream`, `msc`, `phd`, `dept_id` FROM `stream` ";
$res_prog=mysqli_query($link,$prog);
while($row_prog=mysql_fetch_array($res_prog)){

/*$exam="SELECT `ID`,`Exam_name`, `Subject_Type`, `Active` FROM `exam_plan` WHERE `Active`='Yes'";
$res_exam=mysqli_query($link,$exam);
while($row_exam=mysql_fetch_array($res_exam)){
*/	
	
$view="SELECT `view_exam_result`.`Study_Subject`, `view_exam_result`.`exam`, `view_exam_result`.`examinee`,concat(`examinee`.`First_Name`,' ',`examinee`.`Middle_Name` ) as `Full name` ,   SUM(  `view_exam_result`.`mark` ) as `score` 
FROM  `view_exam_result`,`examinee`
WHERE `view_exam_result`.examinee=`examinee`.`ID` 
AND `view_exam_result`.`exam`='".$_POST['a_exam']."' 
AND `view_exam_result`.`Study_Subject`='".$row_prog['id']." '
GROUP BY  `view_exam_result`.`examinee` ,  `view_exam_result`.`exam`
ORDER BY `score` ASC ";


/*$analyticq="SELECT   `view_exam_result`.`examinee`,concat(`examinee`.`First_Name`,' ',`examinee`.`Middle_Name` ) as `Full name` ,   SUM(  `view_exam_result`.`mark` ) as `score`
FROM  `view_exam_result`,`examinee`
WHERE `view_exam_result`.examinee=`examinee`.ID AND `view_exam_result`.`exam`='".$_POST['exam']."' AND `view_exam_result`.`Study_Subject`='".$_POST['sprogram']."'

GROUP BY  `view_exam_result`.`examinee` ,  `view_exam_result`.`exam`
ORDER BY `score` ASC ";*/
$act->DisplayByQuery($view);

//}//end of while loop for row_exam
}//end of while loop for row_prog

echo"<hr>";
echo"<div align='center'>mark distribution in range of 10</div><br>";
//mysql_free_result()
$result=mysqli_query($link,$view);

$res_array=array();
while($row=mysql_fetch_array($result)){
   array_push($res_array,$row['score']);
}
//$input=$res_array;
//$input = array(10,15,18,25,88,20);
$max_val= count($res_array)==0?0:max($res_array);
$step=10;
echo"<table>";
echo"<tr><th>Range in $step<th>Frequency";
$total=0;
for($i=1;$i<=$max_val;$i+=$step){
	$count=count(array_intersect($res_array,range($i,$i+$step-1)));
	//$freq=array_count_values(array_intersect($res_array,range($i,$i+$step-1)));
	//print_r($freq);
	/*foreach($freq as $item){
		echo $item;
	}*/
	echo "<tr><td>". $i ." to ". ($i+$step-1) ." </td><td> ".$count."</td></tr>";
	$total+=$count;
}
echo"<tr><td>total</td><td>$total</td></tr>";
echo"</table>";
?>