<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
$cat_sql="SELECT  `category_name`, `Instruction`, `amount`, `passage`, `remark` FROM `question_category` WHERE `id`='".$_POST['category']."'";
$cat_res=mysqli_query($link,$cat_sql)or die(mysqli_error($link));
$cat_row=mysql_fetch_array($cat_res);

//echo"huh";
//print_r($_REQUEST);  [category] => 42 
//print_r($_POST);
?>
<table width="376" border="0">
  <tr>
    <td>Catetory Name</td>
    <td><?php echo $cat_row['category_name']?></td>
  </tr>
  <tr>
    <td>Instruction</td>
    <td><?php echo $cat_row['Instruction']?></td>
  </tr>
  <tr>
    <td># of Questions</td>
    <td><?php echo $cat_row['amount']."[";
$active_q="SELECT COUNT(`ID`) FROM `question` WHERE `Active`='Yes' AND `category`='".$_POST['category']."' ";
      $bzat=mysql_result(mysqli_query($link,$active_q),0);
   echo $bzat." Active ]";

      ?></td>
  </tr>
  <tr>
    <td>Passage</td>
    <td><?php 
	//echo $cat_row['passage'];
	if($cat_row['passage']=="")
	echo"No passage";
	else
	{
		$_SESSION['passageID']=$cat_row['passage'];
		$url="paragraphform.php?id=".$cat_row['passage'];//openCenteredWindow($url)
	echo"<a href='#' class='myButton' onClick=openCenteredWindow('$url')>passage</a>";
	}
	//echo $cat_row['passage']?></td>
  </tr>
  <tr>
    <td>Picture/Document</td>
    <td><?php
      $check_resource="SELECT * FROM `resource` WHERE `type`='Picture' AND `category`='".$_POST['category']."'";
      $result_check_image=mysqli_query($link,$check_resource)or die("check error1: ".mysqli_error($link));
      if(mysql_num_rows($result_check_image)>0)
      include("show_picture.php");

      $check_resource2="SELECT `name` FROM `resource` WHERE `type`='Document' AND `category`='".$_POST['category']."'";
      $result_check_doc=mysqli_query($link,$check_resource2)or die("check error2: ".mysqli_error($link));
      if(mysql_num_rows($result_check_doc)>0)
      {
        $doc=mysql_fetch_row($result_check_doc);
        echo"<div><a href='".$doc[0]."' target='_blank'>Download: ".$doc[0]."</a></div>";
      }

      ?>

    </td>
  </tr>
  <tr>
    <td colspan="2"><a href="#" class="myButton" 
    onClick="ajax_load('div_ajax_space','create_question_form.php?action=edit&id=<?php echo $_POST['category'];?>')">Edit Category</a> | <a href="#" class="myButton" onClick="ajax_load('div_ajax_space','questions_list.php?cid=<?php echo $_POST['category'];?>')">Get questions</a> |  <a href="#" class="myButton" onClick="if(confirm('This category will be excluded. Continue?')){ ajax_load('div_ajax_space','disable_cat.php?action=disable&cid=<?php echo $_POST['category'];?>')}">Disable Category</a></td>
    
  </tr>
</table>

</body>
</html>