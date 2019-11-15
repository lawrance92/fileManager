<?php
require_once('config.php');
session_start();// Starting Session
if(isset($_SESSION['login_user'])) {
	// Storing Session
	$user_check=$_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	$ses_sql = mysqli_query($db,"SELECT username FROM users WHERE username='".$user_check."'");
	//$ses_sql=mysql_query("select username from users where username='$user_check'", $connection);
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session =$row['username'];
}
if(!isset($login_session)){
	//mysql_close($connection); // Closing Connection
	include('login.php'); // Redirecting To Home Page
} else {
	include('dashboard.php');
}
?>