<?php
        include 'includes/connection.php';

        if ( empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) ){
            $error = "Please Fill All Required Information";
        } else if ( strlen($_POST["username"]) > 50 || strlen($_POST["username"]) < 3 ){
            $error = "Username Length Over 50 AND Under 3 Characters Is Not Allowed";
        } else if ( strlen($_POST["email"]) > 100 || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ){
            $error = "Email In Wrong Format Or It Exceeds 100 Characters";
        } else if ( strlen($_POST["password"]) < 8 ||  strlen($_POST["password"]) > 8){
            $error = "Password Must Be 8 Characters Only";
        } else {
            $sql = "SELECT COUNT(*) FROM user WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt -> bind_param("s",$_POST["email"]);
            $stmt -> execute();
    
            $result = $stmt->get_result();
            $exist = $result->fetch_row();
        }

        if ( $exist[0] == 1)
            $error = "Email Already In Use";
?>