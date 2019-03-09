

<style>
    body {margin:20px;}
    .title {text-align:center;color:#145977;}
    .title a {font-size:200%;}
    .title img {vertical-align:middle;}
    .comment {color:#038208;}
    a,a:link,a:visited,a:active {color:#145977;text-decoration:none;}
    a:hover {color:#145977;text-decoration:underline;}
    form,fieldset,textarea {margin:0;padding:0;}
    fieldset {border:none;}
</style>

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
<div id="div_question_form"><div id="div_create_choices">
<form name="form_create_question" method="post" action="">
  <div style="font-size: x-small; color: #cc2222; font-style: italic; float: right;">
      <b><u>Instruction for building Math formula</u></b><br>
        <li>Click on "Insert Math Formula"</li>
        <li>Build your equation using visual tools and the builder generates LaTex code</li>
        <li>Click on View &gt; MathML translation </li>
        <li>Copy everything generated as XML code in a small window</li>
        <li>Close the builder window and paste the MathML code in the place where you want the formula</li>
        <li>save</li>
    </div>
     Enter the question here:<br>
    <script>

        //CKEDITOR.replace( 'question', { toolbar : [ [ 'EqnEditor', 'Bold', 'Italic' ] ] });

    </script>
<?php
/*// Include the CKEditor class.
include("ckeditor/ckeditor.php");

// Create a class instance.
$CKEditor = new CKEditor();

// Path to the CKEditor directory.
$CKEditor->basePath = '/ckeditor/';

// Replace all textarea elements with CKEditor.
$CKEditor->replaceAll();*/
?>

    <a onclick="javascript:openEditor('question');" href="#" class="myButton" title="Visually build your equation in (LaTeX) and convert int MathML">Insert Math Formula</a>
    <a onclick="inlineCKE('question');" href="#" class="myButton" title="This converts the text-area into WYSIWYG editor.click on (Fx) or 'insert equation' to write mathematical equation">Convert the space to WYSIWYG Editor</a>
    <textarea id="question" name="question" cols="100"  rows="3" ></textarea>

    <td>Link Picture</td>
    <td><input name="has_picture" id="has_picture" type="checkbox" value="yes" onClick="if(this.checked){openCenteredWindow('pictures.php')}"></td>
    <p><div id="creat_question_button_div"><a href="#" onClick="if(document.getElementById('question').value!=''){var n=prompt('How many choices?');ajaxPost('create_choise.php?bizat='+n,'form_create_question','div_create_choices');}else{alert('Fill the question field first.');return false;}" class="myButton">Save and continue</a></p>
  

</form>
</div></div>
<div id="div_create_choice"></div>
