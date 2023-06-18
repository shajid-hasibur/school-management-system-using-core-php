<?php
session_start();
include('configuration/connection.php');
if (isset($_POST['btn-save'])) {
    $section = $_POST['name'];
    
    if(empty($section)){
        $_SESSION['validation'] = "Please give a section before submit";
		header("location: create_student_section.php");
    }else{
        try{
            $query = "INSERT INTO sections(name) VALUES('$section')";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['status'] = "Section saved successfully";
			header("location: student_section.php");
        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            header("location: create_student_section.php");
			$_SESSION['unique-section'] = "This section already taken";
        }
    }
}

if(isset($_POST['btn-update'])){
    $sectionId = $_POST['section_id'];
    $section = $_POST['name'];
    $url = 'edit_student_section.php?section_id='. $sectionId;

    if(empty($section)){
        $_SESSION['validation'] = "Please give a section before submit";
		header("location: $url");
    }else{
        try{
            $query = "UPDATE sections SET name='$section' WHERE id='$sectionId' ";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['status'] = "Section updated successfully";
			header("location: student_section.php");

        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            header("location: $url");
			$_SESSION['unique-section'] = "This section already taken";
        }
    }
}

if(isset($_POST['deleteSectionBtn'])){
    $delete_id = $_POST['delete_id'];
    
    $query = "DELETE FROM sections WHERE id='$delete_id' ";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['status'] = "Section deleted successfully";
		header("location: student_section.php");
    }

}
?>