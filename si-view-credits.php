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
  if(isset($_GET['alert']) == "updatesuccess"){
    $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully updated.</div>";
  }else if(isset($_GET['alert']) == "deletesuccess"){
    $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully deleted.</div>";
  }else if(isset($_GET['alert']) == "addsuccess"){
    $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully added.</div>";
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
                  <td align="right" width="15%">Customer ID:</td>
                  <td><?php echo $name; ?></td>
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
                  <tr>
                  <td align="right" width="15%">Mode of Payment:</td>
                  <td>Installment</td>
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
                        <div class="form-group">
                            <p>Transaction No:</p><input type="text" value="<?php echo $trans_id; ?>" class="form-control" disabled/>
                        </div>
                          <div class="form-group">
                              <p>Amount Paid:</p><input type="text" placeholder="0.00" class="form-control" required/>
                          </div>
                          <div class="form-group">
                              <p>Mode of Payment:</p><select class="form-control select2" style="width: 100%;" required>
                                <option>Cash</option>
                                <option>Card</option>
                                <option>Cheque</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <p>Reference No:</p><input type="text" Placeholder="Reference No" class="form-control" />
                          </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>















                <br>
                    Dito Transaction History
                    <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Transaction ID</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Amount</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >MOP</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Ref. No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Created by:</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >Action/s</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT txID, mop FROM sales_order GROUP BY txID ORDER BY soID desc";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;?>
                              <tr>
                              <td><a href="si-view.php?txID=<?php echo $row['txID']; ?>"><?php echo $row['txID']; ?></td>
                              <td><?php echo $row['mop'];?></td>
                              <td></td>
                              <td>Cashier</td>

                            <?php }
                            // Free result set
                            mysqli_free_result($result);
                          } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                        </tr>
                      </tbody>
                    </table>
              </div>
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
