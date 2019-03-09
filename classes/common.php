<?php
 @session_start();
 include("run.php");
$db=new DBConnection();
$conn=$db->connect();
?>
<?php 
 class Common{ 
 public function __construct(){} 
 	 public function backup(){
	$tableName  = 'mypet';  
	$backupFile = 'backup/preferece.sql';  
	//$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";  
	//$result = mysqli_query($GLOBALS['link'],$query);
	//sinclude 'closedb.php';  
	}
	 public function score_range($result,$from,$to)
	 {
		 $count=0;
		 if($result<=$to && $result>$from){
			 $count++;
		 }

	 }
	public function answered($exam,$examinee,$category,$question){
		$sql="SELECT * FROM `examinee_answer` WHERE `exam`='$exam' and `examinee`='$examinee' and `category`='$category' and `question`='$question'";
		$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		if(mysqli_num_rows($res)==0)
		return false;
		else
		return true;
		}
	 public function get_exam($category,$question){
		 $sql="SELECT `exam` FROM `exam_category` WHERE `category` IN (SELECT `category` FROM `question` WHERE `ID`='$question')";
		 //SELECT `category` FROM `question` WHERE `ID`=''

		 $res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		 if(mysqli_num_rows($res)>0){
			 $row=mysqli_fetch_row($res);
			 return($row[0]);
		 }
		 else
			 retrun(0);

	 }
	public function write_answer($exam,$examinee,$category,$question,$answer,$examinee_){
		/*if($category<=9)
		$fetena=1;
		else
		$fetena=2;*/
		
		$sql="INSERT INTO `examinee_answer`(`id`, `exam`, `examinee`, `category`, `question`, `answer_choice`, `remark`) VALUES (NULL,$exam,'$examinee','$category','$question','$answer','".date("Y-m-d H:i:s")."')";
		//echo $sql;
		//echo $_SESSION['exam'];
if($examinee==''){
echo"<h3 style='color:red'>There was some problem on your session. Please log-out and log-in again before you continue to the other categories</h3>";}
else
{
if(!$this->answered($exam,$examinee,$category,$question)){

$res=mysqli_query($GLOBALS['link'],$sql)or die("write_answer_error".mysqli_error($GLOBALS['link']));
}
else
$res=false;
}
if($res)
return true;
else
return false;
		}
		
		public function exam_complete($examinee,$exam){
			$sql="SELECT  `category` FROM `exam_category` WHERE `exam`='$exam' ";
			$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
			$cat_count=0;
			$ans_count=0;
			$complete=false;
			while($cat=mysqli_fetch_row($res))
				{
					$sql_check_if_answered="SELECT COUNT(`question`) FROM `examinee_answer` WHERE `exam`='$exam' AND `examinee`='$examinee' AND `category`='".$cat[0]."'";
					$res_check=mysqli_query($GLOBALS['link'],$sql_check_if_answered)or die(mysqli_error($GLOBALS['link']));
					$answered=mysqli_fetch_row($res_check);
					if($answered[0]!=0)					
					$cat_count++;
					else
					$complete=true;
				}
				if($cat_count>0)
				return false;
				else
				return true;
			}
	public function exam_taken($examinee,$exam)
	{
		$sql="SELECT `id` FROM `examinee_exam` WHERE `examinee`='$examinee' AND `exam`='$exam'";
		//echo $sql;
		$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		if(mysqli_num_rows($res)>=1)
		return true;
		else
		return false;
	}
	public function InsertRowFromArray($sql,$row_array)
	{
		
		}
	public function PrintExam($qid)
	{
		
		//$qid=next($qusetions);
		$qsql="SELECT `Question` FROM `question` WHERE `ID`='".$qid."'";
				$ch_sql="SELECT `ID`,`Choice_label`, `Choice`, `Answer` FROM `choice` WHERE `Question`='".$qid."'";
				//echo $qsql;
				$ch_res=mysqli_query($GLOBALS['link'],$ch_sql)or die(mysqli_error($GLOBALS['link']));
				
		$qres=mysqli_query($GLOBALS['link'],$qsql)or die(mysqli_error($GLOBALS['link']));
		if(mysqli_num_rows($qres)==1){
		$qrow=mysqli_fetch_row($qres);
		?>
        <form name="form_submit_answer" method="post">
	<table border='0'>
	<tr><td colspan=3><?php echo $qrow[0]; ?>
    <input type="hidden" name="question" value="<?php echo $qid;?>">
      </td>
		<?php
        while($ch_row=mysqli_fetch_array($ch_res))
		{//$ch_row['Choice_label']
			echo"<tr><td width='10px'><input type='radio' name='choice' value='".$ch_row['ID']."'></td><td width='10px'> <td>".$ch_row['Choice'];
			}
			?>
		<tr><td colspan=3><input type='button' name="submitAnswer" value='Submit and Next' onclick="if(select_answer()){ajaxPost('exam_sheet.php?exam=$qid','form_submit_answer','div_ajax_space')}">
		</table>
        </form>
        <?php
		}
		else
		echo"Qustion has been deleted";
	}
public function write_answer2($exam,$examinee,$choice)
{
	$sql="INSERT INTO `examinee_answer`(`id`, `exam`, `examinee`, `choice`, `remark`) VALUES (NULL,'$exam','$examinee','$choice','')";
	$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	}
public function get_score($examinee,$exam)
{
	//select * from  `examinee_answer` where
	}
	  
	//To restore the backup you just need to run LOAD DATA INFILE query like this : 
	 public function restor(){
	$tableName  = 'mypet';  
	$backupFile = 'mypet.sql';  
	$query      = "LOAD DATA INFILE 'backupFile' INTO TABLE $tableName";  
	$result = mysqli_query($GLOBALS['link'],$query);
	include 'closedb.php';  
	}
	
	
	
/****************************/
public function GetCreditHr($coursID){
	$rsql=mysqli_query($GLOBALS['link'],"SELECT `Credit_Hr` FROM `course` WHERE `id`='$coursID'")or die(mysqli_error($GLOBALS['link']));
	$chr=mysqli_fetch_row($rsql);
	return($chr[0]);
	}
public function GetGradePoint($gradeID)
	{
	$gsql=mysqli_query($GLOBALS['link'],"SELECT `Fixed_number_grade` FROM `grade` WHERE `ID`='$gradeID'")or die(mysqli_error($GLOBALS['link']));
	$grr=mysqli_fetch_row($gsql);
	return($grr[0]);
		
	}
public function CalculateSGPA($sid,$batch,$semester,$year)
{
	$sgpa=0;
	$totalChHr=0;
	$totalGradePoint=0;
$sql="SELECT `ID`, `CourseID`, `Final`, `Other`, `GradeID`, `Date`, `ECTS`, `Approved`, `Repeted`, `Remark` FROM `student_grade` WHERE `BatchID`='$batch' AND `SemesterID`='$semester' AND `Year`='$year' AND `StudentID`='$sid' AND `Approved`='Yes'";
//echo $sql;
$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
while($crow=mysqli_fetch_array($res))
	{
		//echo "tchr-->:".$this->GetGradePoint($crow['GradeID']);
		//echo "tgp-->:".$this->GetGradePoint($crow['GradeID']);
		if($this->GetGradePoint($crow['GradeID'])==NULL)
		continue;
		else
		{
		$totalChHr+=$this->GetCreditHr($crow['CourseID']);
		$totalGradePoint+=$this->GetGradePoint($crow['GradeID']);
		}
	}
	$sgpa=$totalGradePoint/$totalChHr;
	$arr=array('sgpa'=>$sgpa,'totalgp'=>$totalGradePoint,'totalchr'=>$totalChHr);
	return($arr);
}
public function CalculateCGPA($sid,$batch,$section)
	{
$sql="SELECT `ID`,`BatchID`,`SectionID`, `CourseID`,`StudentID`, `Final`, `Other`, `GradeID`, `Date`, `ECTS`, `Approved`, `Repeted`, `Remark` FROM `student_grade` WHERE `BatchID`='$batch' AND `SectionID`='$section' AND `StudentID`='$sid' AND `Approved`='Yes'";
$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
while($crow=mysqli_fetch_array($res))
{
	//$sgpa=$this->CalculateSGPA($crow['StudentID'],$crow['BatchID'],$crow['SemesterID'],$crow['SectionID']);
	//foreach($sgpa as $rach)
	
}	
	}
	
public function GetBatchYearArray($batch)
	{
		$sql="SELECT `Year` FROM `coursebreakdown` WHERE `Batch`='$batch' GROUP BY(`Year`) ";
		$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		$row=mysqli_fetch_array($res);
		return($row);
	}
/********/	
public function GetUserName($id){
	$res=mysqli_query($GLOBALS['link'],"SELECT `Username` FROM `arms_user` WHERE `ID`='$id'");
	return(mysql_result($res,0));
	}	 
public function IsValidUser($table,$id,$opwd)
	{
$res=mysqli_query($GLOBALS['link'],"SELECT * FROM `$table` WHERE `ID`='$id' AND `Password`='".md5($opwd)."'");
if(mysqli_num_rows($res)>0)
return true;
else 
return false;	
	} 
public function CrHrExceed($studid,$semester,$batch,$year,$newCredit)
	{
		$sql="SELECT SUM(`Credit_Hr`) AS `Total_CreditHR`,SUM(`ECTS`) AS `ToatalECTS` FROM `course` WHERE `id` IN(
SELECT  `CourseID` FROM `student_course_enrollment`
		WHERE 
		`BatchID`='$batch' AND
		`SemesterID`='$semester' AND		
		`StuedentID`='$studid' AND 
		`Year`='$year'
)";
//echo $sql;
$resq=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
$tot=mysqli_fetch_array($resq);
//echo $tot['Total_CreditHR']." ==== ". 20+ $newCredit;
if(($tot['Total_CreditHR'] + $newCredit)>19 )//you can also check by ECTS as $tot['ToatalECTS']
{
	echo"<br><font color='#FF0000'>The sum of credit hours exceedes 20<br>Try another course with a smaller Credit Hr.</font>";
	return false;
	}
	else{
		//echo"Ok";
	return true;
	}
	}
