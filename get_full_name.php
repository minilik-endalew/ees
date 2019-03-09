<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 03-8-2017
 * Time: 10:37 AM
 */
@session_start();
require_once('classes/common.php');
$act=new Common();
//print_r($_REQUEST);
$q_full_name="SELECT `ID`, `Full_name` FROM `applicants` WHERE `Program`=".$_REQUEST['prog']." ORDER BY(`Full_name`)";
//echo $q_full_name;
?>
<select required name="applicant" >
    <option></option>
    <?php

    $act->DropDownItems($q_full_name);

    ?>
</select>