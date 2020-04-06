<?php
session_start();

require_once 'config.php';
// Initialize the session

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//logs
$info = $_SESSION['username']." Logged Out";
$info2 = "Details: ".$username.", ".$usertype." IP:".getRealIpAddr();

$query="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
$result = mysqli_query($link, $query) or die(mysqli_error($link)); 
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
header("location: login.php");
exit;	

?>
