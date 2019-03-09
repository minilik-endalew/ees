<html>
<head>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"exam_date",
			dateFormat:"%d-%M-%Y"
		
		});
	};
	
	
<!--
//function Popup(n) {
//	alert(n);
//window.open("populate_question.php?amount="+n , "Populate question", "status = 1, height = 300, width = 300, resizable = 0" )
//}
//-->
</script>

</head>

<body>


<?php
$edit=false;
if(isset($eid))//NOTE: $eid is found from the parent file in which this file is included.
{
	$edit=true;
	$e_sql="SELECT `ID`, `Exam_name`, `Subject_Type`, `Pass_persentage`, `Time_for_single_question_in_minutes`, `Time_for_the_whole_exam`, `Mode`, `Exam_Date`, `Active`, `Remark` FROM `exam_plan` WHERE `ID`='".$eid."'";
	$e_res=mysqli_query($link,$e_sql)or die(mysqli_error($link));
	$e_row=mysql_fetch_assoc($e_res);
	}
?>
<form id="form_setup" name="form_setup" method="post" enctype="multipart/form-data">
  <table width="545" border="0">
    <tr>
      <td width="246">Exam name</td>
      <td width="289"><input type="text" name="exam_name" id="exam_name" <?php if($edit){echo"value='".$e_row['Exam_name']."'";}?> /></td>
    </tr>
    <tr>
      <td>Select type</td>
      <td>
      <select name="type" id="type">
        <option>--select one--</option>
        <option <?php if($edit && $e_row['Subject_Type']=="English"){ echo " selected ";}?>>English</option>
        <option <?php if($edit && $e_row['Subject_Type']=="Analytic"){ echo " selected ";}?>>Analytic</option>
      </select></td>
    </tr>
    <!-- 
    <tr>
      <td>Populate questions</td>
      <td><div id="div_selected_questions"><input type="button" name="pupulate" value="..." onclick="Popup(document.getElementById('amount').value,document.getElementById('type').value)"><input name="Questions" type="text" id="question_ids" readonly required <?php if($edit){echo"value='".$e_row['Questions']."'";}?>></div></td>
    </tr>
    -->
    <tr>
      <td>Pass persontage</td>
      <td><input name="pass_percentage" type="text" id="pass_mark" required size="10" maxlength="10"  
	  <?php if($edit){echo"value='".$e_row['Pass_persentage']."'";}?> /></td>
    </tr>
    <tr>
      <td>Time for single question in minute </td>
      <td>
   <input name="time_for_singl" type="text" id="time_for_singl" required size="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' 
   <?php if($edit){echo"value='".$e_row['Time_for_single_question_in_minutes']."'";}?>/></td>
    </tr>
    <tr>
      <td>Time for the whole exam</td>
      <td><input name="time_for_full_exam" type="text" id="time_for_full_exam" size="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  <?php if($edit){echo"value='".$e_row['Time_for_the_whole_exam']."'";}?> /></td>
    </tr>
    <tr>
      <td>Mode</td>
      <td><select name="mode">
      <option>--select one--</option>
      <option <?php if($edit && $e_row['Mode']=="One question at a time"){ echo " selected ";}?>>One question at a time</option>
      <option <?php if($edit && $e_row['Mode']=="All questions in category"){ echo " selected ";}?>>All questions in category</option>
      <option <?php if($edit && $e_row['Mode']=="All questions in exam"){ echo " selected ";}?>>All questions in exam</option>
      </select></td>
    </tr>
    <tr>
      <td>Examination date</td>
      <td><input type="text" placeholder="Exam date" name="exam_date" id="exam_date" <?php if($edit){echo"value='".$e_row['Exam_Date']."'";}?>/></td>
    </tr>
    <tr>
      <td>Active</td>
      <td>Yes
        <input type="radio"  name="active"  value="Yes" <?php if($edit && $e_row['Active']=="Yes"){ echo "checked=checked";}?> />
      
         No
          <input type="radio" name="active"  value="No" <?php if($edit && $e_row['Active']=="No"){ echo "checked=checked";}?>/>
        </td>
    </tr>
    <tr>
      <td>Remark</td>
      <td><textarea name="remark" id="remark" cols="30" rows="3"><?php if($edit){echo $e_row['Remark'];}?></textarea></td>
    </tr>
    <tr>
      <td>
      <?php if($edit){?>
		<input type="button" value="Update" onclick="ajaxPost('exam_setup.php?action=update&eid=<?php echo $eid;?>','form_setup','div_ajax_space')" />  
		 <?php
          }
		  else{
		  ?>
      <input type="button" value="Save and continue" onclick="ajaxPost('exam_setup.php?action=save','form_setup','div_ajax_space')" />
      <?php }?>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>