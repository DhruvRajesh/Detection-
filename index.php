
  <!-- 
     This template is taken from MIT open source ware 
     http://opensource.org/licenses/MIT
-->
<!--
  The template has not been made by Dhurv Tekchandani (5302109)
  The contents insde the temlate has been modified to match the desired output for the assignment.

  All the back end coding for PHP and SQL is my personal work.
  Changes in the original HTML & CSS files have been made to alter the original webiste for the assignment
-->

<?php
  session_start();

?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login / Register For COGNAC</title>
  
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="cotn_principal">
<div class="cont_centrar">

  <div class="cont_login">
<div class="cont_info_log_sign_up">
      <div class="col_md_login">
<div class="cont_ba_opcitiy">
        <!--Asking user to login -->
        <h2>LOGIN</h2>  
  <p>Sign into COGNAC!</p> 
  <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
  </div>
  </div>
<div class="col_md_sign_up">
<div class="cont_ba_opcitiy">
  <h2>REGISTER</h2>

   <!--Asking user to register -->
  <p>Register here!</p>

  <button class="btn_sign_up" onclick="cambiar_sign_up()">REGISTER</button>
</div>
  </div>
       </div>

    
    <div class="cont_back_info">
       <div class="cont_img_back_grey">
       <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d" alt="" />
       </div>
    </div>


<div class="cont_forms" >
    <div class="cont_img_back_">
       <img src="https://images.unsplash.com/42/U7Fc1sy5SCUDIu4tlJY3_NY_by_PhilippHenzler_philmotion.de.jpg?ixlib=rb-0.3.5&q=50&fm=jpg&crop=entropy&s=7686972873678f32efaf2cd79671673d" alt="" />
       </div>

   <!--Seding the data from the user to login php -->
  <form action="includes/login.inc.php" method="POST">
    <div class="cont_form_login">
      <a href="#" onclick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
      <h2>LOGIN</h2>
      <input type="text" name="uid" placeholder="Username / e-mail"/>
      <input type="password" name="pwd" placeholder="Password" />
      <button type="submit" name="submit" class="btn_login" onclick="cambiar_login()">LOGIN</button>
    </div>
  </form>
  
  <!--Seding the data from the user to signup php -->
  <form action="includes/signup.inc.php" method="POST">
   <div class="cont_form_sign_up">
      <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
     <h2>REGISTER</h2>
     <input type="text" name="uid" placeholder="Username" />
     <input type="text" name="email" placeholder="E-mail" />
     <input type="password" name="pwd" placeholder="Password" />

     <button type="submit" name="submit" class="btn_sign_up" onclick="cambiar_sign_up()">REGISTER</button>
     
   </div>

  </form>
    </div>
    <h3 style="color: red">  <?php echo@$_GET['login']; ?>  </h3>
  </div>
 </div>

</div>
  
    <script  src="js/index.js"></script>

</body>
</html>
