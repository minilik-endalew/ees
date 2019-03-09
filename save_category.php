
<body>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
//$_REQUEST['cid']
function ResourceDetail($category){
	$check_if_linked_pic=mysqli_query($link,"SELECT * FROM `resource` WHERE `category`='".$category."' and `type`='Picture'")or die("error_check1:".mysqli_error($link));
	$check_if_linked_doc=mysqli_query($link,"SELECT * FROM `resource` WHERE `category`='".$category."' and `type`='Document'")or die("error_check2:".mysqli_error($link));
	//echo $check_if_linked_pic;
	if(mysql_num_rows($check_if_linked_pic)>0 ){
		//update
		if (isset($_SESSION['linked_resource'])) {

			$resouce_update="UPDATE `resource` SET `name`='".$_SESSION['linked_resource']."' WHERE `category`='".$category."' AND `type`='".$_SESSION['linked_type']."'";
			//echo $resouce_update;
			$res_update_resource=mysqli_query($link,$resouce_update)or die("update resource error:".mysqli_error($link));
		}
	}
	if(mysql_num_rows($check_if_linked_doc)>0){
		if (isset($_SESSION['linked_resource_doc'])) {

			$resouce_update="UPDATE `resource` SET `name`='".$_SESSION['linked_resource_doc']."' WHERE `category`='".$category."' AND `type`='".$_SESSION['linked_type']."'";
			//echo $resouce_update;
			$res_update_resource=mysqli_query($link,$resouce_update)or die("update resource error:".mysqli_error($link));
		}
	}
	if(mysql_num_rows($check_if_linked_pic)==0) {
		if (isset($_SESSION['linked_resource'])) {
			$resource_sql_4_update = "INSERT INTO `resource`(`id`, `name`, `type`, `category`, `question`) VALUES
(NULL,'" . $_SESSION['linked_resource'] . "','".$_SESSION['linked_type']."','" . $category . "',NULL)";
			//echo $resource_sql_4_update;
			$result_picture = mysqli_query($link,$resource_sql_4_update) or die("Error4:" . mysqli_error($link));
		}
	}
	if(mysql_num_rows($check_if_linked_doc)==0){
		$resource_sql_doc_add = "INSERT INTO `resource`(`id`, `name`, `type`, `category`, `question`) VALUES
(NULL,'" . $_SESSION['linked_resource_doc'] . "','".$_SESSION['linked_type']."','" . $category . "',NULL)";
		//echo $resource_sql_doc_add;
		$result_picture = mysqli_query($link,$resource_sql_doc_add) or die("Error5:" . mysqli_error($link));

	}
}
//end of function
if(isset($_SESSION['thepassagecontent'])) {
	$sql_passage = "INSERT INTO `passage`(`id`, `paragraph`, `questions`,`category`, `remark`) VALUES (NULL,'" . $_SESSION['thepassagecontent'] . "','0','0','null')";
	//$_SESSION['thepassagecontent'] = $_POST['passage'];
	//echo $sql;+

	$result_passage = mysqli_query($link,$sql_passage) or die("Error6".mysqli_error($link));
	$_SESSION['passageID']=mysql_insert_id();
}
else
	unset($_SESSION['thepassagecontent']);
//print_r($_POST);
// Array ( [catagoryname] => cat [instruction] => inst [q_amount_cat] => 4 [has_paragraph] => yes [] => ) action=update
if(isset($_POST['passageID'])&& $_POST['passageID']!="")
$psg=$_SESSION['passageID'];
else
$psg='NULL';

if($_REQUEST['action']=="update"){
	$sql="UPDATE `question_category` SET `category_name`='".mysql_real_escape_string($_POST['catagoryname'])."',`Instruction`='".$_POST['instruction']."',`passage`='".$_SESSION['passageID']."',`amount`='".mysql_real_escape_string($_POST['q_amount_cat'])."' WHERE `id`='".$_REQUEST['cid']."'";
	$res=mysqli_query($link,$sql)or die("Error1".mysqli_error($link));
	if($res)
{
	ResourceDetail($_REQUEST['cid']);
	echo"Category has been updated successfully";
}
	}
else{
$sql="INSERT INTO `question_category`(`id`, `category_name`, `Instruction`, `amount`,`Subject`, `passage`,`remark`) VALUES (null,'".mysql_real_escape_string($_POST['catagoryname'])."','".mysql_real_escape_string($_POST['instruction'])."','".mysql_real_escape_string($_POST['q_amount_cat'])."','".mysql_real_escape_string($_POST['subject'])."',".$psg.",null)";
$res=mysqli_query($link,$sql)or die("Error2".mysqli_error($link));
if($res)
{
	echo"Category has been created successfully";
	$_SESSION['categoryID']=mysql_insert_id();
	$_SESSION['cat_amount']=mysql_real_escape_string($_POST['q_amount_cat']);

	$ucsql="INSERT INTO `aau_pgees`.`inst_category` (
`id` ,
`inst_id` ,
`category` ,
`date`
)
VALUES (
NULL , '".$_SESSION['user_id']."', '".$_SESSION['categoryID']."',
CURRENT_TIMESTAMP
);";
	$res22=mysqli_query($link,$ucsql)or die(mysqli_error($link));


	if(isset($_SESSION['thepassagecontent'])) {
		$sql_passage = "INSERT INTO `passage`(`id`, `paragraph`, `questions`,`category`, `remark`) VALUES (NULL,'" . $_SESSION['thepassagecontent'] . "','0','" . $_SESSION['categoryID'] . "','null')";
		//$_SESSION['thepassagecontent'] = $_POST['passage'];
		//echo $sql;
		$result_passage = mysqli_query($link,$sql_passage) or die("Error3:".mysqli_error($link));
	}
	ResourceDetail($_REQUEST['cid']);
?>
<br>
<a href="#" class="myButton" onClick="ajax_load('div_create_category','question.php')"  onClicks="ajaxPost('question.php','form_create_category','question_creator_div');" >Create questions in this category</a>
<?php 
}
else
{
	unset($_SESSION['categoryID']);
	unset($_SESSION['cat_amount']);
	}
}//end of main else
?>
</body>
