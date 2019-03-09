<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<?php 
session_start();
require_once('classes/common.php');
$act=new Common();
//INSERT INTO `examinee_answer`(`id`, `exam`, `examinee`, `category`, `question`, `answer_choice`, `remark`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
//print"<pre>";
//print_r($_SESSION);
/*
Array
(
    [fullname] => nardos gulilat
    [logged] => 1
    [username] => nardos@gmail.com
    [roll] => Examinee
    [user_id] => 12
    [examinee] => 11
    [exam_category] => Array
        (
            [0] => 49
            [1] => 50
        )

    [questions] => Array
        (
            [0] => 130
            [1] => 131
        )

    [exam] => 34
)
*/
//print"</pre>";
/*Array
(
    [49_128] => 241
    [49_127] => 238
    [49_126] => 234
    [49_129] => 246
    [50_131] => 251
    [50_130] => 250
    [submit] => Submit
)*/
//print_r(array_reduce($_POST,"pick"));
//'One question at a time','All questions in category','All questions in exam'
if($_SESSION['mode']=="All questions in exam" ||$_SESSION['mode']=="All questions in category"){
array_pop($_POST);
$answer=$_POST;
//print_r($_POST);
foreach($answer as $key=>$val){
//echo "<br>Cat_quest:".$key."=".$val;
$cat_quest=explode("_",$key);
//print_r($cat_quest);
	//$act->get_exam($cat_quest[0],$cat_quest[1]) this method is used to extract the exam provided category and question
$act->write_answer($_SESSION['exam'],$_SESSION['examinee'],$cat_quest[0],$cat_quest[1],$val,$_SESSION['examinee_']);
//next($answer);
}
/*if($cat_quest[0]<=9)
		$fetena=1;
		else
		$fetena=2;*/
$fin=mysqli_query($link,"INSERT INTO `examinee_exam`(`id`, `examinee`, `exam`,`category`, `remark`) VALUES (NULL,'".$_SESSION['examinee']."','".$_SESSION['exam']."','".$cat_quest[0]."','".date("Y-m-d H:i:s")."')")or die(mysqli_query($link,));
	if($fin){
	echo "Done.<br>You have successfully submitted your answers.";
	}
	if($act->exam_complete($row['examinee'],$row['exam']))
	{
		echo"<h2 style='color:red'>Please <a href='inside2.php'> refresh </a> the page only if you do not get the a success message for your submission </h2>";
		}
}

else if($_SESSION['mode']=="One question at a time")
{}
?>
</body>
</html>