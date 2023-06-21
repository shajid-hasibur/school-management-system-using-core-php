<?php
session_start();
include('configuration/connection.php');

if (isset($_POST['btn-save'])) {
    $fee_category_id = $_POST['fee_category_id'];
    $class_id = $_POST['class_id'];
    $amount = $_POST['amount'];
    $pass1 = 0;
    $pass2 = 0;
    $pass3 = 0;
    $ids = implode(',',array_unique(array_map('intval',$class_id)));

    foreach ($class_id as $key => $value) {
        if (empty($value)) {
            $_SESSION['class-validate'] = "Please select a class";
            header("location: create_fee_amount.php");
        }elseif(!empty($value)){
            $pass1 = 1;
        }
    }
    foreach ($amount as $key => $value) {
        if (empty($value)) {
            $_SESSION['amount-validate'] = "Please give an amount";
            header("location: create_fee_amount.php");
        }elseif(!empty($value)){
            $pass2 = 1;
        }
    }
    if(empty($fee_category_id)){
        $_SESSION['validation'] = "Please select a fee";
        header("location: create_fee_amount.php");
    }else{
        $pass3 = 1;
    }
     
    $exists = "SELECT fee_category_id,class_id FROM fee_category_amounts WHERE fee_category_id = '$fee_category_id' AND class_id IN ($ids)";
    $result = mysqli_query($conn,$exists);
    $rows = mysqli_num_rows($result);
    
    if ($rows >= 1) {
        $_SESSION['status'] = 'This fee amount is already assigned for the selected class';
        header("location: create_fee_amount.php");
        die();
    }
    
    if($pass1 == 1 && $pass2 == 1 && $pass3 == 1){
        $loopCount = count($class_id);
        if($loopCount != null){
            for ($i=0; $i < $loopCount; $i++) { 
                $query = "INSERT INTO fee_category_amounts (fee_category_id,class_id,amount) VALUES ('$fee_category_id','$class_id[$i]','$amount[$i]')";
                $query_run = mysqli_query($conn,$query);
                $_SESSION['status'] = "Student fee added to the classes.";
                header("location: fee_category_amount.php");
            }
        }
    }
}

if(isset($_POST['btn-update'])){
    $fee_category_id = $_POST['fee_category_id'];
    $class_id = $_POST['class_id'];
    $amount = $_POST['amount'];
    $url = 'edit_fee_category_amount.php?fee_category_id='.$fee_category_id;
    foreach ($class_id as $key => $value) {
        if (empty($value)) {
            $_SESSION['ErrorMessage'] = "Please select a class!!";
            header("location: $url");
        }
    }
    
}

?>