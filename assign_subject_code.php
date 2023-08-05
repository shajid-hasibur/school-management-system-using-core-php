<?php
session_start();
require('configuration/connection.php');

//assign subject insert code
if(isset($_POST['btn-save'])){
    
    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $full_mark = $_POST['full_mark'];
    $pass_mark = $_POST['pass_mark'];
    $validation_pass1 = 0;
    $validation_pass2 = 0;
    $validation_pass3 = 0;
    $validation_pass4 = 0;

    $range = array('min_range' => 1, 'max_range' => 100);
    $options = array('options' => $range);

    //checking duplicate subject entry code
    if(count($subject_id) !== count(array_unique($subject_id))){
        $_SESSION['notification'] = "Duplicate subject entry! Please try again.";
        header("location: create_assign_subject.php");
        exit();
    }else{
        $validation_pass1 = 1;
    }
    
    //full mark validation code
    foreach ($full_mark as $key => $value) {
        if(filter_var($value, FILTER_VALIDATE_INT, $options) == false){
            $_SESSION['notification'] = "Full Mark & Pass Mark field only accepts numbers between 1 - 100.";
            header("location: create_assign_subject.php");
            exit();
        }else{
            $validation_pass2 = 1;
        }
    }

    //pass mark validation code
    foreach ($pass_mark as $key => $value) {
        if(filter_var($value, FILTER_VALIDATE_INT, $options) == false){
            $_SESSION['notification'] = "Full Mark & Pass Mark field only accepts numbers between 1 - 100.";
            header("location: create_assign_subject.php");
            exit();
        }else{
            $validation_pass3 = 1;
        }
    }

    $ids = implode(',',array_unique(array_map('intval',$subject_id)));
    $exits_query = "SELECT class_id,subject_id FROM assign_subjects WHERE class_id='$class_id' AND subject_id='$ids'";
    $exits_query_run = mysqli_query($conn,$exits_query);
    
    //exiting subjects checking for selected class
    if(mysqli_num_rows($exits_query_run) >= 1){
        $_SESSION['notification'] = "Subject already exists in selected class";
        header("location: create_assign_subject.php");
        exit();
    }else{
        $validation_pass4 = 1;
    }
    
    //insert query initiated
    $iteration = count($subject_id);
    
    if($validation_pass1 && $validation_pass2 && $validation_pass3 && $validation_pass4 == 1){
        for ($i=0; $i < $iteration; $i++) { 
            $query = "INSERT INTO assign_subjects (class_id,subject_id,full_mark,pass_mark) VALUES('$class_id',
            '$subject_id[$i]','$full_mark[$i]','$pass_mark[$i]')";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['SuccessMessage'] = "$iteration subject assigned successfully to the class";
            header("location: assign_subject.php");
        }
    }else{
        $_SESSION['notification'] = "Something went wrong!";
        header("location: create_assign_subject.php");
    }
}

if(isset($_POST['btn-update'])){
    $id = $_POST['id'];
    $page_id = $_POST['page_id'];
    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $full_mark = $_POST['full_mark'];
    $pass_mark = $_POST['pass_mark'];
    $validation_pass1 = 0;
    $validation_pass2 = 0;
    $validation_pass3 = 0;
    $validation_pass4 = 0;

    $ids = explode(', ',$id);
    
    //making a multidimentional array for subject data
    $subject_data = [];

    for ($i=0; $i < count($subject_id); $i++) { 
        $sub_array = [
            'id' => $ids[$i],
            'subject_id' => $subject_id[$i],
            'full_mark' => $full_mark[$i],
            'pass_mark' => $pass_mark[$i]
        ];
        $subject_data[] = $sub_array;
    }
    //edit page url
    $url = 'edit_assign_subject.php?class_id='.$page_id;

    $range = array('min_range' => 1, 'max_range' => 100);
    $options = array('options' => $range);

    //checking duplicate subject entry code
    if(count($subject_id) !== count(array_unique($subject_id))){
        $_SESSION['notification'] = "Duplicate subject entry! Please try again.";
        header("location: $url");
        exit();
    }else{
        $validation_pass1 = 1;
    }

    //full mark validation code
    foreach ($full_mark as $key => $value) {
        if(filter_var($value, FILTER_VALIDATE_INT, $options) == false){
            $_SESSION['notification'] = "Full Mark & Pass Mark field only accepts numbers between 1 - 100.";
            header("location: $url");
            exit();
        }else{
            $validation_pass2 = 1;
        }
    }

    //pass mark validation code
    foreach ($pass_mark as $key => $value) {
        if(filter_var($value, FILTER_VALIDATE_INT, $options) == false){
            $_SESSION['notification'] = "Full Mark & Pass Mark field only accepts numbers between 1 - 100.";
            header("location: $url");
            exit();
        }else{
            $validation_pass3 = 1;
        }
    }

    if ($validation_pass1 && $validation_pass2 && $validation_pass3 == 1) {

        foreach ($subject_data as $key => $data) {
            $primaryKey = $data['id'];
            $subjectId = $data['subject_id'];
            $fullMark = $data['full_mark'];
            $passMark = $data['pass_mark'];

            $query = "UPDATE assign_subjects SET subject_id = $subjectId, full_mark = $fullMark, pass_mark = $passMark WHERE class_id = $class_id AND id = $primaryKey";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['SuccessMessage'] = "Subject list updated successfully";
            header("location: assign_subject.php");

        }    
    }   
}

if(isset($_POST['deleteAssignSubject'])){
    $id = $_POST['delete_id'];
    $query = "DELETE FROM assign_subjects WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);
    $_SESSION['SuccessMessage'] = "One subject removed from your selected class";
    header("location: assign_subject.php");

}
?>