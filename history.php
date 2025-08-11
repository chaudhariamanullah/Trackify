<?php

session_start();
if (isset($_SESSION['user_id'])) {

    include 'includes/connection.php';
    
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT task_name , status , date FROM task WHERE user_id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt ->bind_param("i", $user_id);

    $stmt->execute();

    $result = $stmt->get_result();
    $rows = $result->fetch_all();

    $stmt -> close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/history.css">
</head>
<body>

    <?php include 'includes/header.php' ?>

    <?php if ($rows) : ?>
    <div id="container">
            <div id="list"> 
                <?php
                    echo "<div class='date'>".$rows[0][2]."</div>";
                    $date = $rows[0][2];
                    for ($i = 0 ; $i < count($rows) ; $i++){
                        if ( $date != $rows[$i][2]){
                            $date = $rows[$i][2];
                            echo "<div class='last-line'></div>";
                            echo "<div class='date'>".$rows[$i][2]."</div>";
                        }
                        echo "<div class='task'>";
                        echo "<div class='task-name'>".$rows[$i][0]."</div>";
                        
                        if ( $rows[$i][1] == 'Complete')
                        echo "<div class='status status-complete'>".$rows[$i][1]."</div>";

                        if ( $rows[$i][1] == 'Failed')
                        echo "<div class='status status-failed' >".$rows[$i][1]."</div>";

                        if ( $rows[$i][1] == 'Pending')
                        echo "<div class='status status-pending'>".$rows[$i][1]."</div>";

                        echo "</div>";


                    }

                    echo "<div class='last-line' style='margin-bottom:1rem'></div>";

                    
                ?>
            </div>

            <div id="count">
                <?php
                    $pending = 0;
                    $completed = 0;
                    $failed = 0;

                    for ($i = 0 ; $i < count($rows) ; $i++){
                        if ( $rows[$i][1] == 'Pending')
                            $pending++;
                        else if ( $rows[$i][1] == 'Complete')
                            $completed++;
                        else
                            $failed++;
                    }
                
                    echo "<div id='pending'> <span> Pending Tasks:</span> <span> ".$pending."</span> </div>";
                    echo "<div id='complete'> <span> Completed Tasks:</span> <span>".$completed."</span> </div>";
                    echo "<div id='failed'> <span> Failed Tasks:</span> <span>".$failed."</span> </div>";
                ?>
            </div>
    </div>

    <?php endif; ?>

    <?php if (!$rows && !$user_id): ?>
        <div id='auth-msg'> <span>No User Found &nbsp; <i class="fa-solid fa-circle-exclamation"></i> </span></div>
    <?php endif; ?>

    <?php if (!$rows && $user_id)
        require 'includes/no_data.php';
    ?>
</body>
</html>
