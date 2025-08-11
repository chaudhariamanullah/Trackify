<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    include '../includes/connection.php';

    $user_id = $_SESSION["user_id"];
    $task = $_POST["task"];
    $priority = $_POST["priority"];
    $task_id = $_POST["task_id"];

    $sql = "UPDATE task set task_name = ? , priority = ? , date = CURRENT_DATE where task_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param("ssii", $task,$priority,$task_id,$user_id);

    $stmt->execute();
    $stmt->close();

    header("Location: ../index.php");
    exit;
}
?>