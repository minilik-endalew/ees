<?php 
@session_start();
require_once('classes/common.php');
$act=new Common();
//ajax_load(where,what)
//ajaxPost(strURL,formname,responsediv)
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login and Registration Form with HTML5 and CSS3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
        <script type="text/javascript">
function select_first()
{
	var form=document.getElementById('form_multiple_delete');
	for(i=0;i<form.length;i++){
	if(document.getElementsByName('check_mul_del[]').item(i).checked==false)
	{
		alert("you must select atleast one question");
		return false;
		}
}
}
function hideMenu(){document.getElementById('div_examinee_menu').style.display=none;}
<!--
function Popup(n,t) {
window.open("populate_question.php?amount="+n +"&type="+t, "Populate question", 
"status = 1, height = 500, width =700, resizable = 0 ,screenX=300 ,screenY=30" )
}
 
</script>

<link rel="stylesheet" href="button.css" />
<style>
.loading{
	top:200px;
	left:45%;
	position: fixed;
    width: 150px;
   
    vertical-align: middle;
    
    text-align: center;
	}
</style>
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
              <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>&nbsp;</h1>
				<nav class="codrops-demos"></nav>
            </header>
            <section>				
                <div id="container_demo" >
                    
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                  <div id="wrapper">
                    <div id="login" class="animate form">
                            
                      </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>