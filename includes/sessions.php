<?php

function ErrorMessage(){
    if(isset($_SESSION['ErrorMessage'])){
        $output = "<span style=\"font-size:14px;color:red;\">";
        $output .= htmlentities($_SESSION['ErrorMessage']);
        $output .= "</span>";
        unset($_SESSION['ErrorMessage']);
        return $output;
    }
}

function SuccessMessage(){
    if(isset($_SESSION['SuccessMessage'])){
        $output = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
        $output .= htmlentities($_SESSION['SuccessMessage']);
        $output .= "<button class=\"close\" type=\"button\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span></button>";
        $output .= "</div>";
        unset($_SESSION['SuccessMessage']);
        return $output;
    }
}

function notification(){
    if(isset($_SESSION['notification'])){
        $output = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
        $output .= htmlentities($_SESSION['notification']);
        $output .= "<button class=\"close\" type=\"button\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span></button>";
        $output .= "</div>";
        unset($_SESSION['notification']);
        return $output;
    }
}

//single input validation error printing method
function validation(){
    if(isset($_SESSION['validation'])){
        $output = "<span style=\"font-size:14px;color:red;\">";
        $output .= htmlentities($_SESSION['validation']);
        $output .= "</span>";
        unset($_SESSION['validation']);
        return $output;
    }
}

//multiple input validation error printing method
function validate($fieldName) {
    if (isset($_SESSION['validate'][$fieldName]) && is_array($_SESSION['validate'][$fieldName])) {
        $output = "<span style=\"font-size:14px;color:red;\">";

        foreach ($_SESSION['validate'][$fieldName] as $errorText) {
            $output .= htmlentities($errorText) . "<br>";
        }

        $output .= "</span>";

        // Remove the displayed errors for this field
        unset($_SESSION['validate'][$fieldName]);

        return $output;
    }
}

//multi type validation for multi inputs
function validateFields($inputData, $validationRules) {
    $errors = [];

    foreach ($validationRules as $fieldName => $rules) {
        foreach ($rules as $rule) {
            switch ($rule) {
                case 'numeric':
                    if (strlen($inputData[$fieldName]) !== 0 && !is_numeric($inputData[$fieldName])) {
                        $errors[$fieldName][] = ucfirst($fieldName) . " must be a valid number.";
                    }
                    break;
                case 'required':
                    if (strlen($inputData[$fieldName]) === 0) {
                        $errors[$fieldName][] = ucfirst($fieldName) . " is required.";
                    }
                    break;
            }
        }
    }

    return $errors;
}









?>