public function GetTotalHr($studid,$semester,$batch,$year){
	$sql="SELECT SUM(`Credit_Hr`) AS `Total_CreditHR`,SUM(`ECTS`) AS `ToatalECTS` FROM `course` WHERE `id` IN(
SELECT  `CourseID` FROM `student_course_enrollment`
		WHERE 
		`BatchID`='$batch' AND
		`SemesterID`='$semester' AND		
		`StuedentID`='$studid' AND 
		`Year`='$year'
)";
$resq=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
$tot=mysqli_fetch_array($resq);
return $tot;
}
public function AllowEnrollRequest($studid,$course,$semester,$batch,$year)
	{//checks if the course is repeted
		$sql="SELECT `ID`, `BatchID`, `SemesterID`, `StuedentID`, `CourseID`, `enroll_type`, `Approved` FROM `student_course_enrollment`
		WHERE 
		`BatchID`='$batch' AND
		`Year`='$year' AND
		`SemesterID`='$semester' AND
		`CourseID`='$course' AND
		`StuedentID`='$studid'
		";
		$qr=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		if(mysqli_num_rows($qr)>0)
		{
			echo"<br><font color='#FF0000'>The selected course is already in your list.</font>";
		return false;
		}
		else
		return true;
	}
public function TookPrerequisite($studid,$course,$semester,$batch,$status)
	{
	$prq="SELECT `ID`, `Department`, `Course_ID`, `Prerequisite_ID` FROM `prerequisite` WHERE `Course_ID`='$course'";	
	$pres=mysqli_query($GLOBALS['link'],$prq)or die(mysqli_error($GLOBALS['link']));
	if(mysqli_num_rows($pres)>0)
		{
		$prow=mysqli_fetch_array($pres);
		$corq="SELECT `ID`, `BatchID`, `SemesterID`, `StuedentID`, `CourseID`, `StudyProgramID`, `enroll_type`, `Approved`, `End`, `Comment` FROM `student_course_enrollment` WHERE `BatchID`='$batch' AND `SemesterID`='$semester' AND `StuedentID`='$studid' AND `CourseID`='".$prow['Prerequisite_ID']."' AND `Approved`='$status'";
		$coursres=mysqli_query($GLOBALS['link'],$corq)or die(mysqli_error($GLOBALS['link']));
		if(mysqli_num_rows($coursres)==0)//Didint took prerequisite
			{
				echo"<br><font color='#FF0000'>The course <b>".$this->GetField('Course_Title','course',$course)."</b> has prerequisite course ,<b>".$this->GetField('Course_Title','course',$prow['Prerequisite_ID'])."</b></font>";
				return false;
			}
			else
			return true;
		}
		else
		return true;
	}
//********************************
public function RequireWith($pg, $vars)
{
	extract($vars);
	require $pg;
}


public function DynamicSearchForAjax($table,$targetFile,$targetDIV,$displayCols=" * "){
	?>
    
	<form name='form_dynamic_search'>
	<table border='0'>
	<tr><td><input type="hidden" name="table" value="<?php echo $table;?>" />
    <input type="hidden" name="display_cols" value="<?php echo $displayCols;?>" />
	<?php $cols=mysqli_query($GLOBALS['link'],"show columns from $table")or die(mysqli_error($GLOBALS['link'])); ?>
 Search by 
 <select name="select_field">
 <?php
 while($opt=mysqli_fetch_row($cols))
 	{
	if($opt[0]=="id" || $opt[0]=="ID")
	continue;
		echo"<option value='$opt[0]'>".str_replace("_"," ",$opt[0])."</option>";
		//$i++;
	}
	?>
 </select>
<td><select name=operator>
<option>=</option>
<option>contains</option>
<option>&lt;</option>
<option>&lt;=</option>
<option>&gt;</option>
<option>&gt;=</option>
 </select>
 <td><input type="text" name="search_key">
 <td><input type='button' value="search" onClick="ajaxPost('<?php echo $targetFile;?>','form_dynamic_search','<?php echo $targetDIV;?>')" >
	</table>
	
	</form>
    <?php
	

}//end of functioin

 public function FilterAssist($table){
 if (!empty($_SERVER['QUERY_STRING'])) {
        $parts = explode("&", $_SERVER['QUERY_STRING']);
        $newParts = array();
        foreach ($parts as $val) {
            if (stristr($val, $limit_var) == false) array_push($newParts, $val);
        }
        $qs = (count($newParts) > 0) ? "&".implode("&", $newParts) : "";
    } else {
        $qs = "";
    }
 echo"<form action=".$_SERVER['PHP_SELF']."?a=$table&search=$table".$qs." method=post>";
echo"<input type=hidden name=table value=$table>";
 $cols=mysqli_query($GLOBALS['link'],"show columns from $table")or die(mysqli_error($GLOBALS['link']));
 echo"Select a criteria to filter";
 echo"<select name=field>";
 while($opt=mysqli_fetch_row($cols))
 	{
	if($opt[0]=="id" || $opt[0]=="ID")
	continue;
		echo"<option value='$opt[0]'>".str_replace("_"," ",$opt[0])."</option>";
		//$i++;
	}
 echo"</select>";
 echo "<input type=text name=value /><input type=submit value=GO name=filter id=filter>";	
 echo"</form>";
 }
 
public function DisplayList($query){
$res=mysqli_query($GLOBALS['link'],$query)or die("Query failed: ".mysqli_error($GLOBALS['link']));
$num_all=mysqli_num_rows($res);
if(mysqli_num_rows($res)==0)
echo"<b>No List Found</b>";
else{
	echo"<div>";
 echo"<table border=0 cellspacing=1 width=100%><tr>";
 //$col=mysqli_fetch_field($res);
 for($i=1;$i<mysql_num_fields($res);$i++){
 echo "<th>".mysql_field_name($res,$i);
 }
 //echo"<th>";
while($row=mysqli_fetch_array($res)){
	if($r%2==0)
	$strip="#CCCCCC";
	else
	$strip="#ffffff";
	echo"<tr bgcolor=$strip onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
	for($i=0;$i<mysql_num_fields($res);$i++){
		echo"<td>".$row[$i+1]."</td>";
	}
	echo"<td><a target='_blank' href='detail.php?id=".$row[0]."'>Track</a></td>";
	$r++;
}
echo"</table>";
echo"</div>";
	}
}
public function DisplayByQueryFull($query,$table,$targetFile,$targetDIV)
{
/************************************************************/
$res=mysqli_query($GLOBALS['link'],$query)or die("Query failed: ".mysqli_error($GLOBALS['link']));
$num_all=mysqli_num_rows($res);
if(mysqli_num_rows($res)==0){
echo"<b>No Records Found</b>";
}
else
{//record listing starts.
?>

 <div>
 <table border=0 cellspacing=1 width=100%><tr>
 <?php
 //$col=mysqli_fetch_field($res);
 for($i=0;$i<mysql_num_fields($res);$i++){
 echo "<th>".str_replace("_"," ",mysql_field_name($res,$i));
 }
 ?>
 <th><th><th>
 <?php
while($row=mysqli_fetch_array($res)){
if($r%2==0)
$strip="#CCCCCC";
else
$strip="#ffffff";
echo"<tr bgcolor=$strip onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
//echo"<td><input type=radio name=sel value=$row[0] onclick=javascript:getElementById('DELETE').disabled=0;getElementById('EDIT').disabled=0;>";
for($i=0;$i<mysql_num_fields($res);$i++){

echo"<td>$row[$i]</td>";
}
?>

<td><a href='#' 
onclick="ajax_load('<?php echo $targetDIV?>','<?php echo $targetFile?>?action=view&id=<?php echo $row[0]?>')"></a><a href='#' 
onClick="ajax_load('<?php echo $targetDIV?>','<?php echo $targetFile?>?action=view&id=<?php echo $row[0]?>')"><img src='images/view.gif' alt='View'  /></a></td>
<td><a href='#' 
onclick="ajax_load('<?php echo $targetDIV?>','<?php echo $targetFile?>?action=edit&id=<?php echo $row[0]?>')" ><img src='images/edit.png' alt='Edit' /></a></td>
<td><a href='#' 
onclick="if(confirm('Are you sure you want to delete this record?')){ajax_load('<?php echo $targetDIV?>','<?php echo $targetFile?>?action=delete&id=<?php echo $row[0]?>')}else{return false;}" ><img src='images/edit_remove.gif' alt='delete' /></a></td>
<?php
$r++;
}
?>
</table>
</div>
 <?php
 }//end of else

	
/************************************************************/
	}
