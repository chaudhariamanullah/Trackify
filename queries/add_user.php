<?php

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO user(username,email,password) values(?,?,?)";
$stmt = $conn -> prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);
$stmt -> execute();
$stmt -> close();

session_start();
$_SESSION['signup_msg'] = "Account created successfully! Please Login To Start";

header("Location: login.php");
exit;

?>