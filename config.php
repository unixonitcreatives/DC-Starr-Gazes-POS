<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');//remotemysql.com
define('DB_USERNAME', 'root');//0WzyUgtMIG
define('DB_PASSWORD', '');//c19nN2Uw8H
define('DB_NAME', '0WzyUgtMIG');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Something Went Wrong" . mysqli_connect_error());

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
