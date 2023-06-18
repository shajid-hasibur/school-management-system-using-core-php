<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phpschool";

//connection

$conn = mysqli_connect("$host","$username","$password","$database");

//check connection

if(!$conn){
	header('location: ../errors/database.php');
	die();
}
// else{
// 	echo "database connection established";
// }
?>