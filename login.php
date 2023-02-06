<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <title>Login page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include "header.php"?>
   
 
 

    <h1 id="header-message">Login!</h1>
    <div class="login-register-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>

                <label for="username">Username: </label><br>
                <input type="text" id="username" name="login_username"><br>
            </div>
            
            <div>
                <label for="password">Password: </label><br>
                <input type="password" id="password" name="login_password"><br>
            </div>
          
            <br>
            <input type="submit">
        </form>

    </div>
    <?php
    
    echo '<p style="text-align:center;">' .  $login_response. '</p>';
    ?>   
    <?php include "footer.php" ?>
</body>

</html>