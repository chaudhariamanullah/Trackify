<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLogged = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div id="logo">
            <i class="fa-solid fa-clipboard-check"></i> <span><a href="./index.php">Organized</a></span>
        </div>

        <div id='ham-menu'>

            <div id='ham-menu-icon-show' onclick='showBtns()'> <i class="fa-solid fa-bars"></i> </div>

            <div id='ham-menu-icon-hide' onclick='hideBtns()'> <i class="fa-solid fa-xmark"></i> </div>
            <div id="btns-username">

                <?php if ($isLogged){
                echo "<div> <form action='statistics.php' method='GET'><button class='btns'>Statistics</button></form></div>";
                echo "<div> <form action='history.php' method='GET'><button class='btns'>History</button></form></div>";
                echo "<form action='queries/logout.php' method='GET'> <button class='auth-btns'>". $_SESSION['username']."<i class='fa-solid fa-right-from-bracket' style='margin-left: 3px;'></i></button> </form>";
                } else {
                    echo "<form action='login.php' method='GET'> <button class='auth-btns'> Login &nbsp; <i class='fa-solid fa-sign-in-alt'></i></button> </form>";
                    echo "<form action='signup.php' method='GET'> <button class='auth-btns'> Signup &nbsp; <i class='fa-solid fa-user' style='margin-left: 3px;'></i></button> </form>";      
                }?> 

            </div>
        </div>
    </header>

    <script src='js/header.js'></script>
</body>
</html>