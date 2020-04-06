<?php
session_start();
require_once 'config.php';
$get_productModel_id = $_GET['id'];
$name = $_GET['name'];
$desc = $_GET['desc'];
$query = "DELETE from product_model WHERE id='$get_productModel_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
	$info = $_SESSION['username']." deleted a product model";
	$info2 = "Details: product sku: ".$name.", description: ".$desc."";

	$q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)";
	$r = mysqli_query($link,$q); //Prepare insert query
    header("Location: product-model-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
