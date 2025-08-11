<?php include 'includes/connection.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    $quote = "No SignIn/LogIn Found";
} else {
    if (isset($_COOKIE['quote'])) {
        $quote = $_COOKIE['quote'];
    } else {
        require 'includes/quotes_api.php'; 
    }
}

if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];
        $sql = "SELECT task_name, priority, task_id FROM task WHERE status = 'Pending' AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all();
        $stmt->close();
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 </head>
<body>
   
    <?php include 'includes/header.php'; ?>

    <div id="todo-board">
        <div id="todo-list">

        <?php  
        if ( !$rows && !$id){
            echo "<div id='auth-msg'> <span>No User Found &nbsp; <i class='fa-solid fa-circle-exclamation' ></i></span></div>";
        } else if (!$rows && $id){
            require 'includes/no_data.php';

        } else{

            for ($i = 0; $i < count($rows); $i++) {

                    echo "<div class='task'>";

                    echo "<div id='sr-task'>";
                    echo "<div class='sr-no'>".($i+1)."</div>";

                    if ( $rows[$i][1] == 'low'){
                        echo "<div class='task-name low-task'>".ucfirst($rows[$i][0])."</div>";
                    } else if ( $rows[$i][1] == 'mid' ){
                        echo "<div class='task-name mid-task' >".ucfirst($rows[$i][0])."</div>";
                    } else {
                        echo "<div class='task-name high-task'>".ucfirst($rows[$i][0])."</div>";
                    }

                    if ( $rows[$i][1] == 'low'){
                        echo "<div class='priority low-priority'>".ucfirst($rows[$i][1])."</div>";
                    } else if ( $rows[$i][1] == 'mid' ){
                        echo "<div class='priority mid-priority'>".ucfirst($rows[$i][1])."</div>";
                    } else {
                        echo "<div class='priority high-priority'>".ucfirst($rows[$i][1])."</div>";
                    }

                    echo "<button class='tool-icon' onclick='showTools(". $i+1 .")'><i class='fa-solid fa-caret-down'></i></button>";
                    echo "</div>";

                    echo "<div class='tool-btns'>";
                        echo "<form action='queries/complete_task.php' method='POST' ><input type='hidden' name='complete' value='".$rows[$i][2]."'/><button class='complete-icon'><i class='fa-solid fa-square-check'></i></button></form>";
                        echo "<form action='queries/delete_task.php' method='POST' ><input type='hidden' name='delete' value='".$rows[$i][2]."'/><button class='del-icon'><i class='fa-solid fa-trash'></i></button></form>";
                        echo "<button class='edit-icon' onclick='editTask(" . $i+1 . ", \"" . $rows[$i][2] . "\")'><i class='fa-solid fa-pencil'></i></button>";
                    echo "</div>";

                    echo "</div>";
        }} ?> 

        </div>

    
        <?php if ($id): ?>

            <div id="todo-controls">

                    <div id="quote"> <?php echo $quote ?> </div>

                    <div id="add-btn">
                        <button id="add-btn-icon" onclick="addTask()">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
            </div>
        <?php endif; ?>

    </div>

    <div id="task-text">
        <form action="queries/add_task.php" method="post">
            <input type="text" name="task" onkeyup='validateInput()' class='inputTask'>
            <select name="priority">
                <option value="low">Low</option>
                <option value="mid">Mid</option>
                <option value="high">High</option>
            </select>
            <button type="submit" class='inputBtnSet' disabled>Set</button>
        </form>

        <button id="close" onclick="removeTaskDiv()"><i class="fa-solid fa-square-xmark"></i></button>
    </div>

    <div id="edit-task">
        <form action="queries/edit_task.php" method="post">
            <input type="text" name="task" onkeyup='validateInput()' class='inputTask'>
            <select name="priority">
                <option value="low">Low</option>
                <option value="mid">Mid</option>
                <option value="high">High</option>
            </select>
            <button type="submit" class='inputBtnSet' disabled>Set</button>
        </form>

        <button id="close" onclick="removeEditDiv()"><i class="fa-solid fa-square-xmark"></i></button>
    </div>

    <script src="./js/index.js"></script>
</body>
</html>