public function DisplayByQuery($query,$table=NULL){ 
//filter_assist($table);
//echo"<form action='add.php?table=$table' method='post' name=$table>"; 
$res=mysqli_query($GLOBALS['link'],$query)or die("Query failed: ".mysqli_error($GLOBALS['link']));
$num_all=mysqli_num_rows($res);
if(mysqli_num_rows($res)==0){
//echo"<b>No Records Found</b>";
}
else
{//record listing starts.
 echo"<div>";
 echo"<table border=0 cellspacing=1 width=100%><tr><th>&nbsp;</th>";
 //$col=mysqli_fetch_field($res);
 for($i=0;$i<mysql_num_fields($res);$i++){
 echo "<th>".mysql_field_name($res,$i);
 }
	$sn=0;
while($row=mysqli_fetch_array($res)){
	$sn++;
if($r%2==0)
$strip="#CCCCCC";
else
$strip="#ffffff";
echo"<tr bgcolor=$strip onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
//echo"<td><input type=radio name=sel value=$row[0] onclick=javascript:getElementById('DELETE').disabled=0;getElementById('EDIT').disabled=0;>";
echo"<td>$sn";
	for($i=0;$i<mysql_num_fields($res);$i++){

echo"<td>$row[$i]</td>";
}
$r++;
}
echo"</table>";

 echo"</div>";
 }//end of else
 //if(mysqli_num_rows($res)!=0){
mysql_free_result($res);
 
  //echo"<input type=\"submit\" name=\"EDIT\" id=\"EDIT\" value=\"EDIT\" disabled=\"disabled\"/>"; 
 //echo"<input type=\"submit\" name=\"DELETE\" id=\"DELETE\" value=\"DELETE\" disabled=\"disabled\"
//onclick=\"javascript:if(!confirm('R U sure you want to delete?')){return(false);}\"/>";
//echo"</form>";
  //}
  }
 
 
public function DisplayListWithCheckboxGeneric($query)
{
	$res=mysqli_query($GLOBALS['link'],$query)or die("Query failed: ".mysqli_error($GLOBALS['link']));
$num_all=mysqli_num_rows($res);
if(mysqli_num_rows($res)==0){
echo"<b>No Records Found</b>";
}
else
{//record listing starts.
 echo"<div>";
 echo"<table border=1 cellspacing='5' width=100% cellpadding='5'><tr>
<th width='30'><input type='checkbox' name='checkAll' onclick=\"check_uncheck_all('generic_checkbox[]',this.checked)\">";
 //$col=mysqli_fetch_field($res);
 for($i=0;$i<mysql_num_fields($res);$i++){
 echo "<th>".mysql_field_name($res,$i);
 }
while($row=mysqli_fetch_array($res)){
if($r%2==0)
$strip="#CCCCCC";
else
$strip="#ffffff";
echo"<tr bgcolor=$strip onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
echo"<td><input type=checkbox name='generic_checkbox[]' value='$row[0]'>";
for($i=0;$i<mysql_num_fields($res);$i++){
echo"<td>$row[$i]</td>";
}
$r++;
}
echo"</table>";

 echo"</div>";
 }//end of else
	
} 
 
public function DisplayByQueryCheck($query,$table=NULL,$target_file){ 
//filter_assist($table);
echo"<form action='".$target_file."?table=$table' method='post' name='$table'>"; 
$res=mysqli_query($GLOBALS['link'],$query)or die("Query failed: ".mysqli_error($GLOBALS['link']));
$num_all=mysqli_num_rows($res);
if(mysqli_num_rows($res)==0){
echo"<b>No Records Found</b>";
}
else
{//record listing starts.
 echo"<div>";
 echo"<table border=0 cellspacing=1 width=100%><tr><th>";
 //$col=mysqli_fetch_field($res);
 for($i=0;$i<mysql_num_fields($res);$i++){
 echo "<th>".mysql_field_name($res,$i);
 }
while($row=mysqli_fetch_array($res)){
if($r%2==0)
$strip="#CCCCCC";
else
$strip="#ffffff";
echo"<tr bgcolor=$strip onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
echo"<td><input type=checkbox name=sel value=$row[0] onclick=javascript:getElementById('DELETE').disabled=0;getElementById('EDIT').disabled=0;>";
for($i=0;$i<mysql_num_fields($res);$i++){

echo"<td>$row[$i]</td>";
}
$r++;
}
echo"</table>";

 echo"</div>";
 }//end of else
 if(mysqli_num_rows($res)!=0){

 
  echo"<input type=\"submit\" name=\"EDIT\" id=\"EDIT\" value=\"EDIT\" disabled=\"disabled\"/>"; 
 echo"<input type=\"submit\" name=\"DELETE\" id=\"DELETE\" value=\"DELETE\" disabled=\"disabled\"
onclick=\"javascript:if(!confirm('R U sure you want to delete?')){return(false);}\"/>";
echo"</form>";
  }}
 
 
public function DisplayByQueryRadio($query,$table=NULL){ 
//filter_assist($table);
echo"<form action='add.php?table=$table' method='post' name=$table>"; 
$res=mysqli_query($GLOBALS['link'],$query)or die("Query failed: ".mysqli_error($GLOBALS['link']));
$num_all=mysqli_num_rows($res);
if(mysqli_num_rows($res)==0){
echo"<b>No Records Found</b>";
}
else
{//record listing starts.
 echo"<div>";
 echo"<table border=0 cellspacing=1 width=100%><tr><th>";
 //$col=mysqli_fetch_field($res);
 for($i=0;$i<mysql_num_fields($res);$i++){
 echo "<th>".mysql_field_name($res,$i);
 }
while($row=mysqli_fetch_array($res)){
if($r%2==0)
$strip="#CCCCCC";
else
$strip="#ffffff";
echo"<tr bgcolor=$strip onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
echo"<td><input type=radio name=sel value=$row[0] onclick=javascript:getElementById('DELETE').disabled=0;getElementById('EDIT').disabled=0;>";
for($i=0;$i<mysql_num_fields($res);$i++){

echo"<td>$row[$i]</td>";
}
$r++;
}
echo"</table>";

 echo"</div>";
 }//end of else
 if(mysqli_num_rows($res)!=0){

 
  echo"<input type=\"submit\" name=\"EDIT\" id=\"EDIT\" value=\"EDIT\" disabled=\"disabled\"/>"; 
 echo"<input type=\"submit\" name=\"DELETE\" id=\"DELETE\" value=\"DELETE\" disabled=\"disabled\"
onclick=\"javascript:if(!confirm('R U sure you want to delete?')){return(false);}\"/>";
echo"</form>";
  }}

public function NavigationLinks($curr_limit, $num_records, $limit_val, $limit_var = "limit", $next = "next >", $prev = "< prev", $seperator = "|") {
    // rebuild query string
	//echo $num_records."___".$limit_val;
	$total_pages = ceil($num_records / $limit_val); 
    if (!empty($_SERVER['QUERY_STRING'])) {
        $parts = explode("&", $_SERVER['QUERY_STRING']);
        $newParts = array();
        foreach ($parts as $val) {
            if (stristr($val, $limit_var) == false) array_push($newParts, $val);
        }
        $qs = (count($newParts) > 0) ? "&".implode("&", $newParts) : "";
    } else {
        $qs = "";
    }
    $navi = "";
    if ($curr_limit > 0) {
        $navi .= "<a href=\"".$_SERVER['PHP_SELF']."?".$limit_var. "=".($curr_limit-$limit_val).$qs."\">".$prev."</a>";		
    }
    $navi .= " ".$seperator." ";
	
    if ($curr_limit < ($num_records-$limit_val)) {
        $navi .= "<a href=\"".$_SERVER['PHP_SELF']."?".$limit_var. "=".($curr_limit+$limit_val).$qs."\">".$next."</a>";
			}
			for($p=0;$p<$total_pages;$p++){
			if($p%15==0)
			echo"<br>";
			if($p*$limit_val == $curr_limit)
			echo "-[ <b>".($p+1)."</b> ]-";
			else
			echo" --  <a href=\"".$_SERVER['PHP_SELF']."?".$limit_var. "=".($p*$limit_val).$qs."\">".($p+1)."</a> --";
    }
    return trim($navi, " | ");
}



 //============================================display single record vertically=========================
 public function DisplaySingle($query){ 
$start=1;
 $res=mysqli_query($GLOBALS['link'],$query)or die(mysqli_error($GLOBALS['link']));
 if(mysqli_num_rows($res)>0){
 echo"<div align='left' style='border-color:#FFC68C'>";	 
 echo"<table border=0 width='100%' cellpadding='1' >";	
 for($i=$start;$i<mysqli_num_fields($res);$i++)//listng the headers
	{
		echo"<tr><td width='30%' bgcolor=#B5E3E8><td><font color=#003399>".mysqli_fetch_fields($res)."</font>";
	}
echo"</table>";
echo"</div>";
}
else
echo"<br>No Record Found<br>";
//echo"<a href=\"report.php?query=$q\" target=_blank>ሪፖርት አውጣ</a>";
}
//////////////////////////________________________________________end ________________________
 

