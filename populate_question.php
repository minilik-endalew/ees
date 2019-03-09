<html>
<head>
<script src="ajaxFunctions.js"></script>
</head>
<body>
<?php 
//print_r($_REQUEST);Array ( [amount] => 8 [type] => English )

@session_start();
require_once('classes/common.php');
$act=new Common();
if($_REQUEST['type']=="Mixed")
$sql="SELECT `ID` , `Question` FROM `question`";
else
$sql="SELECT `ID` , `Question` FROM `question` WHERE `Type` = '".$_REQUEST['type']."'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$i=1;
?>

<script type="text/javascript">
arr=new Array();
function countCheckboxes(total) {
	var form = document.getElementById('form_poulate');
        var count = 0;
	 	
        for(var n=0;n < form.length;n++){
          if(form[n].name == 'question[]' && form[n].checked){
            count++;
			arr.push(form[n].value);
          }
        }
		//alert(total)
        //document.getElementById('checkCount').innerHTML = count;
		if(count>total)
		{			
		//form[n].checked=false;
		alert('You have selected more than the specified number ');
		return 0;
		}
		else
		return 1;
    }
	
	</script>
<form name="form_poulate" id="form_poulate" method="post">
<table border="0" bgcolor="#CCCCFF" cellpadding="2" align="center" width="100%" >

<?php
$k=0;
while($row=mysql_fetch_array($res)){
	?>
	<tr><td width="4%"><input type='checkbox' name='question[]'  value='<?php echo $row['ID'];?>' onClick="if(countCheckboxes(<?php echo $_REQUEST['amount'];?>)==1){return true;}else{return false;}"><td width="4%"><?php echo $i;?>: </td><td width="92%"><?php echo $row['Question'];?>
	<tr>&nbsp;<td colspan='3'>
    <?php
	$sub_sql="SELECT `Choice_label`,`Choice`,`Answer` FROM `choice` WHERE `Question`='".$row['ID']."'";
	$sub_res=mysqli_query($link,$sub_sql)or die(mysqli_error($link));
	echo"<table border='0' bgcolor='#FFFFFF' width='100%'>";
	
	while($sub_row=mysql_fetch_array($sub_res))
	{
		echo"<tr><td width='30pt'>".$sub_row['Choice_label']."<td>".$sub_row['Choice'];
	}
	echo"</table>";
	$i++;
}

?>
	<tr><td colspan="3">
<input type="button" value="Populate selected" name="populate" onClick="getSelectedChbox();window.close();"  />
</table>
</form>
<div id="divvv"></div>
</body>
</html>
