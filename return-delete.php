<?php
session_start();
require_once 'config.php';
$return_id = $_GET['id'];
$query = "DELETE from returns WHERE id='$return_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: returns-manage.php?alert=deletesuccess");
}else {
    echo "Error deleting record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
