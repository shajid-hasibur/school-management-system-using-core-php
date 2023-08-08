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

    $errors = [];

    if(empty($sname)){
        $errors['name'] = "Student name is required!";
    }
    if(empty($fname)){
        $errors['fname'] = "Father's name is required!";
    }
    if(empty($mname)){
        $errors['mname'] = "Mother's name is required!";
    }
    if(empty($contact)){
        $errors['contact'] = "Contact is required!";
    }
    if(empty($address1)){
        $errors['address1'] = "Present address is required!";
    }
    if(empty($address2)){
        $errors['address2'] = "Permanent address is required!";
    }
    if(empty($gender)){
        $errors['gender'] = "Gender is required!";
    }
    if(empty($religion)){
        $errors['religion'] = "Religion is required!";
    }
    if(empty($dob)){
        $errors['dob'] = "Date of birth is required!";
    }
    if(empty($discount)){
        $errors['discount'] = "Discount is required!";
    }
    if(empty($year_id)){
        $errors['year_id'] = "Year is required!";
    }
    if(empty($class_id)){
        $errors['class_id'] = "Class is required!";
    }
    if(empty($group_id)){
        $errors['group_id'] = "Group is required!";
    }
    if(empty($section_id)){
        $errors['section_id'] = "Section is required!";
    }
    if(empty($email)){
        $errors['email'] = "Email is required!";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email-format'] = "Not a valid email";
    }
    if(empty($sphoto)){
        $errors['sphoto'] = "Student photo is required!";
    }
    $_SESSION['error-text']=$errors;
    if(!$_SESSION['error-text'] == ''){
        header("location: student_registration.php");
    }
    
    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
    //making a associative array for all the errors
    // for ($i=0; $i < count($errors); $i++) { 
        
    // }
?>