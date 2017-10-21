<?php
session_start();

if(isset($_POST['submit'])){

	include  'db.inc.php';

	$uid = mysqli_real_escape_string($conn,$_POST['uid']); 
	$pwd = mysqli_real_escape_string($conn,$_POST['pwd']); 


	//error handlers
	// check if inputs are empty

	if(empty($uid) || empty($pwd)){
		header("Location: http://localhost/detection/index.php?login=empty");
		exit();
	}else{
		$sql = "SELECT * FROM users WHERE user_uid ='$uid' OR user_email='$uid'";
		$result = mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);

		if($resultCheck < 1){
			header("Location: http://localhost/detection/index.php?login=error");
			exit();
		}else{
			if($row = mysqli_fetch_assoc($result)){
				//echo $row['user_uid'];
				//de-hashing the password
				$hashedPwdCheck = password_verify($pwd,$row['user_pwd']);
				if($hashedPwdCheck == false){
					header("Location: http://localhost/detection/index.php?login=Please check your username or password");
					exit();
				}elseif ($hashedPwdCheck == true){
					// login in the user in here
					$_SESSION['u_id']=$row['user_id'];
					$_SESSION['u_email']=$row['user_email'];
					$_SESSION['u_uid']=$row['user_uid'];
					header("Location: http://localhost/detection/userContent.php?login=success");
					exit();
				}
			}
		}
	}
}else{
		header("Location: http://localhost/detection/index.php?login=error");
		exit();
	}


