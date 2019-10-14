<?php

require_once ('config.php');

$custID = $_POST['custID'];

$sql = "SELECT * from stock WHERE custID = '$custID' ";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

      $cust_ID = $row['custID'];
      $qty = $row['qty'];
      $price = $row['price'];
      $po_id = $row['PO_ID'];

}

//update Qty

$updateQuery = "UPDATE stock SET qty= qty-'$price', stock_status= 'Out of Stock' WHERE custID = '$custID' ";

?>
