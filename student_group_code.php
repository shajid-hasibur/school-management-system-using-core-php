<?php
session_start();
include('configuration/connection.php');

if (isset($_POST['btn-save'])) {
    $group = $_POST['name'];
    
    if(empty($group)){
        $_SESSION['ErrorMessage'] = "Please provide a group name before submit !!";
        header('location: create_student_group.php');
    }else{
        try{
            $query = "INSERT INTO groups (name) VALUES ('$group')";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['SuccessMessage'] = "Group saved successfully";
            header("location: student_group.php");
        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['ErrorMessage'] = "This group already exists !!";
            header("location: create_student_group.php");
        }
    }
}

if(isset($_POST['btn-update'])){
    $group_id = $_POST['group_id'];
    $group = $_POST['name'];
    $url = 'edit_student_group.php?group_id='.$group_id;
    
    if(empty($group)){
        $_SESSION['ErrorMessage'] = "Please provide a group name before submit !!";
        header("location: $url");
    }else{
        try{
            $query = "UPDATE groups SET name = '$group' WHERE id = '$group_id' ";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['SuccessMessage'] = "Group updated successfully";
            header("location: student_group.php");
        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['ErrorMessage'] = "This group already exists !!";
            header("location: $url");
        }
    }
}

if (isset($_POST['deleteGroupBtn'])) {
    $delete_id = $_POST['delete_id'];

    $check_usage_query = "SELECT COUNT(*) AS usage_count FROM assign_students WHERE group_id = '$delete_id'";
    $check_usage_result = mysqli_query($conn, $check_usage_query);
    if ($check_usage_result) {
        $usage_count = mysqli_fetch_assoc($check_usage_result)['usage_count'];
        if ($usage_count > 0) {
            $_SESSION['notification'] = "Group deletion failed! This group is in use cannot be deleted.";
            header("location: student_group.php");
        } else {
            $query = "DELETE FROM groups WHERE id='$delete_id' ";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                $_SESSION['SuccessMessage'] = "Group deleted successfully.";
                header("location: student_group.php");
            } else {
                $_SESSION['notification'] = "Something went wrong!";
                header("location: student_group.php");
            }
        }
    }
}
?>