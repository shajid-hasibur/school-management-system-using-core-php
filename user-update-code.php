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
		$usertype = $_POST['usertype'];

		if (empty($_POST['name'])) {
			$_SESSION['name'] = "Name field is required";
			$nameErr = 1;
		}
		if (empty($_POST['phone'])) {
			$_SESSION['phone'] = "Phone field is required";
			$phoneErr = 1;
		}
		if(empty($_POST['email'])){
			$_SESSION['email'] = "Email field is required";
			$emailError = 1;
		}
		if(empty($_POST['password'])){
			$_SESSION['password'] = "Password is required";
			$passwordErr = 1;
		}
		if (empty($_POST['cpassword'])) {
			$_SESSION['cpassword'] = "confirm password is required";
			$cpasswordErr = 1;
		}
		if (empty($_POST['usertype'])) {
			$_SESSION['usertype'] = "Please select a usertype";
			$usertypeErr = 1;
		}
		$url = 'edit-user.php?user_id='.$user_id;

		$total = (int)$nameErr+(int)$phoneErr+(int)$emailError+(int)$passwordErr+(int)$cpasswordErr+(int)$usertypeErr;

		if($total != 0){
			header("location: $url");
		}else{
			if ($password == $cpassword) {
				$finalPass = password_hash($password, PASSWORD_DEFAULT);
			}else{
				$_SESSION['unmatch_pass'] = "Password does not match";
				header("location: $url");
			}
	
			if (isset($finalPass)) {
				$query = "UPDATE users SET name='$name',usertype='$usertype',phone='$phone',email='$email',password='$finalPass' WHERE id='$user_id' ";
	
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
	}
?>