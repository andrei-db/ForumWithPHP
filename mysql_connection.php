<?php

$servername = "localhost";
$db_username = "andreidb";
$db_password = "12345";
$db_name = "forumphp";

$db_connection = new mysqli($servername, $db_username, $db_password, $db_name);

if ($db_connection->connect_error) {
    die("Connection failed" . $db_connection->connect_error);
}

?>