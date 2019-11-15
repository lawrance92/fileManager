<?php $pageid = "home"; $title = "Dashboard"; include('header.php'); ?>

<?php
if ($_SESSION['user_type'] == "admin") {
	include('bossmenu.php');
	include('bossdash.php');
}
else if ($_SESSION['user_type'] == "sales")
{
	include('salesmenu.php');
	include('salesdash.php');
}
else if ($_SESSION['user_type'] == "inventory")
{
	include('inventorymenu.php');
	include('inventorydash.php');
}
?>

<?php include('footer.php'); ?>