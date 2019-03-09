<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();

//print_r($_POST);
//Array ( [qid] => 4 [edit_question] => He ________ gone to work yesterday. John was there all day and nobody saw him. [edit_choice] => Array ( [0] => mustn't have [1] => wasn't have [2] => can't have ) [edit_answer] => Array ( [0] => on ) ) 
//stage 1
$sql_edit_q="UPDATE `aau_pgees`.`question` SET `Question` = '".mysql_real_escape_string($_POST['edit_question'])."' WHERE `question`.`ID` ='".$_POST['qid']."';";
$res_update_q=mysqli_query($link,$sql_edit_q)or die(mysqli_error($link));
//stage 2
$del_choice="DELETE FROM `choice` WHERE `Question`='".$_POST['qid']."'";
$res_del=mysqli_query($link,$del_choice)or die(mysqli_error($link));
/***********************************************/

$key=$_POST['edit_answer'];//only one answer
//print_r($key);
for($i=0;$i<count($_POST['edit_choice']);$i++){
$insert_choise="INSERT INTO `choice`(`ID`, `Question`, `Choice_label`, `Choice`, `Answer`, `Type`) VALUES (NULL,'".$_POST['qid']."','".$_POST['choic_label'][$i]."','".
mysql_real_escape_string($_POST['edit_choice'][$i])."','";
//if($i==$key[0])
if(in_array($i,$key))
$insert_choise.="Yes";
else
$insert_choise.="No";
$insert_choise.="','Unique')";
//echo $insert_choise;
$res_inster=mysqli_query($link,$insert_choise)or die(mysqli_error($link));
}

/**********************************************************/
if($res_del && $res_inster && $res_update_q) {
    if(isset($_SESSION['linked_resource'])){
        //--------------------------------
        $linked_resource_query = "SELECT  `name` FROM `resource` WHERE `question`='" . $_POST['qid'] . "' AND `type`='Picture'";
        $res_has_pic=mysqli_query($link,$linked_resource_query);
        if(mysql_num_rows($res_has_pic)) {
            $update_picture_q="UPDATE `resource` SET `name`='".$_SESSION['linked_resource']."'  WHERE `type`='Picture' AND `question`='".$_POST['qid']."'";
            $question_res_result = mysqli_query($link,$update_picture_q) or die(mysql_error("Update picture for question error:"));
        }else {
            $question_resource_query = "INSERT INTO `resource`(`id`, `name`, `type`, `category`, `question`) VALUES
(NULL,'" . $_SESSION['linked_resource'] . "','Picture',NULL,'" . $_POST['qid'] . "')";
            //echo $question_resource_query;
            $question_res_result = mysqli_query($link,$question_resource_query) or die(mysql_error("insert picture for question error:"));
        }
    }

    echo "Question updated successfully";

}
?>

</body>
</html>