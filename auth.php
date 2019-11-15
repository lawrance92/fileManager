<?php
require_once('config.php');
// Starting Session
if(!isset($_SESSION)) {
	session_start();
}

$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {
		// To protect MySQL injection for Security purpose
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']);

		// SQL query to fetch information of registerd users and finds user match.
		$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['active'];

		$count = mysqli_num_rows($result);

		// Checking for successful login
		if ($count == 1) {
			// Initializing Session
			//session_register("myusername");
			//$loggeduser = mysql_fetch_array($result);
			$_SESSION['login_user']=$username;
			$_SESSION['user_id']=$row["userid"];
			$_SESSION['user_type']=$row["type"];
			$_SESSION['user_name']=$row["name"];
			header('Location: index.php'); // Redirecting To Home Page
		} else {
			$error = "Username or Password is Invalid";
		}
	}
}
?>