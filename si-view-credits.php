<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
$Admin_auth = 1;
$Manager_auth = 0;
$Cashier_auth = 0;
include('template/user_auth.php');
$alertMessage=$firstname=$lastname="";
?>

<?php
// Define variables and initialize with empty values

require_once "config.php";

$trans_id = $_GET['txID'];

$query = "SELECT soID,txID,stock_ID,so_desc,SUM(so_qty) as Qty,discount,SUM(so_price) as Price,so_cust,so_warehouse,mop,created_by FROM sales_order WHERE txID = '$trans_id' ";
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

$query = "SELECT * from customers WHERE custID ='$name' ";
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


?>
<!-- ================================================================ -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DC Starr Gazes</title>
  <!-- ======================= CSS ================================= -->
  <?php include('template/css.php'); ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
  <div class="wrapper">

    <!-- ======================= MENU BAR =========================== -->
    <?php include('template/menu-bar.php'); ?>
    <!-- ======================= SIDEBAR ============================ -->
    <?php include('template/sidebar-manage.php'); ?>
    <!-- ======================== HEADER CONTENT ==================== -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Sales Invoice Credits Record<br>
          <small>DC Starr Gazes Inventory Management System</small>
        </h1>
      </section>
      <!-- ======================== ALERT ======================= -->
      <?php
      if(isset($_GET['alert']) == "success"){
        $alertMessage = "<script>Notify('New payment added','Success');</script>";
      }else if(isset($_GET['alert']) == "deletesuccess"){
        $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully deleted.</div>";
      }else if(isset($_GET['alert']) == "error"){
        $$alertMessage = "<script>Notify('error','Success');</script>";
      }
       ?>
       <?php echo $alertMessage; ?>
      <!-- ======================== MAIN CONTENT ======================= -->
      <section class="content">
        <!-- general form elements -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Credit Information</h3>
          </div>

          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <td align="right" width="15%">Sales Invoice No:</td>
                <td><?php echo $_GET['txID']; ?></td>
              </tr>
              <tr>
                <td align="right" width="15%">Customer Name:</td>
                <td><?php echo $lastname." ".$firstname; ?></td>
              </tr>

            </tr>
            <tr>
              <td align="right" width="15%">Credit Total Amount:</td>
              <td><?php echo $gTotal; ?></td>
            </tr>
          </tr>

        </tr>
        <tr>
          <td align="right" width="15%">Action:</td>
          <td>
            <button class="btn btn-primary" data-toggle="modal" data-target="#updatePayment" >Update Payment</button>

            <?php
            if($gTotal === 0) {
              echo "<button class='btn btn-success'>Full Payment</button>";
            }else {
              echo "<button type='button' class='btn btn-default disabled'>Full Payment</button>";
            }

            ?>
          </td>
        </tr>

      </table>

      <!-- Modal Update Payment-->
      <div class="modal fade" id="updatePayment" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Update Payment</h4>
            </div>
            <div class="modal-body">
              <form action="functions/insert_installment_payment.php" method="POST">
                <div class="form-group">
                  <input type="hidden" value="<?php echo $trans_id; ?>" name="txNum" class="form-control"/>
                </div>
                <div class="form-group">
                  <p>Amount Paid:</p><input type="number" name="amount_paid" placeholder="0.00" class="form-control" required/>
                </div>
                <div class="form-group">
                  <p>Mode of Payment:</p><select id="mop" name="mop" onChange="changetextbox();" class="form-control select2" style="width: 100%;" required>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Cheque">Cheque</option>
                  </select>
                </div>
                <div class="form-group">
                  <p>Reference No:</p><input id="ref" type="text" name="refNum" Placeholder="Reference No" class="form-control" disabled />
                </div>

                <div class="form-group">
                  <p>Payment Date:</p>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="paymentDate" class="form-control" id="datepicker"  placeholder="mm-dd-yyyy"/>
                </div>

                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="paymentBtn">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <!-- == Transaction history table == -->
      <br>
<!-- dito table -->

      



      </div>

    </div>

    <div class="row">
        <div class="col-md-6">
          <!-- The time line -->
          <ul class="timeline">
                           
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-green">
                    Payment Update
                  </span>
            </li>
             <?php
                            // Include config file
                            require_once 'config.php';

                            // Attempt select query execution
                            $query = "SELECT * FROM installment_history WHERE si_id = '$trans_id' ORDER BY ins_tx_date desc";
                            if($result = mysqli_query($link, $query)){
                              if(mysqli_num_rows($result) > 0){
                                $ctr = 0;
                                while($row = mysqli_fetch_array($result)){
                                  $insID = $row['insID'];
                                  $in_tx_id = $row['in_tx_id'];
                                  $si_id = $row['si_id'];
                                  $ins_amount = $row['ins_amount'];
                                  $ins_mop = $row['ins_mop'];
                                  $ins_ref_no = $row['ins_ref_no'];
                                  $ins_tx_date = $row['ins_tx_date'];
                                  $created_by = $row['created_by'];
                                  $ctr++;?>
                            
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <?php
              if($row['ins_mop'] == "Cash"){
              echo "<i class='fa fa-money bg-green'></i>";
              } else {
              echo "<i class='fa fa-credit-card bg-green'></i>";
              }
              ?>

              <div class="timeline-item">
                          

                                  <span class="time"><h5><i class="fa fa-clock-o"></i> <?php echo $row['ins_tx_date']; ?></h5></span>

                                  <h3 class="timeline-header"><a href="#">Transaction ID: <?php echo $row['in_tx_id']; ?></a></h3>

                                  <div class="timeline-body">
                                    <table class="table">
                                      <tr>
                                      <td width="20%" align="right"><strong>Paid:</strong></td>
                                      <td>₱<?php echo number_format($row['ins_amount'],2); ?></td>
                                      </tr>

                                      <tr>
                                      <td width="20%" align="right"><strong>Mode:</strong></td>
                                      <td><?php echo $row['ins_mop']; ?></td>
                                      </tr>

                                      <tr>
                                      <td width="20%" align="right"><strong>Ref No:</strong></td>
                                      <td><?php echo $row['ins_ref_no']; ?></td>
                                      </tr>

                                      <tr>
                                        <td width="20%" align="right"><strong>Actions:</strong></td>
                                        <td>

                                          <a class="btn btn-primary btn-xs">Some Function</a>
                                          <a class="btn btn-success btn-xs">Some Function</a>
                                          <a class="btn btn-warning btn-xs">Some Function</a>
                                          <a class="btn btn-danger btn-xs">Some Funtions</a>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                  
                                  
                                

                                                      <?php }
                                      // Free result set
                                      mysqli_free_result($result);
                                    } else{
                                      echo "<tr>
                                      <td><p class='lead'><em>No records were found.</em></p></td>
                                      </tr>";

                                    }
                                  } else{
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                  }

                                  // Close connection
                                  mysqli_close($link);
                                  ?>
              </div>
            </li>
            <!-- END timeline item -->
          </ul>
        </div>
        <!-- /.col -->
      </div>



  </section>


</div>

<!-- =========================== FOOTER =========================== -->
<footer class="main-footer">
  <?php include('template/footer.php'); ?>
</footer>


<!-- =========================== JAVASCRIPT ========================= -->
<?php include('template/js.php'); ?>


</body>
</html>
