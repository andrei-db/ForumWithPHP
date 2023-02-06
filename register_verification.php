<?php
    $username = $email = $password = $confirmPassword = "";
    $usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
    $usernamePass = $emailPass = $passwordPass = $confirmPasswordPass = true;

    $account_created_message = "";
    $hashPassword = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (empty(trim($_POST["username"]))) {
            $usernameErr = "Username is required";
            $usernamePass = false;
        } else {
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
                $usernamePass = false;
                $usernameErr = "Username can contains only letters and numbers";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $emailPass = false;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $emailPass = false;
            }
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
            $passwordPass = false;
        } else {
            $password = test_input($_POST["password"]);
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        }
        if (empty($_POST["confirm_password"])) {
            $confirmPasswordErr = "Confirm Password is required";
            $confirmPasswordPass = false;
        } else {
            $confirmPassword = test_input($_POST["confirm_password"]);
            $hashConfirmPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);
            if (!empty($_POST["password"]) and $confirmPassword == $password) {
            } else if (!empty($_POST["password"]) and $confirmPassword != $password) {
                $confirmPasswordErr = "Passwords are not the same";
                $confirmPasswordPass = false;
            }
        }

        if ($usernamePass == true && $emailPass == true &&  $passwordPass == true && $confirmPasswordPass == true) {
            include "mysql_connection.php";

            $sql_entry = "INSERT INTO accounts (username,email,password) VALUES ('$username','$email','$hashPassword')";
            if ($db_connection->query($sql_entry) === true) {
                $account_created_message = "Your account was succesfully created!";
            } else {
                $account_created_message = "Something went wrong when we tried to create your account! Try again later.";
            }
            $db_connection->close();
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>