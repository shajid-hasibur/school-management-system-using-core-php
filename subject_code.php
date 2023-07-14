<?php
session_start();
include('configuration/connection.php');
if(isset($_POST['btn-save'])){
    $subject = $_POST['name'];
    $status = $_POST['status'];
    
    if(empty($subject)){
        $_SESSION['validation'] = "Please give a subject before submit";
		header("location: create_subject.php");
    }else{
        try{
            $query = "INSERT INTO subjects (name,status) VALUES ('$subject','$status')";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['SuccessMessage'] = "Subject created successfully";
            header("location: subject.php");
        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['validation'] = "This subject already taken! Please try another.";
            header("location: create_subject.php");
        }
    }
}

if(isset($_POST['deleteSubBtn'])){
    $subject_id = $_POST['delete_id'];
    
    $query = "DELETE FROM subjects WHERE id='$subject_id'";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['SuccessMessage'] = "Subject Deleted Successfully";
        header("location: subject.php");
    }
}

if(isset($_POST['btn-update'])){
    $subject = $_POST['name'];
    $subject_id = $_POST['subject_id'];
    $status = $_POST['status'];
    $url = 'edit_subject.php?subject_id='.$subject_id;
    if(empty($subject)){
        $_SESSION['validation'] = "Please give a subject before submit!";
        header("location: $url");
    }else{
        try{
            $query = "UPDATE subjects SET name='$subject', status='$status' WHERE id='$subject_id'";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['SuccessMessage'] = "Subject Updated Successfully!";
            header("location: subject.php");
        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['validation'] = "This subject already taken! Please try another.";
            header("location: $url");
        }
    }
}
?>