<?php
session_start();
include('configuration/connection.php');
if (isset($_POST['btn-save'])) {
	$year = $_POST['name'];
	
	// print_r($year);
	// date_default_timezone_set('Asia/Dhaka');
	// $timestamp = date('Y-m-d H:i:s');
	// echo $timestamp;
	// $exist_year_query = "SELECT name FROM years WHERE name='$year' LIMIT 1";
	// $exist_year_query_run = mysqli_query($conn,$exist_year_query);

	// $row = mysqli_num_rows($exist_year_query_run);

	// if ($row != 0) {
	// 	$_SESSION['unique-year'] = "This year already taken";
	// 	header("location: create_student_year.php");
	// }
	if(empty($year)) {
		$_SESSION['validation'] = "Please give a year before submit";
		header("location: create_student_year.php");
	}else{
		try{
			$query = "INSERT INTO years (name) VALUES ('$year')";
			$query_run = mysqli_query($conn,$query);
			$_SESSION['status'] = "Year saved successfully";
			header("location: student-year.php");
		}catch(mysqli_sql_exception $e){
			$e->getMessage();
			header("location: create_student_year.php");
			$_SESSION['unique-year'] = "This year already taken";
		}
	}
}

if(isset($_POST['deleteYearBtn'])){
	$yearId = $_POST['delete_id'];

	$check_usage_query = "SELECT COUNT(*) AS usage_count FROM assign_students WHERE year_id = '$yearId'";
	$check_usage_result = mysqli_query($conn,$check_usage_query);
	if($check_usage_result){
		$usage_count = mysqli_fetch_assoc($check_usage_result)['usage_count'];
		if($usage_count > 0){
			$_SESSION['notification'] = "Year deletion failed. This year is in use cannot be deleted!";
			header("location: student-year.php");
		}else{
			$query = "DELETE FROM years WHERE id='$yearId'";
			$query_run = mysqli_query($conn,$query);
			if($query_run){
				$_SESSION['SuccessMessage'] = "Year deleted successfully";
				header("location: student-year.php");
			}else{
				$_SESSION['notification'] = "Something went wrong!";
				header("location: student-year.php");
			}
		}
	}
}
?>