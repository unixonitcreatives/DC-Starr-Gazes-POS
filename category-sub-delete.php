<?php
session_start();
require_once 'config.php';
$get_subCategory_id = $_GET['id'];
$scat = $_GET['scat'];
$pcat = $_GET['pcat'];

$query = "DELETE from categories_sub WHERE id='$get_subCategory_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
	$info = $_SESSION['username']." deleted a sub-category";
	$info2 = "Details: sub-category name: ".$scat.", parent-category: ".$pcat."";

	$q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
	$r = mysqli_query($link, $q) or die(mysqli_error($link)); 
    header("Location: category-sub-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
