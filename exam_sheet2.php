<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
$categories=$_SESSION['exam_category'];
shuffle($categories);
if($_SESSION['mode']=="All questions in exam"){
foreach($categories as $c){
$csql="SELECT  `category_name`, `Instruction`, `amount`, `passage`, `active`, `Subject`, `remark` FROM `question_category` WHERE `id`='$c'";
$cres=mysqli_query($link,$csql)or die(mysqli_error($link));
?>
<table width="755" border="1" bordercolorlight="#66CCFF" style="color:white">
 <?php 
 
	 while($crow=mysql_fetch_assoc($cres)){
	 ?>
  <tr>
    <td width="83"><?php echo $crow['category_name'];
	
	?>
   <!--<button id="btn" onClick="majorpointsexpand(this.innerHTML)" title="Expand Passage"> + </button>-->
<div id="div_passgae_display" style="display:block">
<?php 
if($crow['passage']!=0){
	
	$url="paragraphform.php?id=".$crow['passage'];//openCenteredWindow($url)
	echo"<a href='#' class='myButton' onClick=openCenteredWindow('$url')>passage</a>";
	
//$act->DisplayByQuery("SELECT `paragraph` FROM `passage` WHERE `id`='".$crow['passage']."'","passage");
}
?>
</div>
    </td>
    <td width="593"><?php echo $crow['Instruction']?><br>[<?php 
	//-------------------------------------------------------------------
$activeq="SELECT COUNT(`ID`) FROM `question` WHERE `Active`='yes' and `category`='$c'";
$resq=mysqli_query($link,$activeq) or die(mysqli_error($link));
$active_questions_in_catagory=mysql_fetch_row($resq);
echo $active_questions_in_catagory[0];
//------------------------------------------------------------------
	echo $crow['amount']." questioins avilable";?>]</td>
    
  </tr>
  <tr>
    <td colspan="2"><div>
    <?php
		
$sql="SELECT `ID` , `Question` FROM `question` WHERE  `category`='".$c."' AND `Active` = 'Yes'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$i=1;
?>
    <form name="form_submit_answer" method="post">
      <table width="791" border="1" bgcolor="#CCCCFF" bordercolorlight="#6666FF">
    <?php
//while($row=mysql_fetch_array($res)){
	
$questions=array();
while($row=mysql_fetch_array($res)){
array_push($questions,$row['ID']);
}
//print_r($_SESSION);
shuffle($questions);
$_SESSION['questions']=$questions;
//after randomization....
foreach($_SESSION['questions']as $quest){
	?>
    <tr style="background-color: white">
      <td width="26"><?php echo $i?></td>
      <td width="680"><?php echo $act->GetFieldByQuery("SELECT `Question` FROM `question` WHERE `ID`='$quest'")?></td>
     
    
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
	{//<input type='hidden' name='answer".$c.$quest."[]' value='".$sub_row['Answr']."'>
		//the choices 
		echo"<div style='color: white'><label><li style='padding:2px;'><input type='radio' name='".$c."_".$quest."' value='".$sub_row['ID']."'>".$sub_row['Choice_label'].". &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_row['Choice']."</li><hr /></label></div>";
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
      <?php }}?>
      <input class="myButton" type="button" value="Submit" name="submit" onClick="ajaxPost('save_answers.php','form_submit_answer','div_exam_space')">
</form>
<?php 
}
else if($_SESSION['mode']=="All questions in category" || $_SESSION['mode']=="One question at a time")
{
	?>
    <div id="div_cat_list">
	<table bordercolorlight="#6666FF" border="1" width="100%">
 <?php 
foreach($_SESSION['exam_category'] as $c){
$csql="SELECT  `category_name`, `Instruction`, `amount`, `passage`, `active`, `Subject`, `remark` FROM `question_category` WHERE `id`='$c'";
$cres=mysqli_query($link,$csql)or die(mysqli_error($link));

	 while($crow=mysql_fetch_assoc($cres)){
	 ?>
  <tr>
    <td width="83"><?php echo $crow['category_name']?></td>
    <td width="593"><?php echo $crow['Instruction']?><br>[
      <?php 
	//-------------------------------------------------------------------
$activeq="SELECT COUNT(`ID`) FROM `question` WHERE `Active`='yes' and `category`='$c'";
$resq=mysqli_query($link,$activeq) or die(mysqli_error($link));
$active_questions_in_catagory=mysql_fetch_row($resq);
echo $active_questions_in_catagory[0]." questioins avilable";
//------------------------------------------------------------------
	//echo $crow['amount']?>
      ]</td>
    <td>
    <?php //print_r($_SESSION);
	//sessions [examinee] => 12 [exam] => 2
	$sql_completion_control="SELECT `id`, `exam`, `examinee`, `category`, `question`, `answer_choice` FROM `examinee_answer` WHERE `exam`='".$_SESSION['exam']."' AND `examinee`='".$_SESSION['examinee']."' AND `category`='".$c."'";
	$res_completion_control=mysqli_query($link,$sql_completion_control)or die(mysqli_error($link));
	$responded_questions_in_cat=mysql_num_rows($res_completion_control);
	if($responded_questions_in_cat==0)
	{
	?>
	<div>
    <a href="#div_questions_cat_mode" rel="scroll" name="catButton" id="<?php echo $c;?>" class="myButton"
    onClick="if(confirm('You can not get this button again. Continue?')){hidethis(this.id);ajax_load('div_questions_cat_mode','list_per_cat.php?id=<?php echo $c?>')}else{return(false);}">Respond</a>
    </div>
    <?php
	}else
	{
		echo"You have answered $responded_questions_in_cat questions in this category.";
		}
	?>
    </td>
  </tr>
  
  <?php }}?>
</table>
<script>
function focusOnElement(element_id) { // when the DOM is ready...
alert(element_id);
window.scrollTo(0, document.getElementById(element_id).scrollHeight);
/*var top=document.getElementById(element_id).position().top;
alert(top);
$(window).scrollTop(top);
  */  //$('#'+element_id).scrollIntoView(true);//div_questions_cat_mode
}
</script>
<div id="div_questions_cat_mode"></div>
</div>
	<?php
	}
//else if($_SESSION['mode']=="One question at a time")
//{}
?>