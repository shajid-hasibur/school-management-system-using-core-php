<?php
session_start();
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');

if (isset($_POST['add_user'])) {
	$finalPass = '';
	$nameErr = $phoneErr = $emailError = $passwordErr = $cpassword = $usertype = '';
	// $name = $phone = $email = $password = $cpassword = '';

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
		$cpassword = 1;
	}
	if (empty($_POST['usertype'])) {
		$_SESSION['usertype'] = "Please select a usertype";
		$usertype = 1;
	}

	$total = (int)$nameErr+(int)$phoneErr+(int)$emailError+(int)$passwordErr+(int)$cpassword+(int)$usertype;


	
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$user_type = $_POST['usertype'];

	if ($password == $cpassword) {
		$finalPass = $password;
	}else{
		$_SESSION['unmatch_pass'] = "Password and confirm password does not match";
	}
	
	$encryptPass = password_hash($finalPass, PASSWORD_BCRYPT); 

	$check_mail_query = "SELECT email FROM users WHERE email='$email'";
	$check_mail_query_run = mysqli_query($conn,$check_mail_query);

	$record = mysqli_num_rows($check_mail_query_run);

	if ($record > 0) {
			$_SESSION['existing_mail'] = "This mail already taken!";
			// header("location: user_registration.php");
		}

	if ($total == '0' && $password == $cpassword && $record == '0') {

			$query = "INSERT INTO users (name,usertype,phone,email,password,status) VALUES('$name','$user_type','$phone','$email','$encryptPass','1')";
			$query_run = mysqli_query($conn,$query);

			if ($query_run) {
				$_SESSION['SuccessMessage'] = "New user created successfully";
				header("location: users.php");

			}else{
				$_SESSION['notification'] = "User registration failed";
				header("location: users.php");
			}
		
		
	}else{
		header("location: user_registration.php");
	}

	
}

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
		$url = 'edit_user.php?user_id='.$user_id;

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
					$_SESSION['SuccessMessage'] = "User record updated successfully";
					header("location: users.php");
				}else{
					$_SESSION['notification'] = "User update unsuccessful";
					header("location: users.php");
				}
			}
		}
	}


    if (isset($_POST['deleteUserBtn'])) {
        $userId = $_POST['delete_id'];
        $query = "DELETE FROM users WHERE id= '$userId' ";
        $query_run = mysqli_query($conn,$query);
    
        if ($query_run) {
            $_SESSION['SuccessMessage'] = "User deleted successfully";
            header("location: users.php");
            
        }else{
            $_SESSION['notification'] = "User deletion failed";
            header("location: users.php");
        }
    }    
?>