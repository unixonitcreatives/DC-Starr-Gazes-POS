<?php
include '../config.php';

$sID = $_GET['stock_ID'];
$so_price = $_GET['so_price'];

//update stock inventory from deleted item list
$updateQuery = "UPDATE stock SET qty= 1, price= '$so_price', stock_status= 'In Stock', sold_to='' WHERE custID = '$sID' ";
$updateResult = mysqli_query($link, $updateQuery);

//delete from item list
$deleteQuery = "DELETE from sales_order WHERE stock_ID='$sID' ";
$deleteResult = mysqli_query($link, $deleteQuery);

header("location:../so-generate.php");


// Close connection
mysqli_close($link);
?>
