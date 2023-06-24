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
        $output = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
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

?>