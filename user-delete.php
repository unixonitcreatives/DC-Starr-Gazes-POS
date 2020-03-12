<?php
session_start();
require_once 'config.php';
$get_user_id = $_GET['id'];
$query = "DELETE from users WHERE id='$get_user_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: user-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
