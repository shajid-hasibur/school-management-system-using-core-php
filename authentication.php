<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();
// session_start();	
if (!isset($_SESSION['auth'])) {
	$_SESSION['auth_status'] = "Please login to access dashboard!";
	header("location: index.php");
}
?>
