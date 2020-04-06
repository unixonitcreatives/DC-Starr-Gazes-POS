<?php
session_start();
require_once 'config.php';
$get_supplier_id = $_GET['id'];
$supplier = $_GET['name'];

$query = "DELETE from supplier WHERE id='$get_supplier_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
	$info = $_SESSION['username']." deleted a supplier";
	$info2 = "Details: supplier name: ".$supplier."";

	$q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
	$r = mysqli_query($link, $q) or die(mysqli_error($link)); 
    header("Location: supplier-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
