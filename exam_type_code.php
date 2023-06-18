<?php
session_start();
include('configuration/connection.php');

if (isset($_POST['btn-save'])) {
    $exam = $_POST['name'];

    if(empty($exam)){
        $_SESSION['validation'] = "Please give a exam type before submit";
		header("location: create_exam_type.php");
    }else{
        try{
            $query = "INSERT INTO exam_types(name) VALUES('$exam')";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['status'] = "Exam type added successfully";
			header("location: exam_type.php");
        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['unique-exam'] = "This exam type already taken";
            header("location: create_exam_type.php");
        }
    }
}

if(isset($_POST['btn-update'])){
    $exam_type_id = $_POST['exam_type_id'];
    $exam_name = $_POST['name'];
    $url = 'edit_exam_type.php?exam_type_id='. $exam_type_id;
    
    if(empty($exam_name)){
        $_SESSION['validation'] = "Please give a exam type before submit";
		header("location: $url");
    }else{
        try{
            $query = "UPDATE exam_types SET name='$exam_name' WHERE id='$exam_type_id' ";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['status'] = "Exam type updated successfully";
			header("location: exam_type.php");

        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['unique-exam'] = "This exam type already taken";
            header("location: $url");
        }
    }
}

if(isset($_POST['deleteExamBtn'])){
    $delete_id = $_POST['delete_id'];

    $query = "DELETE FROM exam_types WHERE id='$delete_id' ";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['status'] = "Exam type deleted successfully";
		header("location: exam_type.php");
    }else{
        $_SESSION['status'] = "Exam type deletion failed";
        header("location: exam_type.php");
    }
}
?>