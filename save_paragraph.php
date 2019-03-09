
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
$_SESSION['PassageSaveMessage']=null;
if($_REQUEST['action']=="update"){
	$sql="UPDATE `passage` SET `paragraph`='".$_POST['passage']."',`questions`='".$_POST['amount']."' WHERE `id`='".$_REQUEST['pid']."'";
	$result=mysqli_query($link,$sql)or die(mysqli_error($link));
	if($result)
	echo"Update was successful.";
	}else{
//print_r($_POST);
//SESSIONS Array ( [fullname] => Gedion Habtamu [logged] => 1 [username] => inst [roll] => Instructor [user_id] => 2 [passageID] => 36 [passage_q_amount] => 10 [categoryID] => 30 [cat_amount] => 20 ) 
//INSERT INTO `passage`(`id`, `paragraph`, `questions`, `remark`) VALUES ([value-1],[value-2],[value-3],[value-4])
$sql_passage="INSERT INTO `passage`(`id`, `paragraph`, `questions`,`category`, `remark`) VALUES (null,'".$_POST['passage']."','".$_POST['amount']."','".$_SESSION['categoryID']."','null')";
$_SESSION['thepassagecontent']=$_POST['passage'];
	//echo $sql;
	$result=mysqli_query($link,$sql_passage)or die(mysqli_error($link));
if($result && isset($_POST['passage'])){
	$_SESSION['passageID']=mysql_insert_id();
	$_SESSION['passage_q_amount']=$_POST['amount'];
	$_SESSION['PassageSaveMessage']="Passage saved successfully";
	?>

	<?php }
	else{
		$_SESSION['PassageSaveMessage']="Passage was not saved successfully";
	unset($_SESSION['passageID']);
	unset($_SESSION['passage_q_amount']);
	}
}
?>
