<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 29-6-2016
 * Time: 11:11 AMajax_load('div_prog','pickprogram.php?id='+id)
 */
@session_start();
if($_SESSION['logged']=='true' && $_SESSION['roll']=='Invigilator') {
require_once('classes/common.php');
$act=new Common();
//print_r($_POST);
$_SESSION['curr_program']=$_POST['program'];
$user_query="SELECT `ID`, `First_Name` as `First name`, `Middle_Name` as `Middle name`, `Last_Name` as `Last name`,  `User_Name` as `Username` FROM `user` WHERE `Active`='Yes' AND `Roll`='Examinee' AND `ID` IN (SELECT `UserID` FROM `examinee` WHERE `Approved`='Yes' AND `Study_Subject`='".$_POST['program']."') ORDER BY(`First_Name`)";
?>
<form name="form_users" method="post">
    <br><a href="#" onClick="ajaxPost('examinee_in_dept.php','form_users','divSuprDynDropDown_')"  class="myButton" >Get allocation</a> |
    <a href="#" onClick="document.getElementById('user_opp').style.visibility='visible'"  class="myButton" >Get users</a>
<div id="user_opp" style="visibility: collapse">
    <?php
$act->DisplayListWithCheckboxGeneric($user_query);
//DisplayByQueryCheck($user_query,null,"users_list.php");
?>
    <br>Reset password to <br>
    <input name="reset_to_default" id="reset_to_default" type="checkbox" value="default"  onchange="if(this.checked){document.getElementById('resetto').style.visibility='hidden'}else{document.getElementById('resetto').style.visibility='visible'}">Use the default
    <input type="text" name="resetto" id="resetto" > <br>

    <br>With selected
    <select name="user_action" id="user_action">

        <optgroup label="Operate on users">
            <option selected>--select one--</option>
            <option value="reset">Reset Password</option>
            <option value="delete">Delete</option>
        </optgroup>
    </select>
    <input type="button" onclick="if(check()){ajaxPost('save_user_operation.php','form_users','div_ajax_space');}" value="Go">
</div>
</form>

    <div id="divSuprDynDropDown_">

    </div>
<?php
}
?>