<?php
session_start();
require_once('classes/common.php');
$act=new Common();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Link Document</title>

    <script type="text/javascript" src="ajaxFunctions.js"></script>
</head>
<body>
<form name="form_doc_upload">
    <table>
        <?php
        $dirname = "uploads/";
        //$dirname = "media/images/iconized/";
        $docs = glob($dirname."*.pdf");
        //$images2 = glob($dirname."*.jpg");
        //$img=array_merge($images1,$images2);
        foreach($docs as $doc) {
            //for($i=0;$i<=3;$i++){
            echo "<tr><td><label><input type='radio' name='document' title='$image' alt='$doc' value='".$doc."'><a target='_blank'  href='".$doc."' /> $doc.</label><br /></td></tr><br />";
//}
        }
        ?>
        <input type="button" value="Go" onclick="ajaxPost('save_link_resource.php','form_doc_upload','div_image_upload');window.close()">
    </table>
</form>
<div id="div_image_upload"></div>
<div id="loading" style="display:none;" class="loading">
    <img src="images/loading.gif"></div>

</body>