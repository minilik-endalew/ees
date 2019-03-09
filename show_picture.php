<?php
/**
 * Created by PhpStorm.
 * User: Minilik
 * Date: 18-6-2016
 * Time: 2:03 PM
 */
@session_start();
//print_r($_REQUEST);
//$category = $_POST['category'];
if(isset($_POST['category']) ||isset($_REQUEST['cat'])) {
    //die("I am here");

    $category = $_POST['category'];
    if(isset($_REQUEST['cat']))
    $category = $_REQUEST['cat'];
    $linked_resource_query = "SELECT  `name` FROM `resource` WHERE `category`='" . $category . "' AND `type`='Picture'";
    //
}
elseif(isset($_REQUEST['quest'])){
    $question=$_REQUEST['quest'];
    $linked_resource_query = "SELECT  `name` FROM `resource` WHERE `question`='" . $question . "' AND `type`='Picture'";

}
//echo $linked_resource_query;
$res_pic = mysqli_query($link,$linked_resource_query) or die("print picture query error:" . mysqli_error($link));

if($res_pic)
{
    $pic_row = mysql_fetch_row($res_pic);
      ?>
    <div>
<img src="<?php echo $pic_row[0];?>" alt="<?php echo $pic_row[0];?>" width="300" />
</div><?php
}
?>