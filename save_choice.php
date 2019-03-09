
<body>
<p>
  <?php
@session_start();
require_once('classes/common.php');
$act=new Common();

$key=$_POST['answer'];//only one answer
//print_r($key);


for($i=0;$i<count($_POST['label']);$i++){
$insert_choise="INSERT INTO `choice`(`ID`, `Question`, `Choice_label`, `Choice`, `Answer`, `Type`) VALUES
(NULL,'".mysql_real_escape_string($_POST['Q_id'])."','".mysql_real_escape_string($_POST['label'][$i])."','".
mysql_real_escape_string($_POST['choice'][$i])."'";
//if($i==$key[0])
if(in_array($i,$key))
$insert_choise.=",'Yes'";
else
$insert_choise.=",'No'";
$insert_choise.=",'Unique')";
//echo $insert_choise;
mysqli_query($link,$insert_choise)or die(mysqli_error($link));
}
echo "Question created successfully.";
//header("Location:create_question_form.php");
//if(isset($_SESSION['passageID'])){

	//}
?>
</p>
<p>  <a href="#" class="myButton" onClick="ajax_load('div_ajax_space','question.php')" >Add an other question</a></p>
</body>
