<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');//unixondev.com
define('DB_USERNAME', 'root');//vipfouuo_dcstarr
define('DB_PASSWORD', '');//Bs{A6%t2R_OK
define('DB_NAME', 'vipfouuo');//vipfouuo_dcstarrgazes

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Something Went Wrong" . mysqli_connect_error());

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
