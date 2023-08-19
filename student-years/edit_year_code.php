<?php
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');
session_start();

	if (isset($_POST['btn-update'])) {
		$year = $_POST['name'];
		$year_id = $_POST['year_id'];

		$url = 'edit_year_page.php?year_id='.$year_id;
		
		if(empty($year)) {
			$_SESSION['validation'] = "Please give a year before submit";
			header("location: $url");
		}else{
			try{
				$query = "UPDATE years SET name='$year' WHERE id='$year_id'";
				$query_run = mysqli_query($conn,$query);
				$_SESSION['status'] = "Year updated successfully";
				header("location: student-year.php");
			}catch(mysqli_sql_exception $e){
				$e->getMessage();
				$_SESSION['unique-year'] = "This year already taken";
				header("location: $url");
			}
		}

	}
?>
