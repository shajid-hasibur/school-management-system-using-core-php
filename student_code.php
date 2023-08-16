<?php
session_start();
require('configuration/connection.php');

if(isset($_POST['btn-save'])){

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
    $sphoto = $_FILES['sphoto'];
    $sphotoType = $_FILES['sphoto']['type'];
    $allowedMimeTypes = array("image/jpeg", "image/png");
    
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
    } else {
        if (!filter_var($discount, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>100)))) {
            $errors['discount'] = "Invalid discount. Please provide a number between 0 and 100.";
        }
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
        $errors['email'] = "Not a valid email";
    }
    if($_FILES["sphoto"]["error"] !== UPLOAD_ERR_OK){
        $errors['sphoto'] = "Student photo is required!";
    }else {
        if (!in_array($sphotoType, $allowedMimeTypes)) {
            $errors['sphoto'] = "Invalid photo format. Allowed formats: JPEG, PNG.";
        }
    }
    $_SESSION['error-text']=$errors;
    if(!$_SESSION['error-text'] == ''){
        header("location: student_registration.php");
    }else{
        //image proccessing
        $target_dir = "uploads/student_images/";
        $original_name = $_FILES["sphoto"]["name"];
        $imageFileType = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $unique_name = time() . '_' . mt_rand() . '.' . $imageFileType;
        $target_file = $target_dir . $unique_name;
        move_uploaded_file($_FILES["sphoto"]["tmp_name"], $target_file);
        //generating student unique id

        //getting the year
        $query1 = "SELECT * FROM years WHERE id='$year_id' LIMIT 1";
        $query_run1 = mysqli_query($conn,$query1);
        foreach ($query_run1 as $key => $value) {
            $year = $value['name'];
        }
        //getting the student serial
        $query2 = "SELECT * FROM students ORDER BY id DESC LIMIT 1";
        $query_run2 = mysqli_query($conn,$query2);
        $student = mysqli_fetch_assoc($query_run2);

        if($student == ''){
            $firstReg = 0;
            $studentId = $firstReg + 1;
            if ($studentId < 10) {
                $id_no = '1000' . $studentId;
            } elseif ($studentId < 100) {
                $id_no = '100' . $studentId;
            } elseif ($studentId < 1000) {
                $id_no = '10' . $studentId;
            } elseif ($studentId < 10000) {
                $id_no = '1' . $studentId;
            }
        }else{
            $studentId = intval($student['id']) + 1;
            if ($studentId < 10) {
                $id_no = '1000' . $studentId;
            } elseif ($studentId < 100) {
                $id_no = '100' . $studentId;
            } elseif ($studentId < 1000) {
                $id_no = '10' . $studentId;
            } elseif ($studentId < 10000) {
                $id_no = '1' . $studentId;
            }
        }

        $finalId = $year . $id_no;
        $code = rand(0000,9999);
        $encrypted_code = password_hash($code, PASSWORD_BCRYPT);
    
        //begin transaction
        mysqli_begin_transaction($conn);
        try{
            //insert into students
            $sql1 = "INSERT INTO students(name,fname,mname,contact_number,address1,address2,gender,image_path,image_name,religion,id_no,dob) VALUES('$sname','$fname','$mname','$contact','$address1','$address2','$gender','$target_file','$unique_name','$religion','$finalId','$dob')";
            $sql1_run = mysqli_query($conn,$sql1);
            if($sql1_run){
                $student_id = mysqli_insert_id($conn);
            }
            //insert into users
            $sql2 = "INSERT INTO users (usertype,student_id,code,email,password,status) VALUES ('3','$student_id','$code','$email','$encrypted_code','1')";
            $sql2_run = mysqli_query($conn,$sql2);

            //insert into assign_students
            $sql3 = "INSERT INTO assign_students (student_id,class_id,year_id,group_id,section_id) VALUES ('$student_id','$class_id','$year_id','$group_id','$section_id')";
            $sql3_run = mysqli_query($conn,$sql3);

            if($sql3_run){
                $assign_student_id = mysqli_insert_id($conn);
            }
            
            //insert into discount_students
            $sql4 = "INSERT INTO discount_students (assign_student_id,discount) VALUES ('$assign_student_id','$discount')";
            $sql4_run = mysqli_query($conn,$sql4);
            mysqli_commit($conn);
            $_SESSION['SuccessMessage'] = "Student Registration Successful";
            header("location: student_list.php");

        }catch(Exception $e){
            mysqli_rollback($conn);
            $_SESSION['notification'] = "Student Registration Failed. " . $e->getMessage();
            header("location: student_registration.php");
        }
    }
}

