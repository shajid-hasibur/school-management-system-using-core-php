<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phpschool";

//connection

$conn = mysqli_connect("$host","$username","$password","$database");

//check connection

if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
}

?>