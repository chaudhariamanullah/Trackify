<?php

include 'includes/connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id , username FROM user WHERE email = ? AND password = ?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("ss",$email,$password);
$stmt -> execute();
$result = $stmt->get_result();
$exist = $result->fetch_row();
$stmt -> close();

if (!$exist)
    $error = "Such User Does Not Exists";
else {
    session_start();

    $_SESSION['user_id'] = $exist[0];
    $_SESSION['username'] = $exist[1];

    header("Location: index.php");
    exit;
}

?>