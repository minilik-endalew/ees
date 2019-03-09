<?php
session_start();

require_once('classes/common.php');
$act=new Common();
//print_r($_REQUEST);
//action=edit?id//Array ( [action] => edit [id] => 19 ) 
unset($_SESSION['categoryID']);
unset($_SESSION['linked_resource']);
unset($_SESSION['linked_type']);
if(isset($_REQUEST['action'])&& $_REQUEST['action']=="edit"){
$sql="SELECT `category_name`, `Instruction`, `amount`, `passage`,`Subject`, `remark` FROM `question_category` WHERE `id`='".$_REQUEST['id']."'";
$res=mysqli_query($link,$sql)or die(mysqli_error($link));
$row=mysql_fetch_array($res);

}
 ?>
<html>
<body>
<div id="div_create_category">
<form id="form_create_category" name="form_create_category" method="post" >
  <table width="549" border="0">
    <tr>
      <td>Category Name</td>
      <td>          
   <textarea name="catagoryname" id="catagoryname" cols="50" rows="3"><?php if($_REQUEST['action']=="edit") echo $row['category_name'];?></textarea>
    </tr> 
    <tr><td>Subject</td><td>
     <select name="subject">
     <option>--select one--</option>
     <option <?php if($_REQUEST['action']=="edit" && $row['Subject']=="English"){echo"selected";}?>>English</option>
     <option <?php if($_REQUEST['action']=="edit" && $row['Subject']=="Analytic"){echo"selected";}?>>Analytic</option>
     </select>
     </td></tr> 
    
    <tr>
      <td>Category Instruction</td>
      <td><textarea name="instruction" cols="50" id="instruction"  ><?php if($_REQUEST['action']=="edit") echo $row['Instruction'];?></textarea>    
      </tr>
    <tr>
      <td width="126">Number of questions in this category</td>
      <td width="399"><input name="q_amount_cat" type="text" id="q_amount_cat" size="10" maxlength="4" value="<?php if($_REQUEST['action']=="edit") echo $row['amount'];?>" >      </tr>
    
   <tr <?php if($_REQUEST['action']=="edit") echo"style='visibility:hidden_'";?>>
        <td>Associate Passage</td>
      <td><input name="has_paragraph" id="has_paragraph" type="checkbox" value="yes" onClick="if(this.checked){openCenteredWindow('paragraphform.php')}">
      <input type="hidden" name="passageID" id="passageID" value="<?php if(isset($_SESSION['passageID'])){echo $_SESSION['passageID'];}?>">
      <div id="passage_result" style="display:none; float:right"><strong><i><?php echo $_SESSION['PassageSaveMessage']; //echo $_SESSION['passageID'];?></i></strong></div>
      </td>
      
    </tr>
      <tr>
          <td>Link Picture</td>
          <td><input name="has_picture" id="has_picture" type="checkbox" value="yes" onClick="if(this.checked){openCenteredWindow('pictures.php')}">

            <div name="image_upload" id="image_upload"></div>
      </tr>
      <tr>
          <td>Link File</td>
          <td><input name="has_doc" id="has_doc" type="checkbox" value="yes" onClick="if(this.checked){openCenteredWindow('documents.php')}">


      </tr>
      <tr>
          <td>
          
          <div id="creat_question_button_div" >
          <?php  if($_REQUEST['action']=="edit"){ ?><a class="myButton" href="#" onFocus="validate_category();" onClick="ajaxPost('save_category.php?action=update&cid=<?php echo $_REQUEST['id']; ?>','form_create_category','div_create_category');">update category</a>
<?php }else{?>
          <a href="#" class="myButton" onFocus="validate_category();" onClick="ajaxPost('save_category.php','form_create_category','div_create_category');" >Save and continue</a>
          <?php }?>
          </div></td>
          <td><div id="div_create_choice" ></div></td>
        </tr>
    </table>
</form>
<!--<a href="#" onClick="if(document.getElementById('question').value!=''){var n=prompt('How many choices?');ajaxPost('create_choise.php?bizat='+n,'form_create_question','div_create_choice'); document.getElementById('creat_question_button_div').style.display='none';}else{alert('Fill the question field first.');return false;}" class="myButton_">Save and continue</a>-->

</div>
</body>
</html>