<?php
include('configuration/connection.php');
session_start();
	if (isset($_POST['update-btn'])) {

		$user_id = $_POST['user_id'];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];

		$url = 'edit-user.php?user_id='.$user_id;

		if ($password == $cpassword) {
			$finalPass = md5($password);
		}else{
			$_SESSION['unmatch_pass'] = "Password does not match";
			header("location: $url");
		}

		if (isset($finalPass)) {
			$query = "UPDATE users SET name='$name',phone='$phone',email='$email',password='$finalPass' WHERE id='$user_id' ";

			$query_run = mysqli_query($conn,$query);

			if ($query_run) {
				$_SESSION['status'] = "User updated successfully";
				header("location: registration.php");
			}else{
				$_SESSION['status'] = "User update unsuccessfull";
				header("location: edit-user.php");
			}
		}
	}
?>