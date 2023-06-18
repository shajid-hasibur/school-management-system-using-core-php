<?php
session_start();
include('configuration/connection.php');

if (isset($_POST['btn-save'])) {
    $fee = $_POST['name'];

    if(empty($fee)){
        $_SESSION['validation'] = "Please give a fee category before submit";
		header("location: create_fee_category.php");
    }else{
        try{
            $query = "INSERT INTO fee_categories(name) VALUES('$fee')";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['status'] = "Fee category added successfully";
			header("location: fee_category.php");
        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['unique-fee'] = "This fee category already taken";
            header("location: create_fee_category.php");
        }
    }
}

if(isset($_POST['btn-update'])){
    $fee_category_id = $_POST['fee_category_id'];
    $fee_category_name = $_POST['name'];
    $url = 'edit_fee_category.php?fee_category_id='. $fee_category_id;
    
    if(empty($fee_category_name)){
        $_SESSION['validation'] = "Please give a fee category before submit";
		header("location: $url");
    }else{
        try{
            $query = "UPDATE fee_categories SET name='$fee_category_name' WHERE id='$fee_category_id' ";
            $query_run = mysqli_query($conn,$query);
            $_SESSION['status'] = "Fee category updated successfully";
			header("location: fee_category.php");

        }catch(mysqli_sql_exception $e){
            $e->getMessage();
            $_SESSION['unique-fee'] = "This fee category already taken";
            header("location: $url");
        }
    }
}

if(isset($_POST['deleteFeeBtn'])){
    $delete_id = $_POST['delete_id'];

    $query = "DELETE FROM fee_categories WHERE id='$delete_id' ";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['status'] = "Fee Category deleted successfully";
		header("location: fee_category.php");
    }else{
        $_SESSION['status'] = "Fee Category deletion failed";
        header("location: fee_category.php");
    }
}
?>