public function Display($table,$filter_col=NULL,$val=NULL,$q=NULL){

echo"<form action=\"prefernce.php?table= echo $table;\" method=\"post\">";

if($filter_col==NULL)
$sql="select * from $table";
else
$sql="select * from `$table` where `$filter_col`='$val'";

//echo $sql;
//if($table=="studentchoice")
echo $dep;
if($q!=NULL)
$sql=$q;
$res=mysqli_query($GLOBALS['link'],$sql)or die("query error");
//$num_all=mysqli_num_rows($res);
if(mysqli_num_rows($res)==0){
echo"<b>No Records Found</b>";
}
else
{
echo"<table border=0 bordercolor=#55CC33>";
$r=0;
if(mysql_num_fields($res)==0){echo"No record found!"; break;}
for($i=0;$i<mysql_num_fields($res);$i++){
echo"<th bgcolor=#bbbbbb>".mysql_field_name($res,$i);
}
while($row=mysqli_fetch_row($res)){
if($r%2==0)
$strip="#CCCCCC";
else
$strip="#ffffff";
echo"<tr bgcolor=$strip onMouseOver=this.bgColor='#CAFEA7' onMouseOut=this.bgColor='$strip'>";
//<input type=radio name=sel value=$row[0] onclick=javascript:getElementById('DELETE').disabled=0;>";

for($i=0;$i<mysql_num_fields($res);$i++){
if($table=="studentchoice" && $i==1)	
echo "<td>".get_department($row[$i])."</td>";
else			
echo"<td>$row[$i]";
}
//________________________to display the associated contact-----
/*
echo"<td><a onclick=\"switchMenu('myvar".$r."')\">contact</a>";
echo"<div id=myvar".$r." >";
get_contact($table,$row[0]);
echo"</div></td>";
*/
//_______________________________________________________________
$r++;
}
echo"</table>";
if($table!="student"){


echo"<br>";
/*
<!--<input type="submit" name="DELETE" id="DELETE" value="DELETE" disabled="disabled"
onclick="javascript:if(!confirm('R U sure you want to delete?')){return(false);}"/>
--></form>
*/

}
mysql_free_result($res);
}
}//end of display




public function AddNew($table){//accepts the table and the posted values as an array
	$all=array_keys($_POST);
//echo $all;

for($i=0;$i<count($_POST);$i++)
echo"<br>".$all[$i];

	
$q="insert into `$table` values(NULL,";

	for($i=0;$i<count($_POST)-2;$i++){
	$q=$q."'".$_POST[$all[$i]]."',";
	}
	//$q=$q."')";
	$q=$q."'".$_POST[$all[$i]]."',NULL)";
	echo $q;
	$add_res=mysqli_query($GLOBALS['link'],$q)or die(mysqli_error($GLOBALS['link']));
	if($add_res){
	echo"$table inserted";
	}	
 }
 ///////////////===================================end of add_new========================


public function LogAction($who,$q){
$logg="insert into `actionlog` values(NULL,'".$who."',\"".$q."\",'".date('d-m-Y')."')";
echo $logg;
mysqli_query($GLOBALS['link'],$logg)or die("Reg Log error:".mysqli_error($GLOBALS['link']));
}





public function Update_Record($table,$id){ // edit a single record
$fields=mysqli_query($GLOBALS['link'],"SHOW FIELDS FROM `$table`")or die("show filds failed ".mysqli_error($GLOBALS['link']));
 $all=array_keys($_POST);	
 $start=1;
 $q="UPDATE `aau`.`$table` SET `id`='".$id."',";

 	for($i=$start;$i<mysqli_num_rows($fields)-1;$i++){	
 	$q=$q."`".mysql_result($fields,$i)."`='".$_POST[$all[$i-1]]."',";
	}
	$q=$q."`".mysql_result($fields,$i)."`='".$_POST[$all[$i-1]]."' WHERE `id`='".$id."'";
//echo $q;	
$upd=mysqli_query($GLOBALS['link'],$q)or die(mysqli_error($GLOBALS['link']));
if($upd) echo $table ." Updated!";
 }//End of edit
 
 
 public function DynamicDropDown($table,$disp_col=NULL,$filter_col=NULL,$value=NULL,$edit=NULL){ 
  if($value==NULL)
 $q="select `".$this->primarykey($table)."`,$disp_col FROM $table ";
 else
 $q="select `".$this->primarykey($table)."`,$disp_col FROM $table where `$filter_col`='$value'";
 //if($table=="dipartment")
 //$q="select `$disp_col` FROM $table where `$filter_col`='$value'";
 //echo $q;
 //echo $edit;
    $res=mysqli_query($GLOBALS['link'],$q)or die("dropdown query failed:".mysqli_error($GLOBALS['link']));
	echo"<select name='selected_".$table."' id='selected_$table' onchange=''>";
	echo"<option>--select one--</option>";
	while($opt=mysqli_fetch_row($res)){
	echo"<option value='$opt[0]' "; 
	if($edit==$opt[0])
	echo" selected ";
	echo">".$opt[1];
	if(strpos($disp_col,",")>0)
	echo " ".$opt[2];
	echo"</option>";
	}
	echo"</select>";
	 }
 public function DynamicDropDown2($table,$disp_col=NULL,$filter_col=NULL,$value=NULL,$edit=NULL){ 
  if($value==NULL)
 $q="select `".$this->primarykey($table)."`,$disp_col FROM $table ";
 else
 $q="select `".$this->primarykey($table)."`,$disp_col FROM $table where `$filter_col`='$value'";
 //if($table=="dipartment")
 //$q="select `$disp_col` FROM $table where `$filter_col`='$value'";
 //echo $q;
 //echo $edit;
    $res=mysqli_query($GLOBALS['link'],$q)or die("dropdown query failed:".mysqli_error($GLOBALS['link']));
	echo"<select name='selected_".$table."' id='selected_$table' >";
	echo"<option>--select one--</option>";
	while($opt=mysqli_fetch_row($res)){
	echo"<option value='$opt[0]' "; 
	if($edit==$opt[0])
	echo" selected ";
	echo">".$opt[1];
	if(strpos($disp_col,",")>0)
	echo " ".$opt[2];
	echo"</option>";
	}
	echo"</select>";
	 }

	/**
	 * @param $sql
	 * @param null $number_of_coumns
     */
	public function DropDownItems($sql, $number_of_coumns=NULL)//make sure that the query returns two columns as PK ID and Display cols
{
//echo $sql;
	$resq=mysqli_query($GLOBALS['link'],$sql);//or die(mysqli_error($GLOBALS['link']));

	while($row=mysqli_fetch_array($resq))
		{
			if($number_of_coumns==NULL)
		echo"<option value='".$row[0]."'>".$row[1]."</option>";	
		else{
			echo"<option value='".$row[0]."'>";
			for($i=1;$i<=$number_of_coumns;$i++)
			echo $row[$i]." , ";
			echo "</option>";
		}
		}
	}
public function IsRegraded($sid,$batch,$semester,$course)
{
	$re="SELECT `ID`,`Section`, `Course`,  `PreviousMark`, `NewMarkOnOther`,	`NewMarkOnFinal`, `Reason`, `Date` FROM `regrade` WHERE `StudentID`='$sid' AND `Batch`='$batch' AND`Semester`='$semester' AND `Course`='$course'";
	$rre=mysqli_query($GLOBALS['link'],$re)or die(mysqli_error($GLOBALS['link']));
	if(mysqli_num_rows($rre)>0)
	{
		echo"<font color='#FF0000'>This student is already re-graded</font>";
		return true;
		}
		else
		return false;
	}
public function IsRegistered_pre($sid,$batch,$semester)
{
	$sq="SELECT `ID`, `RegistrationStatus`, `Date` FROM `student_registration_status` WHERE `SemesterID`='$semester'AND `BatchID`='$batch'AND `StudentID`='$sid'";
	$tempres=mysqli_query($GLOBALS['link'],$sq)or die("RegisterStudent()".mysqli_error($GLOBALS['link']));
	$row=mysqli_fetch_array($tempres);
	if($row['RegistrationStatus']=="Registered")
	return true;
	else 
	return false;
	}
public function IsRegistered($sid,$batch,$semester,$program,$year)
{
	$sq="SELECT * FROM `student_course_enrollment` WHERE `Approved`='Yes' AND `BatchID`='$batch' AND `SemesterID`='$semester' AND `Year`='$year'  AND `StudyProgramID`='$program' AND `StuedentID`='$sid'";
	$tempres=mysqli_query($GLOBALS['link'],$sq)or die(mysqli_error($GLOBALS['link']));
	//$row=mysqli_fetch_array($tempres);
	//echo $sq."<br>";
	if(mysqli_num_rows($tempres)>0)
	return true;
	else 
	return false;
	}

