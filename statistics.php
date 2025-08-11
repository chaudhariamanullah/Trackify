<?php 
    include 'queries/get_stats.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/statistics.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <?php if ($rows): ?>
    
    <div id='status'> 
        <div id='perc-pending'>
            <span class='status-name'>Pending</span> <span class='status-perc'><?php echo $pending ?>%</span> 
        </div> 
    
        <div id='perc-completed'>
            <span class='status-name'>Completed</span> <span class='status-perc'><?php echo $completed ?>%</span>
        </div>

        <div id='perc-failed'>
            <span class='status-name'>Failed</span> <span class='status-perc'><?php echo $failed ?>%</span> </div>
        </div>

    <div id="container">

        <div id="pending" style="height: <?php echo $pending ?>%; margin-bottom: <?php echo ($pending == 0 ? '2rem' : '0rem');?>;">
            <div><?php echo $pending ?>%</div>
            <div>Pending</div>
        </div>

        <div id="completed" style="height: <?php echo $completed ?>%; margin-bottom: <?php echo ($completed == 0 ? '2rem' : '0rem');?>;">
            <div><?php echo $completed ?>%</div>
            <div>Completed</div>
        </div>

        <div id="failed" style="height: <?php echo $failed ?>%; margin-bottom: <?php echo ($failed == 20 ? '2rem' : '0rem');?>;">
            <div><?php echo $failed ?>%</div>
            <div>Failed</div>
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