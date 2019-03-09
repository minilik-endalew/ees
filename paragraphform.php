<?php
session_start();
require_once('classes/common.php');
$act=new Common();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Passage</title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="ckeditor/sample.css">
<script type="text/javascript" src="ajaxFunctions.js"></script>
</head>

<body>
<?php
//print_r($_REQUEST);
if(isset($_REQUEST['id'])){
$sql="SELECT `id`, `paragraph`, `questions`, `category`, `remark` FROM `passage` WHERE `id`='".$_REQUEST['id']."'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$row=mysql_fetch_array($res);
}
?>
<form name="form_create_paragraph" method="post" id="form_create_paragraph">
<table width="842" height="568" border="0">
  <tr>
    <td colspan="2"><textarea placeholder="Paste the passage here..." name="passage" id="passage"  class="ckeditor" cols="120" rows="30" > <?php
    if(isset($_REQUEST['id'])){echo $row['paragraph'];}
    ?></textarea></td>
  </tr>
  <tr <?php if($_SESSION['roll']=="Examinee") echo"style='visibility:hidden'";?>>
    <td width="300">Number of questions  associate with this passage?    </td>
    <td width="345"><input type="text" name="amount" width="20" id="amount" <?php if(isset($_REQUEST['id'])){echo "value='".$row['questions']."'";}?> value="" onClick="alert(referer.document.getElementById('q_amount_cat').value)" onFocus="this.value=referer.document.getElementById('q_amount_cat').value"  /></td>
  </tr>
</table>
  <?php 
  if($_SESSION['roll']!="Examinee"){
  if(isset($_REQUEST['id'])){?>
<input type="button" value="Update" name="update" onClick="CKupdate();ajaxPost('save_paragraph.php?action=update&pid=<?php echo $_REQUEST['id'];?>','form_create_paragraph','div_save_paragraph');show_result();window.close();" >
<?php }
else{?>
<input type="button" value="Save" name="save" onClick="CKupdate();ajaxPost('save_paragraph.php','form_create_paragraph','div_save_paragraph');show_result();window.close();" >
<?php }}?>
</form>
<div id="loading" style="display:none;" class="loading">
            <img src="images/loading.gif"></div>
              </div>  
<div id="div_save_paragraph"></div>
</body>

</html>
