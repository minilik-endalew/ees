<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
$cat_sql="SELECT `category` FROM `exam_category` WHERE `exam`='".$_REQUEST['eid']."'";
//echo $cat_sql;
$cat_res=mysqli_query($link,$cat_sql)or die(mysqli_error($link));

while($cat_row=mysql_fetch_array($cat_res)){
$cat_sql="SELECT  `category_name`, `Instruction`, `amount`, `passage`, `remark` FROM `question_category` WHERE `id`='".$cat_row['category']."'";
$cat_res=mysqli_query($link,$cat_sql)or die(mysqli_error($link));
if(mysql_num_rows($cat_res)>0){
$cat_detail_row=mysql_fetch_array($cat_res);

//echo"huh";
//print_r($_REQUEST);  [category] => 42 
//print_r($_POST);
?>
<table width="376" border="0">
  <tr>
    <td width="158">Catetory Name</td>
    <td width="208"><?php echo $cat_detail_row['category_name']?></td>
  </tr>
  <tr>
    <td>Instruction</td>
    <td><?php echo $cat_detail_row['Instruction']?></td>
  </tr>
  <tr>
    <td># of Questions</td>
    <td><?php echo $cat_detail_row['amount']?></td>
  </tr>
  <tr>
    <td>Passage</td>
    <td><?php 
	//echo $cat_row['passage'];
	if($cat_detail_row['passage']=="")
	echo"No passage";
	else
	{
		$_SESSION['passageID']=$cat_detail_row['passage'];
		$url="paragraphform.php?id=".$cat_detail_row['passage'];//openCenteredWindow($url)
	echo"<a href='#' class='myButton' onClick=openCenteredWindow('$url')>passage</a>";
	}
	//echo $cat_row['passage']?></td>
  </tr>
  <tr>
      <td colspan="2"><a href="#" class="myButton" onClick="ajax_load('div_ajax_space','questions_list2.php?cid=<?php echo $cat_row['category'];?>')">Get questions</a></td>
  </tr>
</table>

<?php }else{echo"No category found";}

}?>
</body>
</html>