<?php
session_start();
require_once('classes/common.php');
$act=new Common();
?>

<form id="changepw" name="changepw" method="post" action="changepassword.php">
  <table width="366" border="0" cellspacing="2">
    <tr>
      <td>Username<font color="#FF0000">*</font></td>
      <td><input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" /></td>
    </tr>
    <tr>
      <td>Existing Password<font color="#FF0000">*</font></td>
      <td><input type="password" name="oldpassword" id="oldpassword" /></td>
    </tr>
    <tr>
      <td>New Password<font color="#FF0000">*</font></td>
      <td><input type="password" name="newpassword" id="newpassword" /></td>
    </tr>
    <tr>
      <td>Confirm New Password<font color="#FF0000">*</font></td>
      <td><input type="password" name="cnewpassword" id="cnewpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="change" id="change" value="Submit" onclick="if(check_account_info()){ajaxPost('changepassword.php','changepw','div_ajax_space')}"/></td>
    </tr>
  </table>
</form>
<?php
//session_start();
if($_SESSION['logged']&& isset($_REQUEST['change'])){
	if($act->IsValidUser('user',$_SESSION['user_id'],$_POST['oldpassword'])){
$upd="UPDATE `user` SET `User_Name`='".$_POST['username']."',`Password`='".md5($_POST['newpassword'])."' WHERE ID='".$_SESSION['user_id']."'";
$witet=mysqli_query($link,$upd)or die(mysqli_error($link));
if($witet)
echo"Accunt information changed.";
//$act->write_log($_SESSION['Type'],$_SESSION['fullname'],"User changed account information",$act->getIP(),date("Y-m-d H:i:s"));
//echo $upd;
//echo $_REQUEST['who'];

	//echo $upd;
	}
	else
	echo"You are not autorized to change this account";
	}
//print_r($_POST);
?>