<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 21-7-2016
 * Time: 11:55 AM
 */
//if($_SESSION['logged']){
@session_start();
require_once('classes/common.php');
$act=new Common();
//print_r($_REQUEST);
//$act->DynamicDropDown('stream','dept_id',$_REQUEST['id']);
if($_SESSION['logged']&& $_SESSION['roll']=="Administrator" &&  $_SESSION['action']=="report")//for invigilator
{
    //echo "Huh";
    //ajaxPost('report_list.php','frm_report','div_dep_selected')
    ?>
    <form name="frm_report_">
        <select name="program" onchange="ajaxPost('report_list.php','frm_report_','div_report_1')">

            <option>--select one--</option>
            <?php
            $act->DropDownItems("SELECT `id`, `stream`,IF( `msc`='Yes',IF(`phd`='Yes','Masters or PHD','Masters'),'PHD' ) as `level` FROM `stream` Where `dept_id`='".$_REQUEST['id']."'",2);
           unset($_SESSION['action']);
            ?>

        </select></form>
    <?php
}elseif($_SESSION['logged']&& $_SESSION['roll']=="Administrator")//for invigilator
{
    ?>
    <form name="form_pick_program">
    <select name="program" onchange="ajaxPost('examinee_in_dept.php','form_pick_program','divSuprDynDropDown')">

        <option>--select one--</option>
        <?php
        $act->DropDownItems("SELECT `id`, `stream`,IF( `msc`='Yes',IF(`phd`='Yes','Masters or PHD','Masters'),'PHD' ) as `level` FROM `stream` Where `dept_id`='".$_REQUEST['id']."'",2);
        ?>

    </select></form>
    <?php
}
elseif($_SESSION['logged']&& $_SESSION['roll']=="Invigilator")//for invigilator
{
    ?>
    <form name="form_pick_programI">
        <select name="program" onchange="ajaxPost('users_list.php','form_pick_programI','divSuprDynDropDown_')">

            <option>--select one--</option>
            <?php
            $act->DropDownItems("SELECT `id`, `stream`,IF( `msc`='Yes',IF(`phd`='Yes','Masters or PHD','Masters'),'PHD' ) as `level` FROM `stream` Where `dept_id`='".$_REQUEST['id']."'",2);
            //echo "huh";
            ?>

        </select></form>
    <?php
}

else{
?>
<select name="program" id="sel_prog" onchange="ajax_load('div_name','get_full_name.php?prog='+this.value)" required>

    <option></option>
        <?php
        $act->DropDownItems("SELECT `id`, `stream`,IF( `msc`='Yes',IF(`phd`='Yes','Masters or PHD','Masters'),'PHD' ) as `level` FROM `stream` Where `dept_id`='".$_REQUEST['id']."'",2);
        ?>

</select>
<?php
}
?>
