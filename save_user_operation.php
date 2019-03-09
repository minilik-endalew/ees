<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 29-6-2016
 * Time: 11:38 AM
 */
@session_start();
if($_SESSION['logged']=='true' && $_SESSION['roll']=='Invigilator') {
    require_once('classes/common.php');
    $act = new Common();
    if (isset($_POST['reset_to_default']) && $_POST['reset_to_default'] == "default")
        $password = "123456";
    elseif (isset($_POST['resetto']) && $_POST['resetto'] != "")
        $password = $_POST['resetto'];
    if (isset($_POST['generic_checkbox'])) {
        //print_r($_POST);
//Array ( [generic_checkbox] => Array ( [0] => 2391 [1] => 2393 ) [user_action] => reset )
        if ($_POST['user_action'] == "reset") {
            foreach ($_POST['generic_checkbox'] as $uid) {

                $reset_q = "UPDATE `user` SET `Password`=md5($password) WHERE `ID`='$uid'";
                $reset_result = mysqli_query($link,$reset_q) or die("update error:" . mysqli_error($link));
            }
            echo "Users password/s are now reset to $password";
        } elseif ($_POST['user_action'] == "delete") {
            foreach ($_POST['generic_checkbox'] as $uid) {
                $delete_u_q = "DELETE FROM `user` WHERE `ID` ='$uid'";
                $delete_e_q = "DELETE FROM `examinee` WHERE `UserID`='$uid'";
                $r1 = mysqli_query($link,$delete_u_q);
                $r2 = mysqli_query($link,$delete_e_q);
            }
            if ($r1 && $r2)
                echo "The selected user/s is/are deleted";
        }
    } else {
        echo "You must select atleast one user to complete this operation";
    }
}
    ?>