public function RegisterStudent($sid,$batch,$semester,$year)
{
	$sq="SELECT `ID`, `RegistrationStatus`, `Date` FROM `student_registration_status` WHERE `SemesterID`='$semester'AND `BatchID`='$batch' AND `Year`='$year' AND `StudentID`='$sid'";
	$tempres=mysqli_query($GLOBALS['link'],$sq)or die("RegisterStudent()".mysqli_error($GLOBALS['link']));
	if(mysqli_num_rows($tempres)==0){
	$regq="INSERT INTO `student_registration_status`(`ID`, `SemesterID`, `BatchID`,`Year`, `StudentID`, `RegistrationStatus`) VALUES (NULL,'$semester','$batch','$year','$sid','Registered')";
		mysqli_query($GLOBALS['link'],$regq)or die(mysqli_error($GLOBALS['link']));
		
	$this->write_log("Registrar",$_SESSION['fullname'],"Student ".$this->GetFullName('student',$_REQUEST['allowsid'])." is approved for registration",$this->getIP(),date("Y-m-d H:i:s"));
	
	}
	else//was previously unregistered and now registered
	{
	$uregq="UPDATE `student_registration_status` SET `RegistrationStatus`='Registered' WHERE
	`SemesterID`='$semester' AND `BatchID`='$batch'AND `StudentID`='$sid' AND `Year`='$year'";
	mysqli_query($GLOBALS['link'],$uregq)or die(mysqli_error($GLOBALS['link']));
	}
}
public function UnRegisterStudent($sid,$batch,$semester,$year)
{
	$uregq="UPDATE `student_registration_status` SET `RegistrationStatus`='Not Registered' WHERE
	`SemesterID`='$semester' AND `BatchID`='$batch'AND `StudentID`='$sid'  AND `Year`='$year'";
	mysqli_query($GLOBALS['link'],$uregq)or die(mysqli_error($GLOBALS['link']));
}
public function StudentHasEndEnrollment($batch,$semester,$year,$sid)
{    $end=NULL;
	$sql="SELECT `End` FROM `student_course_enrollment` WHERE `BatchID`='$batch' AND `Year`='$year' AND `SemesterID`='$semester' AND `StuedentID`='$sid'";
	$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	while($erow=mysqli_fetch_row($res)){
		if($erow[0]=="No"){
		$end="No";
		break;
		}
		elseif($erow[0]=="Yes")
		continue;
		}
		if($end=="No")
		return false;
		else
		return true;
	}
public function IsAvilable($table,$id){
	$res=mysqli_query($GLOBALS['link'],"SELECT * FROM `$table` WHERE ".$this->primarykey($table)." ='$id'") or die(mysqli_error($GLOBALS['link']));
	if(mysqli_num_rows($res)>0)
	return true;
	else
	return false;
	} 
public function IsAvilableByCustomCol($table,$col,$val){
	$res=mysqli_query($GLOBALS['link'],"SELECT * FROM `$table` WHERE `".$col."`='$val'") or die("Error: ".mysqli_error($GLOBALS['link']));
	if(mysqli_num_rows($res)>0)
	return true;
	else
	return false;
	} 	 
public function DynDropDownByQuery($query,$table=NULL){//make sure that you have a query returning `id`,`somecolumn`.......make sure that you call this method only oonce. for the purose of ID and Name conflict.... you know what i'm saing... huh... huhhhhhhhhh!... good boy.
$res=mysqli_query($GLOBALS['link'],$query)or die(mysqli_error($GLOBALS['link']));
echo"<select name='selected_$table' id='selected_$table'>";
	echo"<option>--select one--</option>";
	while($opt=mysqli_fetch_row($res)){
	
	echo"<option value='$opt[0]'>$opt[1]</option>";
	
	}
	echo"</select>";
}
	public function DynSuperDropDownByQuery($query,$table,$postURL,$responseDIV){//this method can
		//ajaxPost(strURL,formname,responsediv)
		$form_name="form_dyn_drop_down_$table";
		echo"<form name='$form_name' method='post' action='$postURL'>";
		$res=mysqli_query($GLOBALS['link'],$query)or die(mysqli_error($GLOBALS['link']));
		echo"<select name='selected_$table' id='selected_$table' onchange=\"ajaxPost('$postURL','$form_name','$responseDIV')\">";
		echo"<option>--select one--</option>";
		while($opt=mysqli_fetch_row($res)){

			echo"<option value='$opt[0]'>$opt[1]</option>";

		}
		echo"</select>";
		echo"</form>";
	}
