<?php
session_start(); 
$allowedRoles = [1, 2];

if (!in_array($_SESSION['auth_user']['user_role'], $allowedRoles)) {
    http_response_code(403);
    header("location: /PHP_SCHOOL/sms/admin/access_denied.php");
    exit;
}
?>