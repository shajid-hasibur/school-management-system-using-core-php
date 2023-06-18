<?php
session_start();
include('authentication.php');

if (isset($_POST['logout_btn'])) {
	session_destroy();
	unset($_SESSION['auth']);
	unset($_SESSION['auth_user']);

	$_SESSION['status'] = "Logged out successfully";
	header("location: index.php");
	exit(0);
}
?>