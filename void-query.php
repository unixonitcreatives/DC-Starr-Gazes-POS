<?php //void query

require_once ('config.php');

//select stock_id in sales order table
$selectSOquery = "SELECT * from sales_order WHERE txID ='$trans_id' ";
$SOresult = mysqli_query($link, $selectSOquery) or die(mysqli_error($link));
if (mysqli_num_rows($SOresult) > 0) {

  while ($row = mysqli_fetch_assoc($SOresult)){
      $stockID = $row['stock_ID'];
      $status = $row['mop'];
  }
} 

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $scUpdateQuery =  "UPDATE stock SET stock_status = 'In Stock', qty = 1 WHERE custID = '$stockID' "; 
  $scUpdateResult = mysqli_query($link, $scUpdateQuery) or die(mysqli_error($link));


  if($scUpdateResult){

    $soUpdateQuery = "UPDATE sales_order SET mop = 'Void' WHERE txID = '$trans_id' "; 
    $s0UpdateResult = mysqli_query($link, $soUpdateQuery) or die(mysqli_error($link));

    header("Location: si-manage.php");

  }

}