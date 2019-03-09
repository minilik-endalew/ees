<?php
session_start();
require_once('classes/common.php');
$act=new Common();
if($_SESSION['logged']){
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Link Picture</title>

    <script type="text/javascript" src="ajaxFunctions.js"></script>
</head>
<body>
<form name="form_image_upload">
    <div>
<?php
$dirname = "uploads/";
//$dirname = "media/images/iconized/";
$images1 = glob($dirname."*.png");
$images2 = glob($dirname."*.jpg");
$img=array_merge($images1,$images2);
foreach($img as $image) {
    //for($i=0;$i<=3;$i++){
    echo "<tr><td><label><input type='radio' name='picture' title='$image' alt='$image' value='".$image."'><img width='150' src='".$image."' /> $image.</label><br /></td></tr><br />";
//}
}
?>
    <input type="button" value="Go" onclick="ajaxPost('save_link_resource.php','form_image_upload','div_image_upload');window.close()">
    </div>
</form>
<div id="div_image_upload"></div>
<div id="loading" style="display:none;" class="loading">
    <img src="images/loading.gif"></div>

</body>
<?php } else
    echo "Un-authorized access.";
    ?>