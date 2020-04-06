<?php
session_start();
require_once 'config.php';
$get_category_id = $_GET['id'];
$cat = $_GET['cat'];
$cID = $_GET['cID'];
$query = "DELETE from categories WHERE id='$get_category_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
	$info = $_SESSION['username']." deleted a category";
	$info2 = "Details: category name: ".$cat.", id: ".$cID."";

	$q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
	$r = mysqli_query($link, $q) or die(mysqli_error($link)); 
    header("Location: category-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
