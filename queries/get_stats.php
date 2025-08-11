<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['user_id'])) {
        require 'includes/connection.php';

        $sql = "SELECT status, COUNT(task_name) AS count FROM task WHERE user_id = ? GROUP BY status";
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$user_id);

        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $total = 0;
        $pending = 0;
        $completed = 0;
        $failed = 0;

        foreach ($rows as $row) {
            $total += $row['count'];

            if ( $row['status'] == 'Pending')
                $pending = $row['count'];
            else if ( $row['status'] == 'Complete')
                $completed = $row['count'];
            else 
                $failed = $row['count'];
        }

        if ( $total > 0){
            $pending = round(($pending * 100) / $total, 2);
            $completed = round(($completed * 100) /$total, 2);
            $failed = round(( $failed * 100) /$total, 2);
        }

    }

?>