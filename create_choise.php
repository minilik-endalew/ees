<div id="div_save_choice">
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();

$limit=$act->GetFieldByQuery("SELECT `amount` FROM `question_category` WHERE `id`='".$_SESSION['categoryID']."'");
$curr=$act->GetFieldByQuery("SELECT COUNT(`ID`) FROM `question`  WHERE `Active`='Yes' AND `category`='".$_SESSION['categoryID']."' GROUP BY(`category`)");
//print_r($_REQUEST);//Array ( [bizat] => 2 [type] => English [question] => tt ) 

//echo"curr=".$curr;
//echo"<br>limit=".$limit;
if($curr<$limit){
  if(isset($_POST['type']))
    $type=$_POST['type'];
  else
    $type=Null;
$create_question="INSERT INTO `question`(`ID`,  `Question`,`Instructor`,`category`,`Active`, `Remark`) VALUES (NULL,'".mysql_real_escape_string($_POST['question'])."','".$_SESSION['user_id']."','".$_SESSION['categoryID']."','Yes','')";

$res=mysqli_query($link,$create_question)or die("Error on create_question query:".mysqli_error($link));
//if($res){
	$qid=mysql_insert_id();
	//echo $qid;
//	}
  if(isset($_SESSION['linked_resource'])){
    $question_resource_query="INSERT INTO `resource`(`id`, `name`, `type`, `category`, `question`) VALUES
(NULL,'".$_SESSION['linked_resource']."','Picture',NULL,'$qid')";
    $question_res_result=mysqli_query($link,$question_resource_query) or die(mysql_error("insert picture for question error:"));
  }
	$label= array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J');
?>

<form name="form_save_choice_"  method="post" id="form_save_choice_">
<input type="hidden" name="Q_id" value="<?php echo $qid;?>" />
<table width="658" border="0" id="tbl_creat_choise">
<?php for($i=1;$i<=$_REQUEST['bizat'];$i++){?>
  <tr>
    <td width="33"><?php echo $label[$i]. " . ";?> <input type="hidden" value="<?php echo $label[$i];?>" name="label[]" /></td>
    <td width="343">
    <!--<input type="text"  name="choice[]" size="50"  />-->
      <a onclick="javascript:openEditor('choice[<?php echo $i?>]');" href="#" class="myButton" title="Copy what you wrote paste into the Equation (LaTeX) of the 'insert equation' function in the WYSIWYG editor  ." value="" >Math</a>
      <a onclick="inlineCKE('choice[<?php echo $i?>]');" href="#" class="myButton" title="This converts the text-area into WYSIWYG editor.click on (Fx) or 'insert equation' to write mathematical equation" value="" >Convert to WYSIWYG</a>
      <textarea name="choice[]" id="choice[<?php echo $i?>]"  cols="50" rows="2" ></textarea>
    </td>
    <td width="268">
    Answer <input type="checkbox" name="answer[]"  value="<?php echo $i-1; ?>" />
     </td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
  <td colspan="2">
    <!--<a href="#" class="myButton" onclick="ajaxPost('save_choice.php','form_save_choice','div_question_form');" >Save</a>-->
    <input type="button" class="myButton" onclick="ajaxPost('save_choice.php','form_save_choice_','div_save_choice');" value="Save" />
  </td></tr>
</table>
</form>

 <?php }
else
echo"<p>You can create only <b>$limit</b> questions under this category.</p>";
?>
</div>