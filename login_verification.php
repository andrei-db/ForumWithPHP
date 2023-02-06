<?php
        $username="";
        $password="";
        $login_response="";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $username=$_POST['login_username'];
             $password=$_POST['login_password'];

            include "mysql_connection.php";

            $sql = "select username,password from accounts where username = '$username'";  
            $result = mysqli_query($db_connection, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
            if($count == 1 && password_verify($password,$row['password'])){  

                $_SESSION['username']=$row['username'];
                $login_response="Login successful"; 
                header("Refresh:3; url=index.php"); 
            }  
            else{  
                $login_response="Login failed"; 
            }  

           
        }
