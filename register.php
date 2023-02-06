<!DOCTYPE html>
<html>

<head>
    <title>Register page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include "header.php" ?>
    <?php include "register_verification.php"?>
   

    <h1 id="header-message">You dont have an account? Register Now!</h1>
    <div class="login-register-form">
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
    echo '<p style="text-align:center;">' . $account_created_message . '</p>';
    ?>
<?php include "footer.php" ?>
</body>

</html>