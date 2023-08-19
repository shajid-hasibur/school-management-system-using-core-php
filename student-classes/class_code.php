<?php
session_start();
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');

if (isset($_POST['btn-save'])) {
	$class = $_POST['name'];
	
	if(empty($class)) {
		$_SESSION['validation'] = "Please give a class before submit";
		header("location: create_student_class.php");
	}else{
		try{
			$query = "INSERT INTO classes (name) VALUES ('$class')";
			$query_run = mysqli_query($conn,$query);
			$_SESSION['SuccessMessage'] = "Class saved successfully";
			header("location: student_class.php");
		}catch(mysqli_sql_exception $e){
			$e->getMessage();
			header("location: create_student_class.php");
			$_SESSION['validation'] = "This class already taken";
		}
	}
}

if (isset($_POST['btn-update'])) {
		$class = $_POST['name'];
		$class_id = $_POST['class_id'];

		$url = 'edit_class_page.php?class_id='.$class_id;

		if(empty($class)) {
			$_SESSION['validation'] = "Please give a class before submit";
			header("location: $url");
		}else{
			try{
				$query = "UPDATE classes SET name='$class' WHERE id='$class_id'";
				$query_run = mysqli_query($conn,$query);
				$_SESSION['SuccessMessage'] = "Class updated successfully";
				header("location: student_class.php");
			}catch(mysqli_sql_exception $e){
				$e->getMessage();
				header("location: $url");
				$_SESSION['validation'] = "This class already taken";
			}
		}
	}

	if(isset($_POST['deleteClassBtn'])){
		$classId = $_POST['delete_id'];
		
		$check_usage_query = "SELECT COUNT(*) AS usage_count FROM assign_students WHERE class_id = '$classId'";
		$check_usage_query2 = "SELECT COUNT(*) AS usage_count FROM fee_category_amounts WHERE class_id = '$classId'";
		$check_usage_result = mysqli_query($conn, $check_usage_query);
		$check_usage_result2 = mysqli_query($conn, $check_usage_query2);
		if ($check_usage_result && $check_usage_result2) {
			$usage_count = mysqli_fetch_assoc($check_usage_result)['usage_count'];
			$usage_count2 = mysqli_fetch_assoc($check_usage_result2)['usage_count'];
			if ($usage_count > 0 || $usage_count2 > 0) {
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
