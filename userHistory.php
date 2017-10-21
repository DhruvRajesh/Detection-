
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
	$check="";

	$uID = $_SESSION['u_id'];
			//echo "this is the uID being printed out : ".$uID;

	if(isset($_SESSION['u_id'])){
				//echo $_SESSION['u_uid'].'!';
		$check="true";
		$conn = mysqli_connect("localhost","root","","loginSystem");
	}

	?>


	<!doctype html>
	<title>User History</title>
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
		    <link rel="stylesheet" href="css/main2.css">
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
		  					<a href="http://localhost/detection/userContent.php?"   class="btn btn-large" >Home</a> </div>
		  				</nav>
		  				<a href="#" class="nav-toggle">Menu<span></span></a> </div>


		  			</header>
		  			<!-- banner text -->
		  			<div class="container">
		  				<div class="col-md-10 col-md-offset-1">
		  					<div class="banner-text text-center">
		  						<h3 style="color: white">Document History</h3>
		  					</div>
		  				</div>
		  			</section>




		  			<!-- Document plagiarism detection section-->
		  			<section id="services" class="section intro">
		  				

		  				<table width="100%"  style="border-collapse: collapse;" >


		  					<tr>

		  						<th style="color: white; text-align: center; ">
		  							#No.
		  						</th>
		  						
		  						<th style="color: white; text-align: center; ">
		  							URL
		  						</th>
		  						<th style="color: white; text-align: center; ">
		  							Percentage %
		  						</th>
		  						<th style="color: white; text-align: center; "> 
		  							No. Of Copied Words
		  						</th>

		  						<th style="color: white; text-align: center;">
		  							Embeded Comparisons
		  						</th>
		  					</tr>

		  					<tr>
		  						<td width="5%" align="center">
		  							<?php
		  							$count= 1;
		  							$sqlDocID = "SELECT userID, docID, URL, Percents, NumberOfCopiedWords, EmbededComparisons FROM userHistory WHERE userID = '$uID'";
		  							$result = mysqli_query($conn,$sqlDocID);
		  							if(mysqli_num_rows($result)>0){
		  								while($row=mysqli_fetch_assoc($result)){
		  									//echo $row["userID"]."<br>"."<br>";
		  									echo $count++."<br>"."<br>";
		  								}
		  							}
		  							?>
		  						</td>
		  						
		  						<td width="40%" align="center">

		  							<?php
		  							$sqlDocID = "SELECT userID, docID, URL, Percents, NumberOfCopiedWords, EmbededComparisons FROM userHistory WHERE userID = '$uID'";
		  							$result = mysqli_query($conn,$sqlDocID);
		  							if(mysqli_num_rows($result)>0){
		  								while($row=mysqli_fetch_assoc($result)){
		  									echo $row["URL"]."<br>"."<br>";
		  								}
		  							}
		  							?>

		  						</td>

		  						<td width="8%" align="center">

		  							<?php
		  							$sqlDocID = "SELECT userID, docID, URL, Percents, NumberOfCopiedWords, EmbededComparisons FROM userHistory WHERE userID = '$uID'";
		  							$result = mysqli_query($conn,$sqlDocID);
		  							if(mysqli_num_rows($result)>0){
		  								while($row=mysqli_fetch_assoc($result)){
		  									echo $row["Percents"]."%"."<br>"."<br>";
		  								}
		  							}
		  							?>

		  						</td>
		  						<td width="10%" align="center">

		  							<?php
		  							$sqlDocID = "SELECT userID, docID, URL, Percents, NumberOfCopiedWords, EmbededComparisons FROM userHistory WHERE userID = '$uID'";
		  							$result = mysqli_query($conn,$sqlDocID);
		  							if(mysqli_num_rows($result)>0){
		  								while($row=mysqli_fetch_assoc($result)){
		  									echo $row["NumberOfCopiedWords"]."<br>"."<br>";
		  								}
		  							}
		  							?>

		  						</td>

		  						<td align="center" width="10%">

		  							<?php
		  							$sqlDocID = "SELECT userID, docID, URL, Percents, NumberOfCopiedWords, EmbededComparisons FROM userHistory WHERE userID = '$uID'";
		  							$result = mysqli_query($conn,$sqlDocID);
		  							if(mysqli_num_rows($result)>0){
		  								while($row=mysqli_fetch_assoc($result)){

		  									echo "<a style=color:blue target=_blank href=' ".$row["EmbededComparisons"]."'>Click link to see report</a> " ."<br>"."<br>";

		  								}
		  							}
		  							?>

		  						</td>

		  					</tr>



		  					<tr>
		  						<td>

		  							<?php

		    				/*
							if($check=="true"){
								//$conn = mysqli_connect("localhost","root","","loginSystem");

			
			$sqlTrial = "SELECT docID, documentName, userID FROM documents WHERE userID = '$uID'";
			$result1 = mysqli_query($conn,$sqlTrial);
			if(mysqli_num_rows($result1)>0){
				while($row=mysqli_fetch_assoc($result1)){
					echo "id: ".$row["docID"]. " Document name: ".$row["documentName"]." User ID: ".$row["userID"]. "<br>";
				}
			}
			////////////////////////////////////////////////////////////


								$sqlDocID = "SELECT userID, docID, URL, Percents, NumberOfCopiedWords, EmbededComparisons FROM userHistory WHERE userID = '$uID'";
								$result = mysqli_query($conn,$sqlDocID);


								
								if(mysqli_num_rows($result)>0){
								while($row=mysqli_fetch_assoc($result)){

								echo "id: ".$row["userID"]. " Doc ID ".$row["docID"]." URL: ".$row["URL"]. " Percents: ".$row["Percents"]. "NumberOfCopiedWords: ".$row["NumberOfCopiedWords"]. "EmbededComparisons: ".$row["EmbededComparisons"] . "<br>";
								$_SESSION['docID']=$row['docID'];
							}
						}
						else {
							echo "You have no history of documents";
							}
							$conn->close();
						}*/

						?>

					</td>
				</tr>
			</table>


			<br/>

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



