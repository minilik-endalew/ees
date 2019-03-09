<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 20-7-2016
 * Time: 2:59 PM
 */
@session_start();
require_once('classes/common.php');
$act=new Common();
echo "Disabled questions list. <br>";
$sql1="SELECT `ID` , `Question`,`category` FROM `question` WHERE  `category`='".$_SESSION['categoryID']."' AND `Active` = 'No'";
$res1=mysqli_query($link,$sql1)or die(mysqli_error($link));
$i=1;
?>
<fieldset class="majorpoints" >
    <button id="btn" onClick="majorpointsexpand(this.innerHTML)" title="Expand Passage"> + </button>
<div id="div_passgae_display" style="display:none">
<?php
$psg1=$act->GetField('passage','question_category',$_SESSION['categoryID']);
if($psg1)
    $act->DisplayByQuery("SELECT `paragraph` FROM `passage` WHERE `id`='".$psg."'","passage");
$pic1=mysqli_query($link,"SELECT  `name` FROM `resource` WHERE `type`='Picture' AND `category`='".$_SESSION['categoryID']."'")or die("error1:".mysqli_error($link));
if(mysql_num_rows($pic1)>0){
    $picture1=mysql_fetch_row($pic1) or die("error2:".mysqli_error($link));
    echo"<img src='".$picture1[0]."' width='200' />";
}
?>

</div>
<div>
    <?php
    //echo
    if(mysql_num_rows($res1)==0) {
        echo"Empty Category";
    }


    ?>
</div>
<form name="form_multiple_action" method="post">
    <table width="781" border="0" style="background-color: cornsilk">
        <tr><td colspan="3">
         <a href="#" class="myButton" onclick="if(window.confirm('Are you sure you want to enable all selected questions? All will be included from exams.')){ajaxPost('modify.php?action=mul_en','form_multiple_action','div_ajax_space')}">Enable Selected</a>
         </td><td><input type="checkbox" name="sel_all1" title="Select All" onchange="if(this.checked){check_uncheck_all('check_mul_del1[]',true)}else{check_uncheck_all('check_mul_del1[]',false)}"></td></tr>
        <?php
        while($row2=mysql_fetch_array($res1)){
        ?>
        <tr>
            <td width="26"><?php echo $i?></td>
            <td width="680"><?php echo $row2['Question']?>
                <div>
                    <?php

                    $linked_resource_query2 = "SELECT  `name` FROM `resource` WHERE `question`='" . $row2['ID'] . "' AND `type`='Picture'";
                    $res_has_pic2=mysqli_query($link,$linked_resource_query2);
                    if(mysql_num_rows($res_has_pic2)) {
                        $_REQUEST['quest'] = $row2['ID'];
                        include('show_picture.php');
                    }
                    ?>

            </td>


                <td><a href='#' title="Enable" onclick="if(window.confirm('Enable this question? It will be included from exams.')){ajax_load('div_ajax_space','modify.php?action=enable&id=<?php echo $row2['ID']?>')}"><img src="images/state_ok.png" alt="enable"/></a></td>
            <td width="20"><input type="checkbox" name="check_mul_del1[]" value="<?php echo $row2['ID']?>"></td>

            <!-- check this out -->
        <tr>
            <td colspan='6'><?php
                $sub_sql2="SELECT `Choice_label`,`Choice`,`Answer` FROM `choice` WHERE `Question`='".$row2['ID']."'";
                $sub_res2=mysqli_query($link,$sub_sql2)or die(mysqli_error($link));
                ?>
                <!--<table border='0' bgcolor='#FFFFFF' width='100%'>-->
                <ul style="padding:3px;">

                    <?php
                    while($sub_row2=mysql_fetch_array($sub_res2))
                    {

                        echo"<li style='padding:2px;'>".$sub_row2['Choice_label'];
                        if($sub_row2['Answer']=="Yes")
                            echo"*";
                        echo". &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_row2['Choice']."</li>";
                    }
                    ?>

                </ul>
                <!--</table>-->
                <?php
                $i++;
                }

                ?>
            </td></tr>
    </table>
<hr>
</form>
