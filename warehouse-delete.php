<?php
session_start();
require_once 'config.php';
$get_warehouse_id = $_GET['id'];
$name = $_GET['name'];
$add = $_GET['add'];

$query = "DELETE from warehouse WHERE id='$get_warehouse_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
	  //logs
    $info = $_SESSION['username']." deleted a warehouse";
    $info2 = "Details: warehouse name: ".$name." address: ".$add."";

    $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
    $r = mysqli_query($link, $q) or die(mysqli_error($link));  

    header("Location: warehouse-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
