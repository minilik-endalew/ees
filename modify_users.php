<?php
@session_start();
require_once('classes/common.php');
$act=new Common();

//print_r($_REQUEST);//Array ( [action] => view [id] => 4 )
//print_r($_REQUEST);//Array ( [action] => view [id] => 1 )
if($_REQUEST['action']=="view")
{
	$sql="SELECT `ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Roll`, `Email`, `User_Name`, `Active`, `Remark` FROM `user` WHERE `ID`='".$_REQUEST['id']."'";
	$act->DisplaySingle($sql);
}
else if ($_REQUEST['action']=="edit")
{
	$sql="SELECT * FROM `user` WHERE `ID`='".$_REQUEST['id']."'";
	$result=mysqli_query($link,$sql)or die(mysqli_error($link));
	$row=mysql_fetch_array($result);
	?>
    <form name="form_modify_user" id="form_modify_user" method="post">
    <table width="310" border="0">
  <tr>
    <td>First Name</td>
    <td><input type="hidden" name="ID" value="<?php echo $row['ID'] ?>"><input type="text" name="firstname" id="firstname"  value="<?php echo $row['First_Name']?>"></td>
  </tr>
  <tr>
    <td>Middle Name</td>
    <td><input type="text" name="middlename" id="middlename" required value="<?php echo $row['Middle_Name']?>"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastname" id="lastname" required value="<?php echo $row['Last_Name']?>"></td>
  </tr>
  <tr>
    <td>Roll</td>
    <td><select name="roll" size="1" id="roll">
      <option <?php if($row['Roll']=="Administrator") {echo "selected";}?> >Administrator</option>
      <option <?php if($row['Roll']=="Instructor") {echo "selected";}?> >Instructor</option>
      <option <?php if($row['Roll']=="Inspector") {echo "selected";}?> >Inspector</option>
      <option <?php if($row['Roll']=="Examinee") {echo "selected";}?> >Examinee</option>
    </select></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" id="email" required  value="<?php echo $row['Email']?>"></td>
  </tr>
  <tr>
    <td>User Name</td>
    <td><input type="text" name="username" id="username" required  value="<?php echo $row['User_Name']?>"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td>[Hidden]<input type="hidden" name="password" id="password" required disabled value="<?php echo $row['Password']?>"></td>
  </tr>
  <tr>
    <td>Active</td>
    <td><select name="active" size="1" id="active">
      <option  <?php if($row['Active']=="Yes") {echo "selected";}?>>Yes</option>
      <option  <?php if($row['Active']=="No") {echo "selected";}?>>No</option>
    </select></td>
  </tr>
  <tr>
    <td>Remark</td>
    <td><input type="text" name="remark" id="remark"  value="<?php echo $row['Remark']?>"></td>
  </tr>
  <tr>
    <td><input type="button" value="Update" onClick="ajaxPost('update_user.php','form_modify_user','div_ajax_space')"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
    <?php
	}
else if($_REQUEST['action']=="delete")
{
	$sql="DELETE FROM `user` WHERE `ID`='".$_REQUEST['id']."'";
	$res=mysqli_query($link,$sql)or die(mysqli_error($link));
	if($res)
	echo"User record deleted.";
	}

?>