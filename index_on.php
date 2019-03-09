<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Addis Ababa Univeristy Graduate Studies Competence Assessment System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
        <style type="text/css">
		.custom-combo
		{
			border:1px solid #6CC;
			padding:6px;
			background:none;
			
			}
			
		</style>
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top" id="banner" align="center">
              <div class="clr"><img src="images/templatemo_header.jpg" width="980" height="156"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1></h1>
				<nav class="codrops-demos"></nav>
            </header>
            <section>				
                <div id="container_demo" >
                    
                  <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="Login_wrapper">
                        <div id="login" class="animate form">
                          <?php 
                          @session_start();
require_once('classes/common.php');
$act=new Common();
                          $setting_q="SELECT `turn_off_system` , `enable_register` , `System_auto_stop_exam_by_countdown`
FROM `settings`
WHERE `ID` =1";
$set_res=mysqli_query($link,$setting_q) or die("something went wrong ". mysql_errno());
$set_row=mysql_fetch_assoc($set_res);

                          if($set_row['turn_off_system']=='Yes'){?>
                            <form  action="inside2.php" autocomplete="on" method="post"> 
                                <h1><img src="images/login.png" width="48" height="48">Log in</h1> 
                                <p> 
                                  <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                
                              <p>Role <br>
                              <select name="roll" class="custom-combo">
                             
                              <option selected="selected">Examinee</option> 
                              <option>Administrator</option>
                              <option>Instructor</option>
                              <option>Reviewer</option>
                                  <option>Invigilator</option>
                              </select>
                              </p>
                              <p class="keeplogin"> 
									
								</p>
                              
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
                <?php if($set_row['enable_register']=='Yes') {?>
                               <p class="change_link">
									Do not have an account?
									<a href="register.php" >Register</a>
               
								</p> <?php }?>
                            </form>

<?php }
else{
  ?>
<h1>Sorry, System is temporarily OFF. 
                    Please wait until it will be turned on.</h1>
  <?php
}
?>
                            <ol>
                                <li></li>
                            </ol>
                        </div>

                        
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>