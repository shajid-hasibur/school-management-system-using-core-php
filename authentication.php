<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();

if (!isset($_SESSION['auth'])) {
	$_SESSION['auth_status'] = "Please login to access dashboard!";
	header("location: index.php");
}

// elseif($_SESSION['user_role'] != 1){
// 	header("location: access_denied.php");
// }
?>
