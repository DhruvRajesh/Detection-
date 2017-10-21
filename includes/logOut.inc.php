<?php

if(isset($_POST['submit'])){
	session_start();
	session_unset();
	session_destroy();
	header("Location: http://localhost/detection/cognac.html");
	exit();

}