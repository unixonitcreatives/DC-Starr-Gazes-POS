<?php 
include('config.php'); 

$trans_id = $_GET['txID'];
$custName = $_GET['so_cust'];

$query = "SELECT soID,txID,stock_ID,so_desc,SUM(so_qty) as Qty,SUM(discount) AS discount,SUM(so_price) as Price,so_cust,so_warehouse,mop,created_by FROM sales_order WHERE txID = '$trans_id' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)){
    $tPrice = $row['Price'];
    $discount = $row['discount'];
    $gTotal = $tPrice - $discount;

    $row['soID'];
    $SI = $row['txID'];
    $scID = $row['stock_ID'];
    $desc = $row['so_desc'];
    $qty = $row['Qty'];
    $mop = $row['mop'];
    $name = $row['so_cust'];
    $order_date = $row['created_at'];

  }
  $num_rows = mysqli_num_rows($result);
} else{
  echo "<p class='lead'><em>No records were found.</em></p>";
}

$query = "SELECT * from customers WHERE custID ='$custName' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)){
    $firstname        = $row['firstName'];
    $lastname         = $row['lastName'];
    $address          = $row['address'];
    $phone            = $row['contact'];

  }
  $num_rows = mysqli_num_rows($result);
} else{
  echo "<p class='lead'><em>No records were found.</em></p>";
}

$query = "SELECT SUM(ins_amount) AS AmountPaid from installment_history WHERE  si_id = '$trans_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)){
    $amountPaid = $row['AmountPaid'];
  }
  $num_rows = mysqli_num_rows($result);
} else{
  echo "<p class='lead'><em>No records were found.</em></p>";
}
?>

<table class="table table-bordered" id='tb'>
              <tr>
                <td align="right" width="15%">Sales Invoice No:</td>
                <td><a href="si-view-in-rows.php?txID=<?php echo $_GET['txID']; ?>"><?php echo $trans_id; ?><a/></td>
                </tr>
                <tr>
                  <td align="right" width="15%">Customer Name:</td>
                  <td><?php echo $lastname." ".$firstname; ?></td>
                </tr>
                <tr>
                  <td align="right" width="15%">Credit Total Amount:</td>
                  <td id='total_g'><?php echo $gTotal; ?></td>
                  <input type='hidden' id='total' value="<?php echo $gTotal; ?>">
                </tr>
                <tr>
                  <td align="right" width="15%">Total Amount Paid:</td>
                  <td id='amountP'><?php echo $amountPaid; ?></td>
                  <input type='hidden' value="<?php echo $amountPaid; ?>" id='amount'>
                </tr>

                <tr>
                  <td align="right" width="15%">Action:</td>
                  <td>
                    <?php
                    if($amountPaid == $gTotal) {
                        
                        echo "<div class='alert alert-success alert-dismissible' role='alert'>
                                Credit balance is now Fully Paid
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                        
                       echo "
                      <form action='#' method='POST'>
                      <button type='button' class='btn btn-primary disabled'>Update Payment</button>
                      <button class='btn btn-success' name='fullyPaid'>Full Payment</button>
                      </form>";

                          if(isset($_POST['fullyPaid'])){
                          $q = "UPDATE sales_order SET mop = 'Cash' WHERE txID = '$trans_id'";
                          $r = mysqli_query($link,$q);

                          echo "<script>window.location.href='si-credits.php'</script>";
                          }
                          
                  
//echo "<script>location.reload();</script>";
                     

                    }else {
                    ?>
                       <button class='btn btn-primary updateBtn' data-toggle='modal' data-target='#updatePayment' id="<?php echo $trans_id; ?>">Update Payment</button>
                       <button type='button' class='btn btn-default disabled' name="fullyPaid" id='fullP'>Full Payment</button>
                    <?php } ?>

                  </td>
                </tr>

              </table>