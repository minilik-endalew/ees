<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>question</title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="ckeditor/sample.css">
<script type="text/javascript" src="ajaxFunctions.js"></script>
</head>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
//print_r($_SESSION);
?>

<body>
<div><a href="inside2.php" class="myButton">Cancel</a></div>
<fieldset class="majorpoints" >
    <button id="btn" onClick="majorpointsexpand(this.innerHTML)" title="Expand Passage"> + </button>
<div id="div_passgae_display" style="display:none">

<?php
$sql="SELECT `passage`
FROM `question_category`
WHERE `id` = '".$_SESSION['categoryID']."'
AND `passage` IS NOT NULL ";
//echo $sql;
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$rrow=mysql_fetch_array($res);
$PID=$rrow['passage'];
//echo "PID=".$PID;
if(isset($_SESSION['passageID'])&& $PID!=0){
	echo"<P align='center'><strong>Passage</strong></P>";
	$act->DisplayByQuery("SELECT `paragraph` FROM `passage` WHERE `id`='".$PID."'","passage");
	}
?>
</div>
</fieldset>
<div id="div_question_form">
<form name="form_create_question" method="post" action="">
    <div id="div_create_choices">
  <p></p>
     Enter the question here:<br>
    <textarea id="question" name="question" cols="100" class="ckeditor" rows="3" ></textarea>
    
  
  
  
  <p><div id="creat_question_button_div">
            <a href="#" onClick="if(document.getElementById('question').value!=''){var n=prompt('How many choices?');ajaxPost('create_choise.php?bizat='+n,'form_create_question','div_create_choices');}else{alert('Fill the question field first.');return false;}" class="myButton">
                Save and continue
            </a>
            </div>
        </p>
  
  </div>
</form>
</div>
<div id="div_create_choice"></div>
</body>
</html>