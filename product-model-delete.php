<?php
session_start();
require_once 'config.php';
$get_productModel_id = $_GET['id'];
$query = "DELETE from product_model WHERE id='$get_productModel_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: product-model-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
