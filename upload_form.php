<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 11-6-2016
 * Time: 6:36 AM
 */
?>
<!--<form id="form_upload_resource" name="form_upload_resource" action="upload.php"  method="post" enctype='multipart/form-data' >
    Select file to upload:
                  <input type="file" name="file_upload" id="file_upload" accept="image/*">

                  <input type="button" value="Upload Image" onClick="ajaxPost('upload.php','form_upload_resource','div_uplodfile')">
              </form>
            <div name="div_uplodfile" id="div_uplodfile">huh</div>-->

<!doctype html>
<html>
<head lang="en">
    <meta charset="utf-8">

    <link rel="stylesheet" href="style.css" type="text/css" />
    <!--<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>-->
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
<div class="container">

    <hr>
    <div id="preview"><!--<img src="no-image.jpg" />--></div>
Upload Image:
    <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
        <input id="uploadImage" type="file" accept="image/*" name="image" />
        <input id="button" type="submit" value="Upload">
    </form>
    Upload Document:
    <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
        <input id="uploadDocument" type="file" accept="application/pdf" name="document" />
        <input id="button" type="submit" value="Upload">
    </form>
    <div id="err"></div>
    <hr>

</div>
</body>
</html>