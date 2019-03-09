<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 14-6-2016
 * Time: 5:00 PM
 */
//echo"Huh";
//Array ( [picture] => uploads/457574images.png )
session_start();

if(isset($_POST['picture'])) {
    $_SESSION['linked_resource'] = $_POST['picture'];
    $_SESSION['linked_type']="Picture";
}
elseif(isset($_POST['document'])) {
    $_SESSION['linked_resource_doc'] = $_POST['document'];
    $_SESSION['linked_type']="Document";
}
//print_r($_POST);

