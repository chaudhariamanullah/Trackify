<?php

    $error = "";
    if ( $_SERVER['REQUEST_METHOD'] == "POST"){

        include 'queries/validate_user.php';

        if ( empty($error) ){
            include 'queries/add_user.php';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="container">

        <div id="logo"><i class="fa-solid fa-clipboard-check"></i> Signup </div>

        <form action="" method="POST">

            <div class="inputs"> 
                <span>Username: </span> <input type="text" name="username">
            </div>

            <div class="inputs"> 
                <span >E-mail: </span> <input type="text" name="email">
            </div>

            <div class="inputs"> 
                <span>Password: </span> <input type="text" name="password">
            </div>

            <div>
                <button id="auth-btn">Signup</button> <div id="login">Already Have An Account?<a href="login.php">Login</a></div>
            </div>
        </form>
    </div>

    <?php if ($error)
            echo "<div id='error'>".$error."</div>";
            $error = "";
    ?>

    <script>
        let errorDiv = document.querySelector("#error");

        if (errorDiv){
            setTimeout(() => {
                errorDiv.style.transition = "opacity 0.5s ease-in-out";
                errorDiv.style.opacity = "0";
                setTimeout(() => errorDiv.style.display = "none", 500);
            }, 2500);
        }
    </script>
</body>
</html>