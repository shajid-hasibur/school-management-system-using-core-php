<?php
session_start();
include('configuration/connection.php');
// include('authentication.php');

if (isset($_POST['login_btn'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$encryptPass = md5($password);

	$login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$encryptPass' LIMIT 1";
	$login_query_run = mysqli_query($conn,$login_query);

	if (mysqli_num_rows($login_query_run) > 0) {
		foreach($login_query_run as $key => $value){
			$user_id = $value['id'];
			$user_name = $value['name'];
			$user_phone = $value['phone'];
			$user_email = $value['email'];

			$_SESSION['auth'] = true;
			$_SESSION['auth_user'] = [
				'user_id' => $user_id,
				'user_name' => $user_name,
				'user_phone' => $user_phone,
				'user_email' => $user_email
			];
			$_SESSION['status'] = "Successfully logged in";
			header("location: dashboard.php");
		}
	}else{
		$_SESSION['status'] = "Invalid email or password";
		header("location: index.php");
	}

}else{
	$_SESSION['status'] = "Access denied!";
	header("location: index.php");
}

?>