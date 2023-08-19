<?php
require('configuration/connection.php');

$name = 'Admin';
$usertype = '1';
$phone = '01234567891';
$email = 'admin@example.com';
$password = '12345678';
$encrypted_pass = password_hash($password, PASSWORD_BCRYPT);

try{
    $sql = "INSERT INTO users (name,usertype,phone,email,password)
    VALUES ('$name','$usertype','$phone','$email','$encrypted_pass')";
    $run = mysqli_query($conn,$sql);
    if($run){
        echo "Admin registered now you can login. Also don't forget to change your password after login";
        echo " <a href='index.php'>Back</a>";
    }

}catch(Exception $e){
    echo $e->getMessage()." Admin already registerd using this mail.";
}

?>