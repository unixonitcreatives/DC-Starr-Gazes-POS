<?php
session_start();
require_once 'config.php';
$return_id = $_GET['id'];
$item = $_GET['item'];
$tx = $_GET['tx'];
$query = "DELETE from returns WHERE id='$return_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
	 //logs
    $info = $_SESSION['username']." deleted a return";
    $info2 = "Details: item: ".$item.", transaction ID: ".$tx."";

    $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
    $r = mysqli_query($link, $q) or die(mysqli_error($link));

    header("Location: returns-manage.php?alert=deletesuccess");
}else {
    echo "Error deleting record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