public function TrimLastComma($looped_query_string){
$looped_query_string=substr($looped_query_string,0,strlen($looped_query_string)-1);
return $looped_query_string;
}
 public function GotGrade($batch,$semester,$year,$student,$course)
 {
	 $cq="SELECT `ID`, `BatchID`, `SemesterID`, `StudentID`, `CourseID`, `GradeID`, `ECTS` FROM `student_grade` WHERE 
	 `BatchID`='$batch' AND `SemesterID`='$semester' AND `Year`='$year' AND `StudentID`='$student' AND `CourseID`='$course'";
	 //echo $cq;
	 if(mysqli_num_rows(mysqli_query($GLOBALS['link'],$cq))>0)
	 return true;
	 else
	 return false;
 } 
 public function SectionGotGrade($batch,$semester,$course,$section)
 {
	 $cq="SELECT `ID`, `BatchID`, `SemesterID`, `StudentID`, `CourseID`, `GradeID`, `ECTS` FROM `student_grade` WHERE 
	 `BatchID`='$batch' AND `SemesterID`='$semester' AND `CourseID`='$course' AND `SectionID`='$section'";
	 if(mysqli_num_rows(mysqli_query($GLOBALS['link'],$cq))>0)
	 return true;
	 else
	 return false;
 }
 public function GetGrade($final,$other,$egrade)
 {
	 if($egrade!='--select one--'){//if none of NG,I, or blank is selected
	 $gq="SELECT  `ID` ,  `Raw_mark_interval_min` ,  `Raw_mark_interval_max` ,  `Fixed_number_grade` ,  `Letter_grade` ,  `Status` ,  `Class` ,  `ECTS_to_grade` , `Conventional_Grade_Point` 
FROM  `grade` 
WHERE `Letter_grade`='$egrade'";
	 }
else
{
	 $total=$final + $other;
	 
	 $gq="SELECT  `ID` ,  `Raw_mark_interval_min` ,  `Raw_mark_interval_max` ,  `Fixed_number_grade` ,  `Letter_grade` ,  `Status` ,  `Class` ,  `ECTS_to_grade` , `Conventional_Grade_Point` 
FROM  `grade` 
WHERE  `Raw_mark_interval_min` <='$total'
AND  `Raw_mark_interval_max` >='$total'";
//echo $gq;
}
$res=mysqli_query($GLOBALS['link'],$gq) or die(mysqli_error($GLOBALS['link']));
$grade=mysqli_fetch_array($res) or die(mysqli_error($GLOBALS['link']));
return($grade);
 }
 
  public function GetGradeNew($final,$other,$ass1,$ass2,$ass3,$ass4,$egrade)
 {
	 if($egrade!='--select one--'){//if none of NG,I, or blank is selected
	 $gq="SELECT  `ID` ,  `Raw_mark_interval_min` ,  `Raw_mark_interval_max` ,  `Fixed_number_grade` ,  `Letter_grade` ,  `Status` ,  `Class` ,  `ECTS_to_grade` , `Conventional_Grade_Point` 
FROM  `grade` 
WHERE `Letter_grade`='$egrade'";
	 }
else
{
	 $total=$final + $other + $ass1 + $ass2 +$ass3 +$ass4;
	 
	 $gq="SELECT  `ID` ,  `Raw_mark_interval_min` ,  `Raw_mark_interval_max` ,  `Fixed_number_grade` ,  `Letter_grade` ,  `Status` ,  `Class` ,  `ECTS_to_grade` , `Conventional_Grade_Point` 
FROM  `grade` 
WHERE  `Raw_mark_interval_min` <='$total'
AND  `Raw_mark_interval_max` >='$total'";
//echo $gq;
}
$res=mysqli_query($GLOBALS['link'],$gq) or die(mysqli_error($GLOBALS['link']));
$grade=mysqli_fetch_array($res) or die(mysqli_error($GLOBALS['link']));
return($grade);
 }
 
 public function GradeOf($total)
 {
	 $gq="SELECT  `ID` ,  `Raw_mark_interval_min` ,  `Raw_mark_interval_max` ,  `Fixed_number_grade` ,  `Letter_grade` ,  `Status` ,  `Class` ,  `ECTS_to_grade` , `Conventional_Grade_Point` 
FROM  `grade` 
WHERE  `Raw_mark_interval_min` <='$total'
AND  `Raw_mark_interval_max` >'$total'";
$res=mysqli_query($GLOBALS['link'],$gq) or die(mysqli_error($GLOBALS['link']));
$grade=mysqli_fetch_array($res) or die(mysqli_error($GLOBALS['link']));
return($grade);
 }
 public function primarykey($table){	 
 $col_res=mysqli_query($GLOBALS['link'],"SHOW INDEXES FROM `$table` WHERE `Key_name`='PRIMARY'")or die(mysqli_error($GLOBALS['link']));
 $pk=mysqli_fetch_array($col_res)or die(mysqli_error($GLOBALS['link']));
 //$pk=mysqli_fetch_field($col_res)or die(mysqli_error($GLOBALS['link']));
 //return $pk->Column_name;//['Column_name'];
 return $pk['Column_name'];
 }
  
 public function GetContact($table,$id){
 if($table=="aau_office")
 $c="select * from `aau_contact` where `Contact ID`='$id'";
 else if ($table=="external_office")
  $c="select * from `external_contact` where `contact_id`='$id'";
  //echo $c;
  $contact=mysqli_query($GLOBALS['link'],$c);
  if(mysqli_num_rows($contact)>0){
  echo"<table border=0>";
  for($i=2;$i<mysql_num_fields($contact);$i++){
  echo"<tr><td>".mysql_field_name($contact,$i)."<td>".mysql_result($contact,0,mysql_field_name($contact,$i));  
  }  
  echo"</table>";
  }
  else
  echo "No contact registered!";
 }
  
  
 public function DeleteRecord($table,$field=NULL,$value){ 
 if($field==NULL)
 $q="DELETE FROM `$table` WHERE `$table`.`".$this->primarykey($table)."` = '$value'";
 else
 $q="DELETE FROM `$table` WHERE `$table`.`".$field."` = '$value'";
 $res=mysqli_query($GLOBALS['link'],$q)or die(mysqli_error($GLOBALS['link']));
 //echo $q;
//if(mysqli_query($GLOBALS['link'],$q)or die(mysqli_error($GLOBALS['link'])))
//{
//echo"Record deleted!";
//}
 }
	public function empty_table($table){
		$sql="TRUNCATE TABLE `$table`";
		$res=mysqli_query($GLOBALS['link'],$sql)or die("Truncate error: ".mysqli_error($GLOBALS['link']));
		
		} 
 public function GetFullName($table,$id)
     { 
	 $sql="SELECT CONCAT( `First_name`,' ', `Middle_name`, ' ',`Last_name`) FROM `$table` WHERE `ID`='$id'";
	 $res=mysqli_query($GLOBALS['link'],$sql)or die("GetField Error:".mysqli_error($GLOBALS['link']));
 $col=mysqli_fetch_row($res);
 return($col[0]);
	 }
 public function GetInstructorName($batch,$semester,$course,$section){
	 $sql="SELECT `Instructor` FROM `instrucor_course` WHERE `Batch`='$batch' AND `Semester`='$semester' AND `Course`='$course' AND `Section`='$section'";
	 $res=mysqli_query($GLOBALS['link'],$sql)or die("Error|GetInsturctorName|:".mysqli_error($GLOBALS['link']));
	 if(mysqli_num_rows($res)>0)
	 $instId=mysqli_fetch_array($res);
	 return($this->GetFullName('instructor',$instId[0]));
	 }

  public function GetFieldByQuery($sql){
 //$sql="SELECT `$col` FROM `$table` WHERE `".$this->primarykey($table)."`=$id";
 //echo $sql;
 $res=mysqli_query($GLOBALS['link'],$sql)or die("GetField Error:".mysqli_error($GLOBALS['link']));
 $col=mysqli_fetch_row($res);
 return($col[0]);
 }
 public function allocation_possible($examinee){
	 $sql="SELECT `id` FROM `exam_allocation` WHERE `examinee`=$examinee";
	 $res=mysqli_query($GLOBALS['link'],$sql)or die("Check allocation Error:".mysqli_error($GLOBALS['link']));
	 if(mysqli_num_rows($res)<2)
		 return true;
	 else
		 return false;
 }
	public function allocate_exam($examinee,$exam){
	$sql="INSERT INTO `exam_allocation`(`id`, `examinee`, `exam`, `remark`) VALUES (NULL,'$examinee','$exam','')";
		//echo $sql;
		$res=mysqli_query($GLOBALS['link'],$sql)or die("allocation Error:".mysqli_error($GLOBALS['link']));
}
 
 public function GetField($col,$table,$id){
 $sql="SELECT `$col` FROM `$table` WHERE `".$this->primarykey($table)."`='$id'";
 //echo $sql;
 $res=mysqli_query($GLOBALS['link'],$sql)or die("GetField Error:".mysqli_error($$GLOBALS['link']));
 $col=mysqli_fetch_row($res);
 return($col[0]);
 }
 
   
 public function GetCountAggrigate($query){ // !!!!!!!!!!!   ONLY FOR COUNT(``) QUERISE
 $countResult=mysqli_query($GLOBALS['link'],$query);
 if($countResult){
 $countNum=mysqli_fetch_row($countResult);////////// I think this should be mysqli_num_rows($countResult)
 return($countNum[0]);
 }
 else
 return 0;
 }
 
 
 public function GetTotal($table){
 $res=mysqli_query($GLOBALS['link'],"SELECT * FROM `$table`")or die(mysqli_error($GLOBALS['link']));
 return mysqli_num_rows($res);
 }
 
 public function LeadingZero( $aNumber, $intPart, $floatPart=NULL, $dec_point=NULL, $thousands_sep=NULL) {
  //Note: The $thousands_sep has no real public function because it will be "disturbed" by plain leading zeros -> the main goal of the public function
 $formattedNumber = $aNumber;
 if (!is_null($floatPart)) { //without 3rd parameters the "float part" of the float shouldn't be touched
   $formattedNumber = number_format($formattedNumber, $floatPart, $dec_point, $thousands_sep);
   }
 //if ($intPart > floor(log10($formattedNumber)))
   $formattedNumber = str_repeat("0",($intPart + -1 - floor(log10($formattedNumber)))).$formattedNumber;
 return $formattedNumber;
 }
 /*****************************Schedluling functions*******************************************/
 //fetch batch,semester,Departmen,StudyProgram,courseid,credithr,periodid,
 public function generate_schedule($batch,$semester){
	 $cb_sql="SELECT `ID`, `Batch`, `Year`, `Semester`, `Department`, `Study_Program`, `Course`, `Type` FROM `coursebreakdown` WHERE `Batch`='".$batch."' AND `Semester`='".$semester."'  AND `Course` NOT IN (SELECT `Course` FROM `schedule` )";
echo $cb_sql;
	  $res=mysqli_query($GLOBALS['link'],$cb_sql)or die(mysqli_error($GLOBALS['link']));
	 while($cb_row=mysqli_fetch_assoc($res))
	 	{
			//Identify the chredit hour of the current course	
			$co_sql="SELECT `id`, `Course_code_prefix`, `Course_number_suffix`, `Course_Title`, `Credit_Hr`, `Contact_Hr`, `Wet_Lab_Hr`, `Computer_Lab_Hr`, `ECTS`, `Status`, `Department`, `Study_Program`  FROM `course` WHERE `id`='$cb_row[Course]'";
			echo "<br>".$co_sql;
			$course_res=mysqli_query($GLOBALS['link'],$co_sql)or die(mysqli_error($GLOBALS['link']));
			$course_chr_row=mysqli_fetch_assoc($course_res)or die("Fetch assoc error: "+ mysqli_error($GLOBALS['link']));
			
			//check the quota
			$quota_sql="SELECT `id`, `Study_Program_ID`, `Batch`, `Quota` FROM `department_quota` WHERE `Study_Program_ID`='$cb_row[Study_Program]' AND `Batch`='$batch'";
			echo "<br>".$quota_sql;
			$quota_res=mysqli_query($GLOBALS['link'],$quota_sql)or die(mysqli_error($GLOBALS['link']));
			if(mysqli_num_rows($quota_res)>0){			
			$quota_row=mysqli_fetch_assoc($quota_res)or die(mysqli_error($GLOBALS['link']));
			$size =$quota_row['Quota'];
			}else{$size=0;}
			//select a room that can fit
			/*
			$room_sql="SELECT `id`, `Room_ID`, `Building`, `Type`, `Capacity`, `Associated_Department` FROM `classroom` WHERE `Capacity`>='$quota_row[Quota]' ORDER BY (`Capacity`)";			
			}
			else
			$room_sql="SELECT `id`, `Room_ID`, `Building`, `Type`, `Capacity`, `Associated_Department` FROM `classroom`";
			echo "<br>ROOM Query:".$room_sql;
			$room_res=mysqli_query($GLOBALS['link'],$room_sql)or die(mysqli_error($GLOBALS['link']));
								
			if(mysqli_num_rows($room_res)>0){
			//pick free room...
			
				$room_row=mysqli_fetch_assoc($room_res) or die(mysqli_error($GLOBALS['link']));
				//shuffle($room_row);
				*/
			$inst_sql="SELECT `ID`, `Course`, `Instructor`, `Batch`, `Semester`, `Department` FROM `instrucor_course` WHERE `Batch`='$batch' AND `Semester`='$semester' AND `Course`='$cb_row[Course]'";
			echo "<br>Assigned course: ".$inst_sql;
			$inst_res=mysqli_query($GLOBALS['link'],$inst_sql)or die(mysqli_error($GLOBALS['link']));
			if(mysqli_num_rows($inst_res)>0){
			$inst_row=mysqli_fetch_assoc($inst_res)or die(mysqli_error($GLOBALS['link']));
			$instructor=$inst_row['Instructor'];
			}
			else
			$instructor="-1";
			//----Check if section is required
			$sec_sql = "SELECT `ID`, `Batch`, `Semester`, `Department`, `Study_Program`, `Course`, `Section_name`, `Section_size`, `Room Type`, `Suggest_Class` FROM `section` WHERE `Course`='$cb_row[Course]' AND `Batch`='$cb_row[Batch]' AND `Department`='$cb_row[Department]'";
			echo "<br>Sec: ".$sec_sql;
			$sec_res=mysqli_query($GLOBALS['link'],$sec_sql)or die(mysqli_error($GLOBALS['link']));
			if(mysqli_num_rows($sec_res)>0){
				//section required
				$section=true;
				$sec_row=mysqli_fetch_assoc($sec_res);
					if($sec_row['Suggest_Class']!="Null")
					$room_sug=true;
					else
					$room_sug=false;
				}else
				{$section=false;}
			//----------now call the make period function 
			////------->    
			$temp=array();  
			$temp=$this->make_period($course_chr_row['Credit_Hr']);
		//if($room_sug==true){
			//$room=$sec_row['Suggest_Class'];
			//echo"<br><b>Room Suggested</b><br>";
		//	}
		//else
		$classroom=$this->get_free_room($semester,$batch,$size,$this->map_period('Regular',$period[1]),$period[0]);
		$room=$classroom['id'];
			foreach($temp as $period){
				//echo $period[0].",".$period[1]."<br>";	
				if($section==true){
					for($i=1;$i<=$sec_row['Number_of_sections'];$i++)
						{
						echo"<br>Section query<br>";
							if($room_sug==true){
			$room=$sec_row['Suggest_Class'];
			echo"<br><b>Room Suggested</b><br>";
			}
			$temp=$this->make_period($course_chr_row['Credit_Hr']);
						$schedule_sql="INSERT INTO `schedule`(`ID`, `Batch`, `Semester`, `Study_Program`, `Day`, `Period`, `Course`, `Room`, `Instructor`) VALUES (NULL,'$batch','$semester','$cb_row[Study_Program]','$period[0]','".$this->map_period('Regular',$period[1])."','$cb_row[Course]','".$room."',".$instructor.")";
						mysqli_query($GLOBALS['link'],$schedule_sql)or die(mysqli_error($GLOBALS['link']));
						echo "<br>".$schedule_sql;
							}
					}else{
					
			$schedule_sql="INSERT INTO `schedule`(`ID`, `Batch`, `Semester`, `Study_Program`, `Day`, `Period`, `Course`, `Room`, `Instructor`) VALUES (NULL,'$batch','$semester','$cb_row[Study_Program]','$period[0]','".$this->map_period('Regular',$period[1])."','$cb_row[Course]','".$room."',".$instructor.")";
				echo "<br>".$schedule_sql;
				//echo $this->map_period('Regular',$period[0]);
      mysqli_query($GLOBALS['link'],$schedule_sql)or die(mysqli_error($GLOBALS['link']));}//end of else
			//}while(1);
			}//end of foreach
			//}else{
				/*Quota unussigned required*/
				//pick unassigned instructor
				//}	 		
		}
	 
	 }
