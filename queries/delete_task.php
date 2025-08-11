<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {

    include '../includes/connection.php';

    $user_id = $_SESSION['user_id'];
    $task_id = $_POST["delete"];
    $sql = "UPDATE task set status='Failed' WHERE task_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $task_id,$user_id);

    $stmt->execute();
    $stmt->close();

    header("Location: ../index.php");
    exit;

}
?>