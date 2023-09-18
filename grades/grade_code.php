<?php
session_start();
$basePath = $_SERVER['DOCUMENT_ROOT'];
require($basePath . '/PHP_SCHOOL/sms/admin/authorisation.php');
require($basePath . '/PHP_SCHOOL/sms/admin/configuration/database.php');
require($basePath . '/PHP_SCHOOL/sms/admin/includes/sessions.php');

//create grade code 

if(isset($_POST['btn-save'])){
    $grade_name = $_POST['grade_name'];
    $grade_point = $_POST['grade_point'];
    $start_mark = $_POST['start_mark'];
    $end_mark = $_POST['end_mark'];
    $start_point = $_POST['start_point'];
    $end_point = $_POST['end_point'];
    $remarks = $_POST['remarks'];
    
    $inputData = [
        'grade_name' => $grade_name,
        'grade_point' => $grade_point,
        'start_mark' => $start_mark,
        'end_mark' => $end_mark,
        'start_point' => $start_point,
        'end_point' => $end_point,
        'remarks' => $remarks,
    ];

    $validationRules = [
        'grade_name' => ['required'],
        'grade_point' => ['required', 'numeric'],
        'start_mark' => ['required', 'numeric'],
        'end_mark' => ['required', 'numeric'],
        'start_point' => ['required', 'numeric'],
        'end_point' => ['required', 'numeric'],
        'remarks' => ['required'],
    ];

    $errors = validateFields($inputData, $validationRules);
    $_SESSION['validate'] = $errors;
    if($errors != null){
        header("location: create_grade.php");
    }else{
        try{
            $database = new Database();
            $status = $database->insert('grades',$inputData);
            if($status){
                $_SESSION['SuccessMessage'] = "Grade created successfully";
                header("location: grades.php");
            }
        }catch(mysqli_sql_exception $e){
            $_SESSION['notification'] = $e->getMessage();
            header("location: grades.php");
        }
    }
}

if(isset($_POST['btn-update'])){
    
    $grade_name = $_POST['grade_name'];
    $grade_point = $_POST['grade_point'];
    $start_mark = $_POST['start_mark'];
    $end_mark = $_POST['end_mark'];
    $start_point = $_POST['start_point'];
    $end_point = $_POST['end_point'];
    $remarks = $_POST['remarks'];
    $id = $_POST['page_id'];
    $url = 'edit_grade.php?grade_id=' . $id;

    $inputData = [
        'grade_name' => $grade_name,
        'grade_point' => $grade_point,
        'start_mark' => $start_mark,
        'end_mark' => $end_mark,
        'start_point' => $start_point,
        'end_point' => $end_point,
        'remarks' => $remarks,
    ];

    $validationRules = [
        'grade_name' => ['required'],
        'grade_point' => ['required', 'numeric'],
        'start_mark' => ['required', 'numeric'],
        'end_mark' => ['required', 'numeric'],
        'start_point' => ['required', 'numeric'],
        'end_point' => ['required', 'numeric'],
        'remarks' => ['required'],
    ];

    $errors = validateFields($inputData, $validationRules);
    $_SESSION['validate'] = $errors;

    if($errors != null){
        header("location: $url");
    }else{
        try{
            $db = new Database();
            $status = $db->update("grades",$inputData,"id=$id");
            if($status){
                $_SESSION['SuccessMessage'] = "Grade updated successfully";
                header("location: grades.php");
            }
        }
        catch(mysqli_sql_exception $e){
            $_SESSION['notification'] = $e->getMessage();
            header("location: $url");
        }
    }
}

if(isset($_POST['btn-delete'])){
    $id = $_POST['grade_id'];
    
    $db = new Database();
    $status = $db->delete("grades","id=$id");

    if($status){
        $_SESSION['SuccessMessage'] = "Grade deleted successfully";
        header("location: grades.php");
    }else{
        $_SESSION['notification'] = "Something went wrong! Please try again later.";
        header("location: grades.php");
    }

}

?>