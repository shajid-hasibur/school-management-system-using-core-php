<?php
session_start();
$basePath = $_SERVER['DOCUMENT_ROOT'];
require($basePath . '/PHP_SCHOOL/sms/admin/authorisation.php');
require($basePath . '/PHP_SCHOOL/sms/admin/configuration/database.php');
require($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');
require($basePath . '/PHP_SCHOOL/sms/admin/includes/sessions.php');

if(isset($_POST['btn-search'])){

    $year = $_POST['year_id'];
    $class = $_POST['class_id'];
    $group = $_POST['group_id'];
    
    $sql = "SELECT students.*,assign_students.*,users.email
    FROM students
    INNER JOIN assign_students ON students.id = assign_students.student_id
    INNER JOIN users ON students.id = users.student_id WHERE assign_students.year_id = '$year'
    AND assign_students.class_id = '$class' AND assign_students.group_id = '$group'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($result_array as &$row) {
            $year_id = $row['year_id'];
            $class_id = $row['class_id'];
            $group_id = $row['group_id'];
            $section_id = $row['section_id'];
            $sub_id = $row['add_subject_id'];

            $year_query = "SELECT * FROM years WHERE id = '$year_id'";
            $year_result = mysqli_query($conn, $year_query);
            $year_data = mysqli_fetch_assoc($year_result);
            $row['year'] = $year_data;

            $class_query = "SELECT * FROM classes WHERE id = '$class_id'";
            $class_result = mysqli_query($conn, $class_query);
            $class_data = mysqli_fetch_assoc($class_result);
            $row['class'] = $class_data;

            $section_query = "SELECT * FROM sections WHERE id = '$section_id'";
            $section_result = mysqli_query($conn, $section_query);
            $section_data = mysqli_fetch_assoc($section_result);
            $row['section'] = $section_data;

            $group_query = "SELECT * FROM groups WHERE id = '$group_id'";
            $group_result = mysqli_query($conn, $group_query);
            $group_data = mysqli_fetch_assoc($group_result);
            $row['group'] = $group_data;

            $sub_query = "SELECT * FROM subjects WHERE id = '$sub_id'";
            $sub_result = mysqli_query($conn, $sub_query);
            $sub_data = mysqli_fetch_assoc($sub_result);
            $row['additional_subject'] = $sub_data;
        }
    }

    header('Content-Type: application/json'); // Set the content type
    echo json_encode($result_array);
}

if(isset($_POST['sub-assign'])){
    $add_subject_id = $_POST['add_subject_id'];

    $student_id = $_POST['student_id'];
    $url = 'additional_sub_student.php?student_id='.$student_id;
    $input = [
        'add_subject_id' => $add_subject_id,
    ];

    $db = new Database();
    $status = $db->update("assign_students",$input,"student_id = $student_id");
    
    if($status){
        $_SESSION['SuccessMessage'] = "Additional Subject assigned successfully for this student.";
        header("location: $url");
    }else{
        $_SESSION['notification'] = "Something went wrong additional subject not assigned!";
        header("location: $url");
    }

}
?>