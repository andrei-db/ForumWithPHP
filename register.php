<!DOCTYPE html>
<html>

<head>
    <title>Register page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    $username = $email = $password = $confirmPassword = "";
    $usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
    $usernamePass = $emailPass = $passwordPass = $confirmPasswordPass = true;
    $servername="localhost";
    $db_username="andreidb";
    $db_password="12345";
    $db_name="forumphp";
    $account_created_message="";
    $hashPassword="";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (empty(trim($_POST["username"]))) {
            $usernameErr = "Username is required";
            $usernamePass=false;
        } else {
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
                $usernamePass=false;
                $usernameErr = "Username can contains only letters and numbers";
                
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $emailPass=false;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $emailPass=false;
            }
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
            $passwordPass=false;
        } else {
            $password = test_input($_POST["password"]);
            $hashPassword=password_hash($password,PASSWORD_DEFAULT);
        }
        if (empty($_POST["confirm_password"])) {
            $confirmPasswordErr = "Confirm Password is required";
            $confirmPasswordPass=false;
        } else {
            $confirmPassword = test_input($_POST["confirm_password"]);
            $hashConfirmPassword=password_hash($confirmPassword,PASSWORD_DEFAULT);
            if (!empty($_POST["password"]) and $confirmPassword == $password) {
            } else if (!empty($_POST["password"]) and $confirmPassword != $password) {
                $confirmPasswordErr = "Passwords are not the same";
                $confirmPasswordPass=false;
            }
        }

        if($usernamePass == true && $emailPass ==true &&  $passwordPass == true && $confirmPasswordPass == true){
            $db_connection=new mysqli($servername,$db_username,$db_password,$db_name);

            if($db_connection->connect_error){
                die("Connection failed".$db_connection->connect_error);
            }

            $sql_entry="INSERT INTO accounts (username,email,password) VALUES ('$username','$email','$hashPassword')";
            if($db_connection->query($sql_entry)===true){
                $account_created_message="Your account was succesfully created!";
            }else{
                $account_created_message= "Something went wrong when we tried to create your account! Try again later.";
            }
            
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
    <header>
        <nav id="navbar">

            <div id="nav-items">
                <a href="index.php">Home</a>
                <a href="search.php">Search</a>
            </div>
            <div id="login-register">
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </div>
        </nav>
    </header>
    <h1 id="register-header-message">You dont have an account? Register Now!</h1>
    <div id="register-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>

                <label for="username">Username: </label><br>
                <input type="text" id="username" name="username"><br>
            </div>
            <div>
                <label for="email">Email address: </label><br>
                <input type="email" id="email" name="email"><br>
            </div>
            <div>
                <label for="password">Password: </label><br>
                <input type="password" id="password" name="password"><br>
            </div>
            <div>
                <label for="password">Confirm password: </label><br>
                <input type="password" id="confirm_password" name="confirm_password"><br>
            </div>
            <br>
            <input type="submit">
        </form>

    </div>
    <?php
    echo '<p style="text-align:center;color:red;">' . $usernameErr . '</p>';
    echo '<p style="text-align:center;color:red;">' . $emailErr . '</p>';
    echo '<p style="text-align:center;color:red;">' . $passwordErr . '</p>';
    echo '<p style="text-align:center;color:red;">' . $confirmPasswordErr . '</p>';
    echo '<p style="text-align:center;">' . $account_created_message. '</p>';
    ?>

</body>

</html>