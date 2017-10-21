<!--
  This code for SQL & PHP is my personal work 
-->

<?php
if(isset($_POST['submit'])){
	include_once 'db.inc.php';

	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$uid = mysqli_real_escape_string($conn,$_POST['uid']);
	$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

	// error handlers

	//check for empty fields
	if(empty($email) || empty($uid) || empty($pwd)){
		header("Location: http://localhost/detection/index.php?login= Your email or password is empty");
		exit();
	}	else{
		//check if input characters are valid
		if(!preg_match("/^[a-zA-Z]*$/", $uid)){
			header("Location: index.php?signup=invalid");
			exit();
		}else{
			//check if email is valid
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: http://localhost/detection/index.php?signup=email");
				exit();
			}else{
				$sql = "SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck > 0){
					header("Location: http://localhost/detection/index.php?login=This user ID has been taken, please try another name.");
					exit();
				}else{
					//hasing passward by using php built int hash function
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//insert the user into the database
					$sql ="INSERT INTO users (user_uid,user_email,user_pwd) VALUES ('$uid','$email','$hashedPwd');";
					mysqli_query($conn,$sql);
					header("Location: http://localhost/detection/index.php?login=You have been registered, Please sign in now!");
					exit();
				}
			}
		}
	}


}else{
	header("Location: http://localhost/detection/index.php?signup=error");
	exit();
}