public function map_period($basis,$p){
	$sql="SELECT  `id` FROM  `period` WHERE  `Basis` =  '$basis' AND  `Period` =  '$p'";
	//echo $sql;
	$p_id_res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	$p_row=mysqli_fetch_row($p_id_res);
	return($p_row[0]);
	}	 
public function make_period($chr){	
$p=array(0,2,4,6);
shuffle($p);
$period=array(1,2,3,4,5,6,7,8);
$day=array('M','T','W','Th','F');
$dp=array();
for($i=1;$i<=(($chr%2==0)?$chr:($chr-1));$i+=2)
	{
		shuffle($day);
		$r=$p[$i];			
		//echo $day[0]."(".$period[$r].",".$period[$r+1].")";
		$dp[$i][0]=	$day[0];
		$dp[$i][1]=	$period[$r];
		$dp[$i+1][0]=	$day[0];
		$dp[$i+1][1]=	$period[$r+1];
	}
	
	if($chr%2!=0)
		{
		$r=$p[0];
		//echo $day[1]."(".$period[$r].")";	
		$dp[$i+1][0]=	$day[1];
		//shuffle($period);
		$dp[$i+1][1]=	$period[$r];	
		}
		
	//print_r($p);
	return($dp);
}	
public function get_free_room($sem,$ba,$quota=0,$period,$day){
			$room_sql="SELECT `id`, `Room_ID`, `Building`, `Type`, `Maximum_capacity`, `Purpose`, `Total_floor_area`, `Number_of_benches`, `Total_bench_area`, `Total_side_bench_area`, `Hoods`, `Average_number_of_hrs_per_expt`, `Number_of_lab_sessions_per_week`, `Average_number_of_hrs_per_week`, `Total_number_of_expts_per_week`, `Total_number_of_expts_per_semester`, `Number_of_hrs_of_lab_usage_per_semester`, `Utilization`, `Associated_Department`, `Status`, `Remark` FROM `classroom` WHERE `Maximum_capacity`>='$quota' ORDER BY (`Maximum_capacity`)";			
			
			//$room_sql="SELECT `id`, `Room_ID`, `Building`, `Type`, `Capacity`, `Associated_Department` FROM `classroom`";
			echo "<br>ROOM Query:".$room_sql;
			$room_res=mysqli_query($GLOBALS['link'],$room_sql)or die(mysqli_error($GLOBALS['link']));
			while($room_row=mysqli_fetch_assoc($room_res))
				{
					$pq="SELECT  `Batch`, `Semester`, `Day`, `Period`, `Room` FROM `schedule` WHERE `Batch`='$ba' AND `Semester`='$sem' AND `Day`='$day' AND `Period`='$period' AND `Room`='$room_row[id]'";
					echo"<br>".$pq;
					$check_res=mysqli_query($GLOBALS['link'],$pq)or die("room checkup error: ".mysqli_error($GLOBALS['link']));
					if(mysqli_num_rows($check_res)==0){
						echo"<br>got room";
						$free_room=$room_row;
						break;
						}
						else{
							echo"<br>room was taken";
						//continue;
						}
				}
				//print_r($free_room);	
				return($free_room);
	} 
	public function get_admin_password()
	{
		$sql="SELECT  `Password` FROM  `user` WHERE  `level` =  '-1'";
		$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		$pwd=mysqli_fetch_row($res);
		return($pwd[0]);
		}
	public function getIP() {
    return $_SERVER["REMOTE_ADDR"];
}
	public function write_log($type,$fullname,$action,$ip,$date){
		$sql="INSERT INTO  `arms`.`arms_log` (`ID` ,`Type` ,`User` ,`Action` ,`IP` ,`Date`)
VALUES (
NULL ,  '$type',  '$fullname',  '$action',  '$ip',  '$date'
);";
mysqli_query($GLOBALS['link'],$sql);
		}
	public function checkIfExistByQuery($query)
	{
		$res=mysqli_query($GLOBALS['link'],$query)or die(mysqli_error($GLOBALS['link']));
		if(mysqli_num_rows($res)>0)
		return true;
		else
		return false;
		}
	public function previous_total_for_regarade($sid,$batch,$year,$semester,$section,$course)
	{
		$sql="SELECT `Final`,`Other`,`Assessment1`,`Assessment2`,`Assessment3`,`Assessment4` FROM `student_grade` WHERE `BatchID`='$batch' and `Year`='$year' and `SemesterID`='$semester' and `SectionID`='$section' and `StudentID`='$sid' and `CourseID`='$course'";
		$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		$row=mysqli_fetch_row($res);
		return($row[0]+$row[1]+$row[2]+$row[3]+$row[4]+$row[5]);
	}
	public function stud_has_enrolled($studID,$batch,$semester,$course)//add year
	{
		$sql="SELECT * FROM `student_course_enrollment` WHERE `BatchID`='$batch' AND `SemesterID`='$semester' AND `StuedentID`='$studID' AND `CourseID`='$course'";
		if(mysqli_num_rows(mysqli_query($GLOBALS['link'],$sql))>0)
		return true;
		else
		return false;
		}
 /*********************************End***************************************/
 public function checkNG_W_DO_I_NULL($batch,$semester,$sid){
	 $sql="SELECT `GradeID` FROM `student_grade` WHERE `BatchID`='$batch' and `SemesterID`='$semester' and `StudentID`='$sid'";
	 $res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	 $row=mysqli_fetch_array($res);
	 if($row[0]==13 || $row[0]==15 || $row[0]==16 || $row[0]==14 || mysqli_num_rows($res)==0)//NG,W,DO,I
	 {
		 return true;
	 }
	 else
	 return false;
	 }
   public function checkPreviousFW($sid){
	   $sql="SELECT `Status` FROM `student_cgpa_log` WHERE `StudentID`='$sid'  and `Status`='Forced Withdrawal'";	   
	   $res=mysqli_query($GLOBALS['link'],$sql)or die("checkPreviousFW Error:".mysqli_error($GLOBALS['link']));
	   //$row=mysqli_fetch_row($res);
	  if(mysqli_num_rows($res)>0)
	  return true;
	  else
	   return false;
	   }
   public function checkPreviousWarning($sid,$batch,$sem,$status,$year)
   {
	   if($sem==1){
	$batch--;
	$semester=2;}
	else if($sem==2)
	$sem--;
	$sql="SELECT `Status` FROM `student_cgpa_log` WHERE `Batch`='$batch' and `Semester`='$sem' and `StudentID`='$sid' and `Year`='$year'";
	//$status="";
	$res=mysqli_query($GLOBALS['link'],$sql)or die("checkPreviousWarning Error:".mysqli_error($GLOBALS['link']));
	   $row=mysqli_fetch_assoc($res);
	   if($row['Status']=="Warning"){
	       if($this->checkPreviousFW($sid))
		   $status="Dismissal";
		   else
	       $status="Forced Withdrawal";
	   }
	   else if($row['Status']=="Forced Withdrawal")
	   $status="Dismissal";
	   //echo $status;
	   return($status);
	   }
   public function checkIfAllCoursesRepeated(){}
   /********************************************************************/
   public function getPSGPA($sid,$batch,$sem,$year)
   {
	   if($sem==1){
	$batch--;
	$semester=2;}
	else if($sem==2)
	$sem--;
	   $sql="SELECT `ID`, `Program`, `Batch`, `Year`,`Semester`, `Entry_Year`, `StudentID`, `STotalGP`, `STotalECTS`, `SGPA` FROM `student_result_log` WHERE `StudentID`='$sid' AND `Batch`='$batch' AND `Year`='$year' AND `Semester`='".$sem."'";
	   $res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	   $row=mysqli_fetch_assoc($res);
	   return($row['SGPA']);
	   } 
	public function CheckNGConversion($sid,$batch,$year,$semester,$course) 
	{
		$sql="SELECT `GradeID` FROM `student_grade` WHERE `BatchID`='$batch' AND `Year`='$year' AND `SemesterID`='$semester' AND `StudentID`='$sid' AND `CourseID`='$course'";
		$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		$row=mysqli_fetch_row($res);
		if(mysqli_num_rows($res)>0 && ($row[0]>=14))
		{
			$reduce=$this->GetField("ECTS","course",$course);
			return($reduce);
			}
			else
			return(0);
	}
	public function getSGPA($sid,$batch,$sem,$year)
   {
	   $sql="SELECT `ID`, `Program`, `Batch`,`Year`, `Semester`, `Entry_Year`, `StudentID`, `STotalGP`, `STotalECTS`, `SGPA` FROM `student_result_log` WHERE `StudentID`='$sid' AND `Batch`='$batch' AND `Year`='$year' AND `Semester`='".$sem."'";
	   $res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	   $row=mysqli_fetch_assoc($res);
	   return($row['SGPA']);
	   }
   public function getStatus($sid,$batch,$sem,$totalECTS,$totalGP,$cgpa,$complete,$year)
   {
	   $comment="";
	if($complete=="No"){
	$status="No Status";
	$comment="Incomplete ECTS or got NG, Do or I";
	}
	else{
				if($totalECTS< 25)
				{
					$status="No Status";
					$comment="Total ECTS < 25";
				}
				else if($totalECTS>=25 && $totalECTS<=45)
				{
					if($cgpa< 1.5)
					{
						$status="Forced Withdrawal";
						$comment="Total ECTS B/N 25 and 45 and CGPA < 1.5";
						if($this->checkPreviousFW($sid))
							{
								$status="Dismissal";
								$comment="Had previous Forced Withdrawal";
							}
					}
					else if($cgpa>=1.5 && $cgpa<=1.74)
					{
						$status="Warning";
						$comment="CGPA b/n 1.5 and 1.74";
			if($this->checkPreviousWarning($sid,$batch,$sem,$status,$year)!=$status)
			$status=$this->checkPreviousWarning($sid,$batch,$sem,$status,$year);
					}
					else if($cgpa>=1.75)
					{
						$status="Promoted";
					}
				}
				else if($totalECTS>45 && $totalECTS<=72)
				{
					
					if($cgpa< 1.75)
					{
						$status="Forced Withdrawal";
						$comment="CGPA < 1.75 where total ECTS b/n 45 and 72";
						if($this->checkPreviousFW($sid))
							{
								$status="Dismissal";
								$comment="Had previous Forced Withdrawal";
								//break;
							}
					}
					else if($cgpa>=1.75 && $cgpa<=1.99)
					{
						$status="Warning";
						$comment="CGPA b/n 1.75 and 1.99 where total ECTS b/n 45 and 72";
						if($this->checkPreviousWarning($sid,$batch,$sem,$status,$year)!=$status)
						$status=$this->checkPreviousWarning($sid,$batch,$sem,$status,$year);
					}
					else if($cgpa>=2.00)
					{
						$status="Promoted";
					}
				}
				else if($totalECTS>72)
				{
					if($this->getPSGPA($sid,$batch,$sem,$year)<1.75 || $cgpa<2.00)
					{
						if($this->getSGPA($sid,$batch,$sem,$year)<1.75 || $cgpa<2.00)
						{
							$status="Forced Withdrawal";
							$comment="CGPA < 2.00 or P&SGPA<1.75 where total ECTS > 72";
							if($this->checkPreviousFW($sid))
							{
								$status="Dismissal";
								$comment="Had previous Forced Withdrawal";
								//break;
							}
						}
						else if($this->getSGPA($sid,$batch,$sem,$year)>=1.75 || $cgpa>=2.00)
						{
							$status="Promoted";
						}
					}
					else if($this->getPSGPA($sid,$batch,$sem,$year)>=1.75 || $cgpa>=2.00)
					{
						if($this->getSGPA($sid,$batch,$sem,$year)>=1.75 || $cgpa>=2.00)
						{
							$status="Promoted";
						}
						else if($this->getSGPA($sid,$batch,$sem,$year)<=1.75 || $cgpa<=2.00)
						{
							$status="Warning";
							$comment="SGPA < 1.75 or CGPA <=2.00";
							if($this->checkPreviousWarning($sid,$batch,$sem,$status,$year)!=$status)
						    $status=$this->checkPreviousWarning($sid,$batch,$sem,$status,$year);
						}
					}
				}
	}
	//echo $status;
	$stat=array($status,$comment);
	   return $stat;
	    
	}
