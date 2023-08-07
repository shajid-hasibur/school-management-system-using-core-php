<?php
session_start();
require('configuration/connection.php');

if(isset($_POST['btn-save']))

    $sname = $_POST['name'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $contact = $_POST['contact'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $dob = $_POST['dob'];
    $discount = $_POST['discount'];
    $year_id = $_POST['year_id'];
    $class_id = $_POST['class_id'];
    $group_id = $_POST['group_id'];
    $section_id = $_POST['section_id'];
    $email = $_POST['email'];
    $sphoto = $_POST['sphoto'];

    
?>