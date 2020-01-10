<?php
require_once 'config.php';

if($_POST["action"]){
$response = "";
$query = "SELECT * FROM installment_history";
$result = mysqli_query($link,$query);

if(mysqli_num_rows($result) > 0){

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

    $response .= '<table class="table table-bordered">
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
          <td><?php echo $gTotal; ?></td>
        </tr>
        <tr>
          <td align="right" width="15%">Total Amount Paid:</td>
          <td id='amountP'><?php echo $amountPaid; ?></td>
        </tr>

        <tr>
          <td align="right" width="15%">Action:</td>
          <td>
            <?php
            if($amountPaid == $gTotal) {
              echo "
              <form action='#' method='POST'>
              <button type='button' class='btn btn-primary disabled'>Update Payment</button>
              <button class='btn btn-success' name='fullyPaid'>Full Payment</button>
              </form>";

            }else {
            ?>
               <button class='btn btn-primary' data-toggle='modal' data-target='#updatePayment' id="echo $trans_id;" ?>">Update Payment</button>
               <button type='button' class='btn btn-default disabled'>Full Payment</button>
            <?php } ?>

          </td>
        </tr>

      </table>
                ';

  //exit($response);
  echo $response;

  }
}


?>
