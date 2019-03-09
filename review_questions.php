
<?php
@session_start();
require_once('classes/common.php');
$act=new Common();

//$res=mysqli_query($link,$sql)or die(mysqli_error($link));
//$i=1;
//$act->DynDropDownByQuery("SELECT `id`, `category_name` FROM `question_category` WHERE 1","question_category");
//$act->DynamicSearchForAjax("question_category","questions_under_cat.php","question_review_div","category_name");

?>
<form name="form_cat_select" action="" method="get">
<select name="category" onChange="ajaxPost('questions_under_cat.php','form_cat_select','question_review_div');">
<option>--select one--</option>
<?php
if($_SESSION['logged']==true && $_SESSION['roll']=="Instructor") {
    $sql1 = "SELECT `id`, `category_name`, `amount` FROM `question_category` WHERE `active`='Yes' AND `id` IN (SELECT `category` FROM `inst_category` WHERE `inst_id`='" . $_SESSION['user_id'] . "') ";
}
else if($_SESSION['logged']==true && $_SESSION['roll']=="Reviewer"){
    $sql1 = "SELECT `id`, `category_name`, `amount` FROM `question_category` WHERE `active`='Yes' AND `Subject`='English' and `remark`='2008' ";
}
//$act->DropDownItems("SELECT `id`, `category_name`, `amount` FROM `question_category` WHERE `active`='Yes' AND `id` IN (SELECT `category` FROM `inst_category` WHERE `inst_id`='".$_SESSION['user_id']."') ",2);

    $result1 = mysqli_query($link,$sql1) or die(mysqli_error($link));
    while ($row1 = mysql_fetch_array($result1)) {
        $active_q = "SELECT COUNT(`ID`) FROM `question` WHERE `Active`='Yes' AND `category`='" . $row1['id'] . "' ";
        $bzat = mysql_result(mysqli_query($link,$active_q), 0);

        echo "<option value='" . $row1['id'] . "'>" .
            $row1['category_name'] . "  [total=" . $row1['amount'] . ", Active=" . $bzat
            . "]</option>";

    }

?>
</select>
</form>
<div id="question_review_div"></div>