<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form name="import_form" enctype="multipart/form-data">
<table width="555" border="0">
  <tr>
    <td>Import list from file</td>
    <td><input type="file" name="importfile">  
      <a href="Excel/examineeTemplate.xlsx">Download Excel Template</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="button" name="import" value="Import" onClick="ajaxPost('importlist.php?action=import','import_form','div_ajax_space');"></td>
  </tr>
</table>
</form>
<?php


@session_start();
require_once('classes/common.php');
$act=new Common();
if(isset($_POST['importfile']) && isset($_REQUEST['action'])){



set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'classes/PHPExcel/IOFactory.php';
	
//require_once('Spreadsheet/Excel/Reader/reader.php');

//$data = new Spreadsheet_Excel_Reader();
//$data->setOutputEncoding('CP1251');
$inputFileName=$_POST['importfile'];
//echo $file;


try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
//$data=array();
$sql="INSERT INTO `examinee`(`ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Sex`, `Enrollment_Level`, `E-mail`, `Password`, `Country`, `City`, `Telephone`, `Academic_Year`, `Study_Subject`, `Confirmation_Code`, `Approved`) VALUES ";//"([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18])";

$alphas = range('A', 'Z');
//$maxCol=0;

for($i=2;$i<=$arrayCount;$i++){
//$a = trim($allDataInSheet[$i]["A"]);
//$b = trim($allDataInSheet[$i]["B"]);
//$c = trim($allDataInSheet[$i]["C"]);
$sql.="(null,";
foreach($alphas as $l){
if($allDataInSheet[$i][$l]=="")
{break;}
//array_push($data,trim($allDataInSheet[$i][$l]));
$sql.="'".trim($allDataInSheet[$i][$l])."',";
}
$sql=$act->TrimLastComma($sql);
$sql.="),";

//$resI=mysqli_query($link,$sql)or die(mysqli_error($link));

//$data->read($file);
//ID 	First_Name 	Middle_Name 	Last_Name 	Sex 	Enrollment_Level 	E-mail 	Password 	Country 	City 	Telephone 	Academic_Year 	Study_Subject 	Confirmation_Code 	Approved 	Exam 	UserID 	Remark 
/*
for($x = 2; $x<=count($data->sheets[0]["cells"]); $x++) {
    $fname = $data->sheets[0]["cells"][$x][1];
	$mname= $data->sheets[0]["cells"][$x][2];
	$lname= $data->sheets[0]["cells"][$x][3];
	$sex= $data->sheets[0]["cells"][$x][4];
	$level= $data->sheets[0]["cells"][$x][5];
	$email= $data->sheets[0]["cells"][$x][6];
	$passowrd= $data->sheets[0]["cells"][$x][7];
	$country= $data->sheets[0]["cells"][$x][8];
	$tel= $data->sheets[0]["cells"][$x][9];
	$year= $data->sheets[0]["cells"][$x][10];
	$dept= $data->sheets[0]["cells"][$x][11];
	
    $extension = $data->sheets[0]["cells"][$x][2];
    $email = $data->sheets[0]["cells"][$x][3];
    $sql = "INSERT INTO examinee (`ID` ,`First_Name` ,`Middle_Name`,`Last_Name`,`Sex`,`Enrollment_Level`,`E-mail`,`Password`,`Country`,`City`,`Telephone`,`Academic_Year`,`Study_Subject`,`Confirmation_Code`,`Approved`,`Exam`,`UserID`,`Remark` ) 
        VALUES (NULL,
	,'$fname'
	,'$mname'
	,'$lname'
	,'$sex'
	,'$level'
	,'$email'
	,'$passowrd'
	,'$country'
	,'$tel'
	,'$year'
	,'$dept'
	NULL,NULL,NULL,NULL,NULL
		)";
    echo $sql."\n";
    $res=mysqli_query($link,$sql)or die(mysqli_error($link));
	if($res)
	echo"The list is successfully imported.";
}
*/
}
$sql=$act->TrimLastComma($sql);
//echo $sql;
$imp=mysqli_query($link,$sql) or die(mysqli_error($link));
if($imp)
echo"Import complete.";
}
?>
</body>
</html>