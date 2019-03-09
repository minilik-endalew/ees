<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 29-6-2016
 * Time: 4:23 AM
 */
@session_start();
require_once('classes/common.php');
$act=new Common();
//print_r($_POST);
//debug_backtrace();
if(isset($_POST['program'])){
$sql="SELECT `ID`, CONCAT(`First_Name`,' ' ,`Middle_Name`,' ', `Last_Name`) as `Full Name`, `Sex`,`Study_Subject` as `Department`
FROM `examinee` WHERE `Approved`='Yes' AND `Study_Subject`='".$_POST['program']."'
";
}
else
{
    $sql="SELECT `ID`, CONCAT(`First_Name`,' ' ,`Middle_Name`,' ', `Last_Name`) as `Full Name`, `Sex`,`Study_Subject` as `Department`
FROM `examinee` WHERE `Approved`='Yes' AND `Study_Subject`='".$_SESSION['curr_program']."'
";
}
$sql_for_dropdown="SELECT `ID`, `Exam_name`, `Subject_Type` FROM `exam_plan` WHERE `Active`='Yes'";
$active_exams=mysqli_query($link,"SELECT `ID`, `Exam_name`, `Subject_Type`, `Active` FROM `exam_plan` WHERE `Active`='yes'");

?>
<form name="form_allocate_exam" method="post">
    <?php
    //$act->DisplayListWithCheckboxGeneric($sql);
    $res=mysqli_query($link,$sql)or die("Query failed: ".mysqli_error($link));
    $num_all=mysql_num_rows($res);
    if(mysql_num_rows($res)==0){
        echo"<b>No Records Found</b>";
    }
    else {
        echo "<div>";
        echo "<table border=0 cellspacing=1 width=100%><tr><th><input type='checkbox' name='checkAll' onclick=\"check_uncheck_all('generic_checkbox[]',this.checked)\">";
        //$col=mysql_fetch_field($res);
        for ($i = 0; $i < mysql_num_fields($res); $i++) {
            echo "<th>" . mysql_field_name($res, $i);
        }
        while ($row = mysql_fetch_array($res)) {
            if ($r % 2 == 0)
                $strip = "#CCCCCC";
            else
                $strip = "#ffffff";
            if(mysql_num_rows(mysqli_query($link,"SELECT * FROM `exam_allocation` WHERE `examinee`='".$row['ID']."'"))>0)
            {
                $strip="#62a60a";
            }
            echo "<tr style='background-color: $strip' bgcolor='$strip' onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
            echo "<td><input type=checkbox name='generic_checkbox[]' value='$row[0]'>";
            for ($i = 0; $i < mysql_num_fields($res); $i++) {
                echo "<td>$row[$i]</td>";
            }
            $r++;
        }
        echo "</table>";

        echo "</div>";
    }
    ?>
    Associate the selected applicants to an exam
    <select name="selected_exam" id="selected_exam">
        <option style="color: #62a60a;">select one</option>

        <?php
               while($erow=mysql_fetch_assoc($active_exams))
        {
            ?>
            <option value="<?php echo $erow['ID']?>"><?php echo $erow['Exam_name']?></option>
            <?php
        }
        //$act->DropDownItems($sql_for_dropdown,2);
        ?>
        <option disabled>all active exams</option>
    </select>
    <input type="button" value="Save" onClick="if(confirm('Are you sure? Click OK to continue')){ajaxPost('save_allocation.php','form_allocate_exam','div_ajax_space')}">
</form>
<!--<div id="div_examineeindept"></div>

</form>-->
Allocation List<br />
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>Examinee</td>
    <td>Exam</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  if(isset($_POST['program'])) {
      $listquery = "SELECT `id`, `examinee`, `exam`, `remark` FROM `exam_allocation` WHERE `examinee` IN (SELECT `id` FROM `examinee` WHERE `Study_Subject`='" . $_POST['program'] . "')";
  }
  else
  {
      $listquery = "SELECT `id`, `examinee`, `exam`, `remark` FROM `exam_allocation` WHERE `examinee` IN (SELECT `id` FROM `examinee` WHERE `Study_Subject`='" . $_SESSION['curr_program'] . "')";
  }
  $result=mysqli_query($link,$listquery)or die(mysqli_error($link));
  $i=0;
  while($row=mysql_fetch_array($result)){
      $i++;
      ?>
      <tr>
          <td><?php echo $i;?></td>
          <td><?php echo $act->GetFieldByQuery("SELECT concat(`First_Name`,' ',`Middle_Name`,' ',`Last_Name`) AS `Fullname` FROM `examinee` WHERE `ID`='".$row['examinee']."'"); ?></td>
          <td><?php echo $act->GetField('Exam_name','exam_plan',$row['exam']);?></td>
          <td><input type="button" value="Delete" onclick="if(confirm('This action deletes the allocation. Continue?')&&prompt('Pass code')=='138737'){ajax_load('div_ajax_space','reset_allocation.php?action=delete&id=<?php echo $row['id']?>');return true;}else{return false;}"  class="myButton" /></td>

          <td><input type="button" value="Reset exam" onClick="if(confirm('Caution! this action removes all answers provided for this exam by the corresponding examinee.')&&prompt('Pass code')=='138737'){ajax_load('div_ajax_space','reset_allocation.php?action=reset&exam=<?php echo $row['exam']?>&examinee=<?php echo $row['examinee']?>');return true;}else{return false;}"  class="myButton" /></td>
      </tr>
  <?php }?>
</table>

