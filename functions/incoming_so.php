<?php

//echo "OOHHHH YEEAAAHHH!!!";

include '../config.php';


$scID = $_POST['product_SKU'];
$cID = $_POST['customer_ID'];
$wID = $_POST['warehouse_name'];


$sql = "SELECT price, PO_ID from stock WHERE custID = '$scID' ";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

      $price = $row['price'];
      $po_desc = $row['PO_ID'];

    }
}


//update Qty
$updateQuery = "UPDATE stock SET qty= 0, stock_status= 'Out of Stock', sold_to= '$cID' WHERE custID = '$scID' ";
$updateResult = mysqli_query($link, $updateQuery);

//if true
$insertQuery = "INSERT INTO sales_order (stock_ID, so_desc, so_qty, so_price, so_cust, so_warehouse) VALUES ('$scID', '$po_desc', 1, $price, '$cID', '$wID')";
$insertResult = mysqli_query($link, $insertQuery);

header("location:../so-generate.php");



?>
