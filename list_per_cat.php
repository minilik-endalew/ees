
<body>
<hr>
<h3 onload="focusOnElement(this)">
  <?php
session_start();
require_once('classes/common.php');
$act=new Common();

$e_sql_="SELECT `ID` FROM `examinee` WHERE `UserID`='".$_SESSION['user_id']."'";
	$e_res_=mysqli_query($link,$e_sql_)or die(mysqli_error($link));
	$e_row_=mysql_fetch_row($e_res_);
	$_SESSION['examinee_']=$e_row_[0];

if($_SESSION['examinee']==0 || $_SESSION['examinee']==''){
	?>
  <strong style="font-family: Arial, Helvetica, sans-serif; color: #F00;" >Connection might have been lost. Please LOG-OFF and then LOG-IN again to safely resume</strong>
  <?php
    include("logout.php");
	}

$c=$_REQUEST['id'];



  $check_if_linked_pic=mysqli_query($link,"SELECT * FROM `resource` WHERE `category`='".$c."' and `type`='Picture'")or die("error_check1:".mysqli_error($link));
  $check_if_linked_doc=mysqli_query($link,"SELECT `name` FROM `resource` WHERE `category`='".$c."' and `type`='Document'")or die("error_check2:".mysqli_error($link));
  //echo $check_if_linked_pic;
  if(mysql_num_rows($check_if_linked_pic)>0 ){
      //update
      $_REQUEST['cat']=$c;
      include("show_picture.php");
      }
  if(mysql_num_rows($check_if_linked_doc)>0){
      $doc=mysql_fetch_row($check_if_linked_doc);
      echo"<div><a href='".$doc[0]."' target='_blank'>Download: ".$doc[0]."</a></div>";
  }



$csql="SELECT  `category_name`, `Instruction`, `amount`, `passage`, `active`, `Subject`, `remark` FROM `question_category` WHERE `id`='$c'";
$cres=mysqli_query($link,$csql)or die(mysqli_error($link));
$crow=mysql_fetch_assoc($cres);
echo $crow['category_name'];
echo"<br>INSTRUCTION:<u>".$crow['Instruction']."</u>";
	if($crow['passage']!=0){
		?>
  <!--========================================this is creazy=================================-->
  <!--<fieldset class="majorpoints" >-->
</h3>
<button id="btn" onClick="majorpointsexpand(this.innerHTML)" title="Expand Passage"> + </button>
Click the +/- to toggle the passage
<div id="div_passgae_display" style="display:block">
		<?php
		
		$act->DisplayByQuery("SELECT `paragraph` as `Passage` FROM `passage` WHERE `id`='".$crow['passage']."'","passage");
	//$url="paragraphform.php?id=".$crow['passage'];//openCenteredWindow($url)
	//echo"<p><a href='#' class='myButton' onClick=openCenteredWindow('$url')>passage</a></p>";
	}
?></div><?php	
$sql="SELECT `ID` , `Question` FROM `question` WHERE  `category`='".$c."' AND `Active` = 'Yes'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$i=1;

?>
<form name="form_submit_answer" method="post">
  <table width="781" border="0" bgcolor="white">
    <?php
//while($row=mysql_fetch_array($res)){
	$examinee=$_SESSION['examinee'];
$questions=array();
while($row=mysql_fetch_array($res)){
array_push($questions,$row['ID']);
}
//print_r($_SESSION['questions']);
shuffle($questions);
$_SESSION['questions']=$questions;
//after randomization....
foreach($_SESSION['questions']as $quest){
	?>
    <tr>
      <td width="26"><?php echo $i?></td>
      
      <td width="680"><?php
          //------------------------------------------------------------------------
	  $question_query="SELECT `Question` FROM `question` WHERE `ID`='".$quest."'";
	  //echo $question_query;
	  echo $act->GetFieldByQuery($question_query);

          $linked_resource_query = "SELECT  `name` FROM `resource` WHERE `question`='" . $quest . "' AND `type`='Picture'";
          $res_has_pic=mysqli_query($link,$linked_resource_query);
          if(mysql_num_rows($res_has_pic)) {
              $_REQUEST['quest'] = $quest;
              include('show_picture.php');
          }
          ?></td>
    
    <!-- check this out --> 
    <tr>
      <td colspan='2'><?php 
	$sub_sql="SELECT `ID`,`Choice_label`,`Choice`,`Answer` FROM `choice` WHERE `Question`='".$quest."'";
	$sub_res=mysqli_query($link,$sub_sql)or die(mysqli_error($link));
	?>
        <!--<table border='0' bgcolor='#FFFFFF' width='100%'>-->
        <ul style="padding:3px;">
          <?php
	while($sub_row=mysql_fetch_array($sub_res))
	{//echo"<input type='hidden' name='remark[]' value='$examinee' >";
		//the choices 
		echo"<label><li style='padding:2px;'><input type='radio' name='".$c."_".$quest."' value='".$sub_row['ID']."'>".$sub_row['Choice_label'].". &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_row['Choice']."</li></label>";
	//$fakeid=$c."_".$quest;
	}
	
	?>
    </ul>
	<!--</table>-->
	<?php
    $i++;
	
}
/****************************ebdet new******************************/



?>

    </td></tr> 
  </table>
  <p>
   
   <!-- <input class="myButton" type="button" value="Submit" name="submit" onClick="ajaxPost('save_answers.php','form_submit_answer','div_questions_cat_mode')">-->
    <a href="#div_questions_cat_mode" rel="scroll" title="Submit Answer" onClick="if(confirm('Please Confirm the submission and make sure that you respond for all questions.NOTE: You can click on Cancel to modify your answer')){ajaxPost('save_answers.php','form_submit_answer','div_questions_cat_mode');return true;}else{return false;}"  class="myButton"> Submit</a>
  </p>
  <br>
  <p><!--<a href="inside2.php" class="myButton" onClick="if(confirm('Are you sure you responded for all categories? This action terminates your examination session and results in AUTOMATIC LOGOUT.')){ajaxPost('save_answers.php?action=finish','form_submit_answer','div_questions_cat_mode');return true;}else{return false;}">Finish Exam</a>--></p>
 <div align="right" style="visibility:collapse"> <?php echo"<input type='radio' name='ta' value='0' checked>";?>
</div>
</form>
</body>
