<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    include '../includes/connection.php';

    $task = $_POST["task"];
    $priority = $_POST["priority"];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO task(user_id,task_name,priority,date) VALUES (?,?,?,CURRENT_DATE)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss",$user_id,$task,$priority);

    $stmt->execute();
    $stmt->close();

    header("Location: ../index.php");
    exit;
}
?>