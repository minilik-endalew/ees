<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 22-11-2016
 * Time: 4:15 PM
 */
@session_start();
require_once('classes/common.php');
$act=new Common();
//ajax_load(where,what)
//ajaxPost(strURL,formname,responsediv)
//print_r($_POST);//Array ( [sprogram] => 186 [exam] => 5 )
$analyticq="SELECT   `view_exam_result`.`examinee`,concat(`examinee`.`First_Name`,' ',`examinee`.`Middle_Name` ) as `Full name` ,   SUM(  `view_exam_result`.`mark` ) as `score`
FROM  `view_exam_result`,`examinee`
WHERE `view_exam_result`.examinee=`examinee`.ID AND `view_exam_result`.`exam`='".$_POST['exam']."' AND `view_exam_result`.`Study_Subject`='".$_POST['sprogram']."'

GROUP BY  `view_exam_result`.`examinee` ,  `view_exam_result`.`exam`
ORDER BY `score` ASC ";
$act->DisplayByQuery($analyticq);
echo"<hr>";
echo"<div align='center'>mark distribution in range of 10</div><br>";
//mysql_free_result()
$result=mysqli_query($link,$analyticq);

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
/*
$range10 = range(1,10);
echo "<br>1-10".count(array_intersect($res_array,$range10));
$range20 = range(11,20);
echo "<br>11-20".count(array_intersect($res_array,$range20));
$range30 = range(21,30);
echo "<br>21-30".count(array_intersect($res_array,$range30));
$range40 = range(31,40);
echo "<br>31-40".count(array_intersect($res_array,$range40));
$range50 = range(41,50);
$range60 = range(51,50);
$range70 = range(61,70);
$range80 = range(71,80);
$range90 = range(81,90);
$range100 = range(91,100);
$range110 = range(101,110);
$range120 = range(111,120);
$range130 = range(121,130);

*/
//$output = array_intersect($input , $myrange );
//print_r($output );
?>