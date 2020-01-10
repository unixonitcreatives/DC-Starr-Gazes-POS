<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
$Admin_auth = 1;
$Manager_auth = 0;
$Cashier_auth = 0;
include('template/user_auth.php');
$alertMessage=$firstname=$lastname=$TamountPaid="";

$TamountPaid = 0;
?>

<?php
// Define variables and initialize with empty values

require_once "config.php";

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
            <div id='result2'></div>
            <table class="table table-bordered">
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
                       <button class='btn btn-primary' data-toggle='modal' data-target='#updatePayment' id="<?php echo $trans_id; ?>">Update Payment</button>
                       <button type='button' class='btn btn-default disabled'>Full Payment</button>
                    <?php } ?>

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
                      <form action="action.php" method="POST">
                        <div class="form-group">
                          <input type="hidden" id="t_id" value="<?php echo $trans_id; ?>" name="txNum" class="form-control"/>
                        </div>
                        <div class="form-group">
                          <p>Amount Paid:</p><input type="number" name="amount_paid" placeholder="0.00" id='amount_p' class="form-control" required/>
                        </div>
                        <div class="form-group">
                          <p>Mode of Payment:</p><select id="mop" name="mop" onChange="changetextbox();" class="form-control select2" style="width: 100%;" required>
                            <option value="Cash">Cash</option>
                            <option value="Card" name="card">Card</option>
                            <option value="Cheque" name="cheque">Cheque</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <p>Reference No:</p><input id="ref" type="text" name="refNum" Placeholder="Reference No" class="form-control"  disabled/>
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
                        <button type="button" class="update btn btn-primary" name="paymentBtn" id="action">Submit</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>


              <!-- == Transaction history table == -->
              <br>
              <!-- dito table -->
              <div id='result'>

              </div>

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

      <script>
        $(document).ready(function(){
          fetch();
          function fetch(){
            var action = 'select';
            //var amountP = $('#amountP').val();
            $.ajax({
              url: "select2.php",
              method: "POST",
              data:{action:action},
              success:function(data){
                $('#amount_p').val();
                $('#mop').val();
                $('#ref').val();
                $('#datepicker').val();
                $('#result').html(data);
              }
            })
          }

          $('#action').click(function(){

            var amount_paid = $('#amount_p').val();
            var mop = $('#mop').val();
            var reference_num = $('#ref').val();
            var payment_date = $('#datepicker').val();
            var action = $('#action').text();

            if(amount_paid != "" || mop != "" || reference_num != "" || payment_date != ""){
              $.ajax({
                url: "action.php",
                method: "POST",
                data:{amountPaid:amount_paid,mop:mop,refNum:reference_num,payment_date:payment_date,action:action},
                success:function(response){
                  Notify("INSERTED", "success");
                  fetch();
                }
              })
            }
          });
        });
      </script>


    </body>
    </html>
