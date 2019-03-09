<?php
@session_start();
require_once('classes/common.php');
$act=new Common();
?>

<!---->
<?php
//UPDATE `examinee` SET `ID`=[value-1],`First_Name`=[value-2],`Middle_Name`=[value-3],`Last_Name`=[value-4],`Sex`=[value-5],`Enrollment_Level`=[value-6],`E-mail`=[value-7],`Password`=[value-8],`Country`=[value-9],`City`=[value-10],`Telephone`=[value-11],`Academic_Year`=[value-12],`Study_Subject`=[value-13],`Confirmation_Code`=[value-14],`Approved`=[value-15],`Exam`=[value-16],`Remark`=[value-17] WHERE 1

//$sql="SELECT `ID`, `First_Name`, `Middle_Name`, `Last_Name` FROM `user` WHERE `Active`='Yes' AND `Roll`='Examinee'";
//$act->DisplayByQueryFull($sql,'user','modify_users.php','div_ajax_space');
//$department=$act->DynSuperDropDownByQuery("SELECT `id`,`department` from `department` ORDER BY `Department`","department","examinee_in_dept.php","divSuprDynDropDown");

?>
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

  <div id="divSuprDynDropDown"></div>


