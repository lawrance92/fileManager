<?php
require_once('config.php');
if(!isset($_SESSION)){
    session_start();
}

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db, "select * from users where username='$user_check'");

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['username'];

if (!isset($_SESSION['login_user'])) {
    header("Location: index.php");
}
?>