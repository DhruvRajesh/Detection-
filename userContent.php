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
	//transfering data once the user has logged in
	session_start();
?>

<!doctype html>
<title>COGNAC user</title>
<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>COGNAC</title>
<!-- All style sheets required for:
      navigation animation
      style and css files
      fonts 
-->
<link rel="stylesheet" href="css/min.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/main1.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/font-icon.css">
<link rel="stylesheet" href="css/animate.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
<!-- header section -->
<section class="banner" role="banner" >
  <header id="header">
    <div class="header-content clearfix"> <a class="logo" href="index.html"></a>
      <nav class="navigation" role="navigation">
      	
      <form  id="comp" action="includes/logOut.inc.php" method="POST">
		<button name="submit" type="submit" class="btn btn-large">Log out</button>
	</form>
   
      </nav>
      <a href="#" class="nav-toggle">Menu<span></span></a> </div>
      	
  </header>
  <!-- banner text -->
  <div class="container">
    <div class="col-md-10 col-md-offset-1">
      <div class="banner-text text-center">
      		<?php
      			// using session to transfer data & display user name 
				if(isset($_SESSION['u_id'])){
				echo '<h1>Hey <br/>';
				echo $_SESSION['u_uid'].'!';
			}
			?>
        <h3 style="color: white">Welcome to COGNAC</h3>
        <a href="http://localhost/detection/userHistory.php"   class="btn btn-large" >User History</a> </div>
    </div>
  </div>
</section>

  
<!-- Document plagiarism detection section-->
<section id="comapre" class="section intro">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 text-center">
      <p>Upload your document below and compare it with sources all around the world! <br/>
      		(ext supported: .pdf, .txt, .docx)
      </p>
     
 	<form action="createDocID.php"  method="POST" target="_blank"  style=" display: inline-block; text-align: center;">
        <input type="file" name="image" align="center"><br/>
        <input type="submit" name="Submit" class="btn btn-large" value="Compare">

        <br/>
    <!-- Languages available-->
  <p>Select your target language to compare against</p>
  <select name="Lang" >
   
    <option value="en">English</option>
    <option value="ru">Russian</option>
    <option value="de">German</option>
    <option value="pt">Portuguese</option>
    <option value="hi">Hindi</option>
    <option value="ko">Korean</option>
    <option value="he">Hebrew</option>
    <option value="es">Spanish</option>
    <option value="ja">Japanese</option>
    <option value="fr">French</option>
    <option value="it">Italian</option>
    <option value="sv">Swedish</option>
  </select>
  </form>
  <h3 style="color: red">  <?php echo@$_GET['error']; ?>  </h3>
    <br/>
      
    </div>
  </div>
</section>



	
<section id="comapre" >
</section>
<!-- Footer section -->
<footer class="footer">
  <div class="footer-top section">
    <div class="container">
      <div class="row">
        <div class="footer-col col-md-6">
          <h5>Our Office Location</h5>
          <p>Robsons Road Wollongong 2500 Australia.<br>
            support@cognac.com</p>
          <p>Copyright © 2017 COGNAC Inc. All Rights Reserved. Made with <i class="fa fa-heart pulse"></i> by <a href="http://www.designstub.com/">COGNAC</a></p>
        </div>
        <div class="footer-col col-md-3">
          <h5>Services We Offer</h5>
          <p>
          <ul>
            <li><a href="#">Businesses</a></li>
            <li><a href="#">Education</a></li>
            <li><a href="#">Social Media</a></li>
          </ul>
          </p>
        </div>
        <div class="footer-col col-md-3">
          <h5>Share with Love</h5>
          <ul class="footer-share">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- footer top --> 
  
</footer>
<!-- Footer section --> 
<!-- JS FILES --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="js/min.js"></script> 
<script src="js/jquery.flexslider-min.js"></script> 
<script src="js/jquery.fancybox.pack.js"></script> 
<script src="js/retina.min.js"></script> 
<script src="js/modernizr.js"></script> 
<script src="js/main.js"></script> 
<script type="text/javascript" src="js/jquery.contact.js"></script>
</body>
</html>

