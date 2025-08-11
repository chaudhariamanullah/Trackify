<?php

    $error = "";
    if ( $_SERVER['REQUEST_METHOD'] == "POST" ){
        
        if ( empty($_POST["email"]) || empty($_POST["password"]) )
            $error = "Please Fill All Required Information";
        else
            include 'queries/verify_user.php';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="container">

    <div id="logo"><i class="fa-solid fa-clipboard-check"></i> Login </div>

    <form action="" method="POST">

        <div class="inputs"> 
            <span >E-mail: </span> <input type="text" name="email">
        </div>

        <div class="inputs"> 
            <span>Password: </span> <input type="text" name="password">
        </div>

        <div style="margin-top: 2.5rem" id='login-authBtn'>
            <button id="auth-btn">Login</button> <div id="login">Don't Have An Account Account?<a href="signup.php">Signup</a></div>
        </div>

    </form>
    </div>

    <?php if ($error){
            echo "<div id='error'>".$error."</div>";
            $error = "";
          }
    ?>

    <?php
         session_start();
         if (isset($_SESSION['signup_msg'])) {
             echo "<div id='success'>" . $_SESSION['signup_msg'] . "</div>";
             unset($_SESSION['signup_msg']);
         }
    ?>

    <script>
        let errorDiv = document.querySelector("#error");

        let successDiv = document.querySelector("#success");

        if ( successDiv ){
            setTimeout(() => {
                successDiv.style.transition = "opacity 0.5s ease-in-out";
                successDiv.style.opacity = "0";
                setTimeout(() => sucessDiv.style.display = "none", 500);
            }, 2000);
        }

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