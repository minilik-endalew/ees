<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reports</title>
</head><body>
<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
//ajax_load(where,what)
//ajaxPost(strURL,formname,responsediv)
?>

<h2>Reports</h2>
<!--<form name="frm_report">
<select name="sel_department" onchange="ajaxPost('report_list.php','frm_report','div_dep_selected')">
<?php
/*//ajaxPost(strURL,formname,responsediv)
$act->DropDownItems("SELECT `id`,`department` FROM `department` order by(`department`)",1);
//$act->DynamicSearchForAjax("department","reports.php?id=","div_ajax_space","department");
//$act->DynDropDownByQuery("SELECT id,department From department","department");//DynamicDropDown("department","department","id","iid",null);
*/?>
</select>
</form>-->
<?php
//SELECT examinee.`ID`, examinee.`First_Name`, examinee.`Middle_Name`, examinee.`Last_Name`, examinee.`Sex`, examinee.`Enrollment_Level`, examinee.`E-mail`,examinee.`Study_Subject`, examinee_score.exam,examinee_score.score FROM `examinee` inner JOIN examinee_score on examinee.ID=examinee_score.examinee WHERE 1;
?>
<div id="div_dep_selected" ></div>



<input type="button" onclick="ajax_load('div_all_in_one','allinone.php?id=sel_dep.value')" value="all in one report" />
<table>
    <tr>
        <td>Pick an exam to generate general report</td><td>
        <form name="form_pick_exam">
        <select name="a_exam" id="activ_exam" onchange="ajaxPost('allinone.php','form_pick_exam','div_all_in_one');">
            <option>--Select--</option>
            <?php
            //$_SESSION['action']="report";
            $act->DropDownItems("SELECT `ID`,`Exam_name` FROM `exam_plan`");
            ?>
        </select>
        
        </form>
    </td>
    
    <tr>
    <td>School/College/Department</td>
    <td><select name="department" class="custom-combo" id="sel_dep" onchange="id=this.value;ajax_load('div_prog','pickprogram.php?id='+id);">
            <option>--Select--</option>
            <?php
            $_SESSION['action']="report";
            $act->DropDownItems("SELECT `ID`, `Department` FROM `department` ORDER BY(`Department`)");
            ?>
        </select></td>
        
    </tr>
    <tr>
        <td>Study Program</td>
        <td><div id="div_prog"></div></td>
    </tr>
   <!-- <tr><td></td><td><button>Analytic report</button> | <button onclick="">Detailed report</button><?php /*//print_r($_REQUEST) */?></td></tr>-->
</table>

</body>
<div id='div_all_in_one'></div>
<div id='div_report_1'></div>
</html>