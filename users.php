<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <script src="ajaxFunctions.js"></script>
    <script type="text/javascript">
        function check()
        {
            //alert(document.getElementById('user_action').value);
            if(document.getElementById('user_action').value=="delete")
            {
                if(confirm("are you sure you want to delete this examinee?")){
                    return true;
                }
                else
                return false;
            }
            if((!document.getElementById('reset_to_default').checked) && (document.getElementById('resetto').value=='') && (document.getElementById('user_action').value=="reset"))
            {
                alert('Reset Password preference not provided');
                document.getElementById('resetto').focus();
                return false;
            }
            else if(document.getElementById('user_action').value=="--select one--")
            {
                alert('You must select an action with selected');
                document.getElementById('user_action').focus();
                return false;
            }
            else
            return true;
            //alert('huh')

                    //document.getElementById('resetto').setAttribute('disabled', 'false');
                    //alert()



        }

    </script>
    <link rel="stylesheet" href="button.css" />
    <style>
        .loading{
            top:200px;
            left:45%;
            position: fixed;
            width: 150px;

            vertical-align: middle;

            text-align: center;
        }

    </style>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 29-6-2016
 * Time: 11:00 AM
 */

@session_start();
if($_SESSION['logged']=='true' && $_SESSION['roll']=='Invigilator') {
require_once('classes/common.php');
$act = new Common();
?>

<body>
<div style="width: 780">
<!---->
Please select the department of the students you are invigilating  <br>
    <table>
        <td>School/College/Department</td>
        <td><select name="department" class="custom-combo" id="sel_dep" onchange="id=this.value;ajax_load('div_prog','pickprogram.php?id='+id);">
                <option>--Select--</option>
                <?php
                $act->DropDownItems("SELECT `ID`, `Department` FROM `department` ORDER BY(`Department`)");
                ?>
            </select></td>
        </tr>
        <tr>
            <td>Study Program</td>
            <td><div id="div_prog"></div></td>
        </tr>
        <tr><td></td><td><?php //print_r($_REQUEST) ?></td></tr>
    </table>
<?php
//UPDATE `examinee` SET `ID`=[value-1],`First_Name`=[value-2],`Middle_Name`=[value-3],`Last_Name`=[value-4],`Sex`=[value-5],`Enrollment_Level`=[value-6],`E-mail`=[value-7],`Password`=[value-8],`Country`=[value-9],`City`=[value-10],`Telephone`=[value-11],`Academic_Year`=[value-12],`Study_Subject`=[value-13],`Confirmation_Code`=[value-14],`Approved`=[value-15],`Exam`=[value-16],`Remark`=[value-17] WHERE 1

//$sql="SELECT `ID`, `First_Name`, `Middle_Name`, `Last_Name` FROM `user` WHERE `Active`='Yes' AND `Roll`='Examinee'";
//$act->DisplayByQueryFull($sql,'user','modify_users.php','div_ajax_space');
//$department = $act->DynSuperDropDownByQuery("SELECT `id`,`department` FROM `department` ORDER BY `Department`", "department", "users_list.php", "divSuprDynDropDown_");
//print_r($_POST);
}
?>

<div id="divSuprDynDropDown_"></div>
<div id="loading" style="display:none;" class="loading">
    <img src="images/loading.gif"></div>
</div>
     </body>
</html>