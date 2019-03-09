<?php

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp','doc','docx','pdf'); // valid extensions
$path = 'uploads/'; // upload directory

if(isset($_FILES['image']))
{
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;

    // check's valid format
    if(in_array($ext, $valid_extensions))
    {
        $path = $path.strtolower($final_image);

        if(move_uploaded_file($tmp,$path))
        {
            echo "<img src='$path' />";
        }
    }
    else
    {
        echo 'invalid file';
    }
}
elseif(isset($_FILES['document'])){
    $img = $_FILES['document']['name'];
    $tmp = $_FILES['document']['tmp_name'];

// get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

// can upload same image using rand function
    $final_image = rand(1000,1000000).$img;

// check's valid format
    if(in_array($ext, $valid_extensions))
    {
        $path = $path.strtolower($final_image);

        if(move_uploaded_file($tmp,$path))
        {
            echo "<a href='$path' target='_blank'>Download</a>";
        }
    }
    else
    {
        echo 'invalid file';
    }
}

?>