if(isset($_POST['btn-update'])){

    $student_id = $_POST['student_id'];
    
    // Retrieve updated data from the form
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
    $sphoto = $_FILES['sphoto'];
    $sphotoType = $_FILES['sphoto']['type'];
    $allowedMimeTypes = array("image/jpeg", "image/png");
    $email = $_POST['email'];
    $url = 'student_details.php?student_id='.$student_id;
    $url2 = 'student_update.php?student_id='.$student_id;

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
    } else {
        if (!filter_var($discount, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>100)))) {
            $errors['discount'] = "Invalid discount. Please provide a number between 0 and 100.";
        }
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
        $errors['email'] = "Not a valid email";
    }
    if($_FILES["sphoto"]["error"] !== UPLOAD_ERR_OK){
        $errors['sphoto'] = "Student photo is required!";
    }else {
        if (!in_array($sphotoType, $allowedMimeTypes)) {
            $errors['sphoto'] = "Invalid photo format. Allowed formats: JPEG, PNG.";
        }
    }
    $_SESSION['error-text']=$errors;
    if(!$_SESSION['error-text'] == ''){
        header("location: $url2");
    }else{
         //image proccessing
         $target_dir = "uploads/student_images/";
         $original_name = $_FILES["sphoto"]["name"];
         $imageFileType = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
         $unique_name = time() . '_' . mt_rand() . '.' . $imageFileType;
         $target_file = $target_dir . $unique_name;
         move_uploaded_file($_FILES["sphoto"]["tmp_name"], $target_file);

         mysqli_begin_transaction($conn);
         try{
            $update_query1 = "UPDATE students SET
            name = '$sname',
            fname = '$fname',
            mname = '$mname',
            contact_number = '$contact',
            address1 = '$address1',
            address2 = '$address2',
            gender = '$gender',
            religion = '$religion',
            dob = '$dob',
            image_path = '$target_file',
            image_name = '$unique_name'
            WHERE id = '$student_id'";

            $update_result1 = mysqli_query($conn, $update_query1);

            $update_query2 = "UPDATE assign_students SET
            class_id = '$class_id',
            year_id = '$year_id',
            group_id = '$group_id',
            section_id = '$section_id'
            WHERE student_id = '$student_id'";

            $update_result2 = mysqli_query($conn, $update_query2);
            $sql = "SELECT id FROM assign_students WHERE student_id='$student_id'";
            $sql_run = mysqli_query($conn,$sql);
            $assign_student_id = mysqli_fetch_assoc($sql_run);

            $update_query3 = "UPDATE users SET
            email = '$email'
            WHERE student_id = '$student_id'";

            $update_result3 = mysqli_query($conn, $update_query3);

            $update_query4 = "UPDATE discount_students SET
            discount = '$discount'
            WHERE assign_student_id = '$assign_student_id'";

            $update_result4 = mysqli_query($conn, $update_query4);
            mysqli_commit($conn);
            $_SESSION['SuccessMessage'] = "Student information updated successfully";
            header("location: $url");

         }catch(Exception $e){
            mysqli_rollback($conn);
            $_SESSION['notification'] = "Student information update failed. " . $e->getMessage();
            header("location: $url");
         }
    }
}
?>