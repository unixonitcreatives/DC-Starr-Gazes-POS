<?php
session_start();
require_once 'config.php';
$get_user_id = $_GET['id'];
$user= $_GET['user'];
$query = "DELETE from users WHERE id='$get_user_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
	 //logs
    $info = $_SESSION['username']." deleted a user";
    $info2 = "Details: id:" .$get_user_id .", "."username: ". $user;

    $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
    $r = mysqli_query($link, $q) or die(mysqli_error($link));
    header("Location: user-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
