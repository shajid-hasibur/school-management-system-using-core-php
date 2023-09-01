<?php
session_start();
include('configuration/connection.php');

if (isset($_POST['login_btn'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Retrieve the hashed password from the database based on the email
	$login_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
	$login_query_run = mysqli_query($conn, $login_query);

	if (mysqli_num_rows($login_query_run) > 0) {
		$user_data = mysqli_fetch_assoc($login_query_run);

		$storedHashedPassword = $user_data['password'];

		// Verify the entered password against the stored hash
		if (password_verify($password, $storedHashedPassword)) {
			$user_id = $user_data['id'];
			$user_name = $user_data['name'];
			$user_phone = $user_data['phone'];
			$user_email = $user_data['email'];
			$user_role = $user_data['usertype'];

			$_SESSION['auth'] = true;
			$_SESSION['auth_user'] = [
				'user_id' => $user_id,
				'user_name' => $user_name,
				'user_phone' => $user_phone,
				'user_email' => $user_email,
				'user_role' => $user_role
			];
			$_SESSION['status'] = "Welcome to dashboard";
			header("location: dashboard.php");
		} else {
			$_SESSION['status'] = "Invalid email or password";
			header("location: index.php");
		}
	} else {
		$_SESSION['status'] = "Invalid email or password";
		header("location: index.php");
	}
} else {
	$_SESSION['status'] = "Access denied!";
	header("location: index.php");
}
?>
