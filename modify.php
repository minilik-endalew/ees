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
$qid=$_REQUEST['id'];
//print_r($_REQUEST);
$sql="SELECT `question`.`Type`,`question`.`Question`,`choice`.`Choice_label`,`choice`.`Choice`,`choice`.`Answer` FROM `question`,`choice` WHERE `question`.`ID`=`choice`.`Question` AND `question`.`ID`='".$qid."'";
$result=mysqli_query($link,$sql)or die(mysqli_error($link));
$qrow=mysql_fetch_array($result);
//$qrow=mysql_result($result,0,1);

//$choices=mysql_num_rows($result);
if($_REQUEST['action']=="edit"){
?>

<form name="form_edit_question">
<table width="595" border="0">
  <tr>
    <td width="35">&nbsp;<input type="hidden" name="qid" value="<?php echo $qid;?>"></td>
    <td colspan="2">
		<div style="font-size: x-small; color: #cc2222; font-style: italic; float: right;">
			<b><u>Instruction for building Math formula</u></b><br>
			<li>Click on "Insert Math Formula"</li>
			<li>Build your equation using visual tools and the builder generates LaTex code</li>
			<li>Click on View &gt; MathML translation </li>
			<li>Copy everything generated as XML code in a small window</li>
			<li>Close the builder window and paste the MathML code in the place where you want the formula</li>
			<li>save</li>
		</div>
		<div>
		<?php


        $_REQUEST['quest']=$qid;
        include('show_picture.php');
        ?>
        Link picture<input name="has_picture" id="has_picture" type="checkbox" value="yes"
                           onClick="if(this.checked){openCenteredWindow('pictures.php')}">
    </div>
		<a onclick="javascript:openEditor('edit_question');" href="#" class="myButton" title="Copy what you wrote \n paste into the Equation (LaTeX) of the 'insert equation' function in the WYSIWYG editor  .">Buid Math Formula</a>
		<a onclick="inlineCKE('edit_question');" href="#" class="myButton" title="This converts the text-area into WYSIWYG editor.click on (Fx) or 'insert equation' to write mathematical equation">Convert the space to WYSIWYG Editor</a>
    <textarea name="edit_question" id="edit_question" cols="70"><?php echo $qrow['Question'];?></textarea>
    </td>
  </tr>
  <?php
  //mysql_close();
  $result=mysqli_query($link,$sql)or die(mysqli_error($link));
  $k=0;
   while($row=mysql_fetch_array($result)){//for($i=1;$i<=$choices;$i++){?>
  <tr>
    <td><?php echo $row['Choice_label'];?><input type="hidden" name="choic_label[]" value="<?php echo $row['Choice_label'];?>"></td>
    <td width="468">
		<a onclick="inlineCKE('edit_choice[<?php echo $k;?>]');" href="#" class="myButton" title="This converts the text-area into WYSIWYG editor.click on (Fx) or 'insert equation' to write mathematical equation">Convert to WYSIWYG </a>
		<textarea rows="2" cols="120" id="" name="edit_choice[<?php echo $k;?>]"><?php echo $row['Choice'];?></textarea>
		<!--<input name="edit_choice[<?php /*echo $k;*/?>]"  type="text" value="<?php /*echo $row['Choice'];*/?>" size="80"/></td>-->
    <td width="78">Answer 
      <input type="checkbox" name="edit_answer[]" <?php if($row['Answer']=='Yes'){?>checked="checked" <?php }?> value="<?php echo $k; ?>" /></td>
  </tr> 
  <?php $k++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="button" onclick="ajaxPost('save_edit.php','form_edit_question','div_ajax_space')" value="Save"></td>
  </tr>
 
</table>
</form>
<?php 
}
else if($_REQUEST['action']=="delete")
{
	$sql1="DELETE FROM `choice` WHERE `Question`='".$qid."'";
	$sql2="DELETE FROM `question` WHERE `ID`='".$qid."';";
	$res1=mysqli_query($link,$sql1)or die(mysqli_error($link));
	$res2=mysqli_query($link,$sql2)or die(mysqli_error($link));
	
	if($res1 && $res2)
	echo"The question is successfully deleted with its choices.";
	
	}
	else if($_REQUEST['action']=="disable")
	{
		$disable_q="UPDATE `aau_pgees`.`question` SET `Active` = 'No' WHERE `question`.`ID`='".$qid."'";
		$res=mysqli_query($link,$disable_q)or die(mysqli_error($link));
		if($res)
		echo"The question is successfully disabled.";
	}
	else if($_REQUEST['action']=="enable"){
		$disable_q="UPDATE `aau_pgees`.`question` SET `Active` = 'Yes' WHERE `question`.`ID`='".$qid."'";
		$res=mysqli_query($link,$disable_q)or die(mysqli_error($link));
		if($res)
			echo"The question is successfully enabled.";
	}
else if($_REQUEST['action']=="mul_del")
{
	//print_r($_POST);Array ( [check_mul_del] => Array ( [0] => 38 [1] => 39 [2] => 41 [3] => 43 [4] => 45 [5] => 47 ) ) 
	$mul_del_query1="DELETE FROM `choice` WHERE `Question` IN (";
	$mul_del_query2="DELETE FROM `question` WHERE `ID` IN (";
	for($i=0;$i<count($_POST['check_mul_del']);$i++)
	{
		$mul_del_query1.="'".$_POST['check_mul_del'][$i]."',";
		$mul_del_query2.="'".$_POST['check_mul_del'][$i]."',";
	}
	$mul_del_query1=$act->TrimLastComma($mul_del_query1);
	$mul_del_query2=$act->TrimLastComma($mul_del_query2);
	
	$mul_del_query1.=")";
	$mul_del_query2.=")";
	$mul_del_res1=mysqli_query($link,$mul_del_query1)or die(mysqli_error($link));
	$mul_del_res2=mysqli_query($link,$mul_del_query2)or die(mysqli_error($link));
	if($mul_del_res1 && $mul_del_res2)
	echo"Success.";
}
else if($_REQUEST['action']=="mul_dis")
{
	$mul_dis_q="UPDATE `aau_pgees`.`question` SET `Active` = 'No' WHERE `question`.`ID` IN(";
	for($i=0;$i<count($_POST['check_mul_del']);$i++)
	{
		$mul_dis_q.="'".$_POST['check_mul_del'][$i]."',";		
	}
	$mul_dis_q=$act->TrimLastComma($mul_dis_q);
	$mul_dis_q.=")";
	$mul_dis_res=mysqli_query($link,$mul_dis_q)or die(mysqli_error($link));
	if($mul_dis_res)
	echo"Success";
	}
else if($_REQUEST['action']=="mul_en")
{
	$mul_dis_q="UPDATE `aau_pgees`.`question` SET `Active` = 'Yes' WHERE `question`.`ID` IN(";
	for($i=0;$i<count($_POST['check_mul_del1']);$i++)
	{
		$mul_dis_q.="'".$_POST['check_mul_del1'][$i]."',";
	}
	$mul_dis_q=$act->TrimLastComma($mul_dis_q);
	$mul_dis_q.=")";
	$mul_dis_res=mysqli_query($link,$mul_dis_q)or die(mysqli_error($link));
	if($mul_dis_res)
		echo"Success";
}

?>
</body>
</html>