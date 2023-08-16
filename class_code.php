<?php
session_start();
include('configuration/connection.php');
if (isset($_POST['btn-save'])) {
	$class = $_POST['name'];
	// echo $class;
	// date_default_timezone_set('Asia/Dhaka');
	// $timestamp = date('Y-m-d H:i:s');
	// echo $timestamp;
	// $exist_class_query = "SELECT name FROM classes WHERE name='$class' LIMIT 1";
	// $exist_class_query_run = mysqli_query($conn,$exist_class_query);

	// $row = mysqli_num_rows($exist_class_query_run);

	// if ($row != 0) {
	// 	$_SESSION['unique-class'] = "This class already taken";
	// 	header("location: create_student_class.php");
	// }
	if(empty($class)) {
		$_SESSION['validation'] = "Please give a class before submit";
		header("location: create_student_class.php");
	}else{
		try{
			$query = "INSERT INTO classes (name) VALUES ('$class')";
			$query_run = mysqli_query($conn,$query);
			$_SESSION['status'] = "Class saved successfully";
			header("location: student_class.php");
		}catch(mysqli_sql_exception $e){
			$e->getMessage();
			header("location: create_student_class.php");
			$_SESSION['unique-class'] = "This class already taken";
		}
	}
}

if (isset($_POST['btn-update'])) {
		$class = $_POST['name'];
		$class_id = $_POST['class_id'];

		$url = 'edit_class_page.php?class_id='.$class_id;
		// print_r($url);
		

		// $exist_class_query = "SELECT name FROM classes WHERE name='$class' LIMIT 1";
		// $exist_class_query_run = mysqli_query($conn,$exist_class_query);
		// $row = mysqli_num_rows($exist_class_query_run);

		if(empty($class)) {
			$_SESSION['validation'] = "Please give a class before submit";
			header("location: $url");
		}else{
			try{
				$query = "UPDATE classes SET name='$class' WHERE id='$class_id'";
				$query_run = mysqli_query($conn,$query);
				$_SESSION['status'] = "Class updated successfully";
				header("location: student_class.php");
			}catch(mysqli_sql_exception $e){
				$e->getMessage();
				header("location: $url");
				$_SESSION['unique-class'] = "This class already taken";
			}
		}
	}

	if(isset($_POST['deleteClassBtn'])){
		$classId = $_POST['delete_id'];
		
		$check_usage_query = "SELECT COUNT(*) AS usage_count FROM assign_students WHERE class_id = '$classId'";
		$check_usage_result = mysqli_query($conn, $check_usage_query);
		if ($check_usage_result) {
			$usage_count = mysqli_fetch_assoc($check_usage_result)['usage_count'];
			if ($usage_count > 0) {
				$_SESSION['notification'] = "Class deletion failed! This class is in use cannot be deleted.";
				header("location: student_class.php");
			} else {
				$query = "DELETE FROM Classes WHERE id='$classId'";
				$query_run = mysqli_query($conn,$query);
				if ($query_run) {
					$_SESSION['SuccessMessage'] = "Class deleted successfully.";
					header("location: student_class.php");
				} else {
					$_SESSION['notification'] = "Something went wrong!";
					header("location: student_class.php");
				}
			}
		}
	}
?>