public function StmesterComplete($sid,$batch,$semester,$program,$year)
{
	$sql="SELECT `Complete` FROM `student_result_log` WHERE `Program`='$program' AND  `StudentID`='$sid' AND `Semester`='$semester' AND `Batch`='$batch' AND `Year`='$year'";
	$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	$comp=mysqli_fetch_row($res);
	if($comp[0]=='Yes')
	return true;
	else
	return false;
	}
public function TotalECTSRgisteredFor($sid,$batch,$semester,$program,$year)
	{
		$sql="SELECT SUM(`course`.`ECTS`) FROM `student_course_enrollment`,`course` WHERE `student_course_enrollment`.`BatchID`='$batch' and `student_course_enrollment`.`SemesterID`='$semester' and `student_course_enrollment`.`StudyProgramID`='$program' and `student_course_enrollment`.`StuedentID`='$sid'  and 
`student_course_enrollment`.`Approved`='Yes' and 
`student_course_enrollment`.`CourseID`=`course`.`id` and
`student_course_enrollment`.`Year`='$year'
";
		$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
		$row=mysqli_fetch_row($res);
		return($row[0]);
	
	}
public function CheckStatusForRegistration($sid,$batch,$semester,$program)
{
	if($semester==1){
	$batch--;
	$semester=2;}
	else if($semester==2)
	$semester--;
	$sql="SELECT `Status` FROM `student_cgpa_log` WHERE `Batch`='$batch' AND `Semester`='$semester' AND `Program`='$program' AND `StudentID`='$sid'";
	//echo $sql;
	$res=mysqli_query($GLOBALS['link'],$sql)or die(mysqli_error($GLOBALS['link']));
	$row=mysqli_fetch_array($res);
if($row['Status']=="Forced Withdrawal" || $row['Status']=="Dismissal")
	return true;
	else
	return false;
	}
   
	/*********************************************************/
   public function Establish_Status($batch,$semester,$sid)
   {
	   if($this->checkNG_W_DO_I_NULL($batch,$semester,$sid)){
		$status="No Status";
			}
			else {
				//$act =null;
				if($act->checkIfAllCoursesRepeated())
			{
				if($act->getCGPA()>= 2.0 )
				{
					$status="Promoted";
				}
				else
					$status="Probation";
			}
			else
			{
				if($act->getTotalECTS()<= 26)
				{
					$status="No Status";
				}
				else if($act->getTotalECTS()>26 && $act->getTotalECTS()<=45)
				{
					if($act->getCGPA()< 1.5)
					{
						$status="Forced Withdrawal";
						if($act->checkPreviousFW())
							{
								$status="Dismissal";
							}
					}
					else if($act->getCGPA()>=1.5 && $act->getCGPA()<1.74)
					{
						$status="Warning";
					}
					else if($act->getCGPA()>=1.75)
					{
						$status="Promoted";
					}
				}
				else if($act->getTotalECTS()>45 && $act->getTotalECTS()<=72)
				{
					
					if($act->getCGPA()< 1.75)
					{
						$status="Forced Withdrawal";
						if($act->checkPreviousFW())
							{
								$status="Dismissal";
								break;
							}
					}
					else if($act->getCGPA()>=1.75 && $act->getCGPA()<=1.99)
					{
						$status="Warning";
					}
					else if($act->getCGPA()>=2.00)
					{
						$status="Promoted";
					}
				}
				else if($act->getTotalECTS()>72)
				{
					if($act->getPSGPA()<1.75 || $act->getCGPA()<2.00)
					{
						if($act->getSGPA()<1.75 || $act->getCGPA()<2.00)
						{
							$status="Forced Withdrawal";
							if($act->checkPreviousFW())
							{
								$status="Dismissal";
								break;
							}
						}
						else if($act->getSGPA()>=1.75 || $act->getCGPA()>=2.00)
						{
							$status="Promoted";
						}
					}
					else if($act->getPSGPA()>=1.75 || $act->getCGPA()>=2.00)
					{
						if($act->getSGPA()>=1.75 || $act->getCGPA()>=2.00)
						{
							$status="Promoted";
						}
						else if($act->getSGPA()<=1.75 || $act->getCGPA()<=2.00)
						{
							$status="Warning";
						}
					}
				}
			}
        }
	}
}//end of class
 ?>