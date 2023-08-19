<?php
session_start();

if(isset($_POST['btn-send'])){
    $to = $_POST['to'];
    $subject = $_POST['mail_subject'];
    $textArea = $_POST['mail_body'];
    $body = htmlspecialchars($textArea);
    $header = "From: shajid2525@gmail.com";
    $page_id = $_POST['page_id'];
    $url = 'student_details.php?student_id='.$page_id;

    if(empty($to)){
        $_SESSION['notification'] = "All field is required for sending mail!";
        header("location: $url");
    }elseif(empty($subject)){
        $_SESSION['notification'] = "All field is required for sending mail!";
        header("location: $url");
    }elseif(empty($body)){
        $_SESSION['notification'] = "All field is required for sending mail!";
        header("location: $url");
    }else{
        $mail =  mail($to,$subject,$body,$header);

        if($mail){
            $_SESSION['SuccessMessage'] = "Mail sent!";
            header("location: $url");
        }
    }
}
// ini_set('max_execution_time',120);

// $to = "ahchisty8@gmail.com";
// $subject = "Kire bainchod";
// $body = "kire bainchod inbox voira falamu";
// $header = "From: shajid2525@gmail.com";

// for ($i=0; $i < 40; $i++) { 
//    $mail =  mail($to,$subject,$body,$header);
// }
// if($mail){
//     echo "Mail sent successfully to ".$to;
//     echo "<br>";
//     echo "Max execution time of this script is set to ".ini_get('max_execution_time');
// }else{
//     echo "Mail sending failed";
// }
?>
