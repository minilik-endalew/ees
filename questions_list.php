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
$_SESSION['categoryID']=$_REQUEST['cid'];
$sql="SELECT `ID` , `Question`,`category` FROM `question` WHERE  `category`='".$_SESSION['categoryID']."' AND `Active` = 'Yes'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$i=1;

?>
<a class="" href="#" onclick="if(window.confirm('This will load all disabled questions in the selected category. Continue?')){ajax_load('div_disabled_questions','disabled_questions.php')}">Show disabled</a>
<div style="background-color: orange" id="div_disabled_questions"></div>
<div align="right">
    <a class="myButton"  href="#" onclick="if(window.confirm('Are you sure you want to disable all selected questions? All will be avoided from exams.')){ajaxPost('modify.php?action=mul_dis','form_multiple_delete','div_ajax_space')}">Disable Selected</a> |
<a class="myButton" disabled="disabled" href="#" onclick="if(window.confirm('Are you sure you want to delete all selected questions? The associated choices will also be deleted.')){ajaxPost('modify.php?action=mul_del','form_multiple_delete','div_ajax_space')}">Delete Selected</a> |


</div>

<div>
<fieldset class="majorpoints" >
    <button id="btn" onClick="majorpointsexpand(this.innerHTML)" title="Expand Passage"> + </button>
<div id="div_passgae_display" style="display:none">
<?php
$psg=$act->GetField('passage','question_category',$_SESSION['categoryID']);
if($psg)
 $act->DisplayByQuery("SELECT `paragraph` FROM `passage` WHERE `id`='".$psg."'","passage");
$pic=mysqli_query($link,"SELECT  `name` FROM `resource` WHERE `type`='Picture' AND `category`='".$_SESSION['categoryID']."'")or die("error1:".mysqli_error($link));
if(mysql_num_rows($pic)>0){
    $picture=mysql_fetch_row($pic) or die("error2:".mysqli_error($link));
    echo"<img src='".$picture[0]."' width='200' />";
}
?>

</div>
<div>
<?php
//echo
if(mysql_num_rows($res)>0) {
    $cat = mysql_result($res, 0, 2);
    mysql_data_seek($res, 0);
    echo "<strong>" . $act->GetField('category_name', 'question_category', $cat);
    echo "<BR>Instruction: <BR><u>" . $act->GetField('Instruction', 'question_category', $cat) . "</u></strong>";
}
else
echo"Empty Category";
?>
</div>
<form name="form_multiple_delete" method="post">
  <table width="781" border="0" bgcolor="#CCCCFF">
      <tr><td colspan="5"></td><td><input type="checkbox" name="sel_all" title="Select All" onchange="if(this.checked){check_uncheck_all('check_mul_del[]',true)}else{check_uncheck_all('check_mul_del[]',false)}"></td></tr>
    <?php
while($row=mysql_fetch_array($res)){
	?>
    <tr>
      <td width="26"><?php echo $i?></td>
      <td width="680"><?php echo $row['Question']?>
      <div>
          <?php

          $linked_resource_query = "SELECT  `name` FROM `resource` WHERE `question`='" . $row['ID'] . "' AND `type`='Picture'";
$res_has_pic=mysqli_query($link,$linked_resource_query);
          if(mysql_num_rows($res_has_pic)) {
              $_REQUEST['quest'] = $row['ID'];
              include('show_picture.php');
          }
          ?>

      </td>
      <td width="16"><a href='#' onclick="ajax_load('div_ajax_space','modify.php?action=edit&id=<?php echo $row['ID']?>')"><img src="images/edit.png" alt="Edit" title="Edit"/></a></td>
      <td width="17"><a href='#'  title="Delete" onclick="if(window.confirm('Are you sure you want to delete the question? The associated choices will also be deleted.')){ajax_load('div_ajax_space','modify.php?action=delete&id=<?php echo $row['ID']?>')}"><img src="images/edit_remove.gif" alt="Delete"/> </a></td>
      
   <!-- check this out -->   
      <td width="17">
          
      <a href='#' title="Disable" onclick="if(window.confirm('Disable this question? It will be excluded from exams.')){ajax_load('div_ajax_space','modify.php?action=disable&id=<?php echo $row['ID']?>')}"><img src="images/state_stop.png" alt="disable"/></a></td>
      <td width="20"><input type="checkbox" name="check_mul_del[]" value="<?php echo $row['ID']?>"></td>
    
    <!-- check this out --> 
    <tr>
      <td colspan='6'><?php 
	$sub_sql="SELECT `Choice_label`,`Choice`,`Answer` FROM `choice` WHERE `Question`='".$row['ID']."'";
	$sub_res=mysqli_query($link,$sub_sql)or die(mysqli_error($link));
	?>
        <!--<table border='0' bgcolor='#FFFFFF' width='100%'>-->
        <ul style="padding:3px;">
        
          <?php
	while($sub_row=mysql_fetch_array($sub_res))
	{
		
		echo"<li style='padding:2px;'>".$sub_row['Choice_label'];
		if($sub_row['Answer']=="Yes")
		echo"*";
		echo". &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_row['Choice']."</li>";
	}
	?>
    
    </ul>
	<!--</table>-->
	<?php
    $i++;
}

?>
       </td></tr> 
  </table>
</form>
<input type="button" class="myButton" value="Add more question" onclick="ajax_load('div_ajax_space','question.php')" />
</body>
</html>