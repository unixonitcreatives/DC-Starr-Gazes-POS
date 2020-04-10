<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
$Admin_auth = 1;
$Manager_auth = 0;
$Cashier_auth = 0;
include('template/user_auth.php');
$alertMessage=$firstname=$lastname=$address=$phone=$name="";
?>
<!-- ================================================================ -->
<?php
// Define variables and initialize with empty values
$status="";


require_once "config.php";

$trans_id = $_GET['txID'];

$query = "SELECT * from sales_order WHERE txID='$trans_id' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)){
    $row['soID'];
    $SI = $row['txID'];
    $scID = $row['stock_ID'];
    $desc = $row['so_desc'];
    $qty = $row['so_qty'];
    $price = $row['so_price'];
    $mop = $row['mop'];
    $name = $row['so_cust'];
    $order_date = $row['created_at'];
      //$row['mop'];

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
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="header">
              <div class="col-xs-3">
                <img class="img-responsive" src="dist/logo-01.png">
                <br>
              </div>
              <small class="pull-right">
                <button onclick="window.history.back()" target="_blank" class="btn btn-default no-print" ><i class="fa fa-arrow-left">&nbsp;Back</i></button>
                <button onclick="Print()" target="_blank" class="btn btn-default no-print" ><i class="fa fa-print">&nbsp;Print</i></button>
              </small>

            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">

            <address>To:
              <strong>
                <?php echo $firstname." ".$lastname; ?>
              </strong>
              <br>Contact No:
              <?php echo $phone; ?>
              <br>Address:
              <?php echo $address; ?>

            </address>
          </div>
          <!-- /.col -->

          <input type="hidden" name="txID" id="txID" value="<?php echo $trans_id; ?>">

          <input type="hidden" name="stockID" id="stockID" value="<?php echo $stockID; ?>">
          <inpu type="count" name='count' id='count' value="<?php echo $qty; ?>">

            <div class="col-sm-4 invoice-col">

              <address>From:
                <strong>DC Starr Gasez</strong><br>
                Cavite City, Cavite
              </address>
            </div>

            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

              <b>Invoice &nbsp;</b>#
              <?php
              echo $SI;
              ?>

              <br>

              <b>Invoice Date &amp; Time:</b>
              <?php
              echo $order_date;
              ?>

              <br>

              <b>Cashier:</b>
              <?php


              $qq = "SELECT * FROM sales_order WHERE txID='$trans_id'";
              $rr = mysqli_query($link,$qq);

              while( $row = mysqli_fetch_assoc($rr) ){
                $created_by = $row['created_by'];
              } 

              ?>
              <strong><?php echo $created_by; ?></strong>

              <br>

              <b>Mode of Payment:</b>
              <?php
              $selectSOquery = "SELECT * from sales_order WHERE txID ='$trans_id' ";
              $SOresult = mysqli_query($link, $selectSOquery) or die(mysqli_error($link));
              if (mysqli_num_rows($SOresult) > 0) {

                while ($row = mysqli_fetch_array($SOresult)){
                  $qty = array('qty' => $row['so_qty']);
                  $sc = array('sc' => $row['stock_ID']);
                  $status = $row['mop'];
                  $stockID = $row['stock_ID'];
                  $id = $row['soID'];

                }
              }

              if($status == "Cash") {
                echo "<div class='badge bg-green'>" . $mop . "</div>";
              } 

              else if($status == "Void") {
                echo "<div class='badge bg-red'>" . $mop . "</div>";
              }

              else if($status == "Installment") {
                echo "<div class='badge bg-orange'>" . $mop . "</div>";
              }

              ?>



            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped" id='table-in'>
                <thead>
                  <tr>
                    <th>Stock ID</th>
                    <th>Product Description</th>
                    <th>qty</th>
                    <th class='pull-right'>Total Price</th>
                  </tr>
                </thead>

                <tbody id='stock-id'>
                  <?php
                  require_once "config.php";
                  $query = "SELECT stock_ID, so_desc, so_qty, so_price as Price from sales_order WHERE txID = '$SI' ";
                  $result = mysqli_query($link, $query) or die(mysqli_error($link));
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)){

                      $totalPrice  =  $row['Price'];

                      echo "<tr >";
                      //echo "<td>" .$row['po_trans_id'] . "</td>";
                      //echo "<td>" . $row['delivery'] . "</td>";
                      echo "<td>" . $row['stock_ID'] . "</td>";
                      echo "<td>" . $row['so_desc'] . "</td>";
                      echo "<td>" . $row['so_qty'] . "</td>";

                      echo "<td class='pull-right'>₱ " . number_format($totalPrice,2) . "</td>";

                      echo "</tr>";
                    }

                    $num_rows = mysqli_num_rows($result);
                    // Free result set
                    mysqli_free_result($result);
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }

                  ?>


                </tbody>



                <?php
                require_once "config.php";
                $query = "SELECT SUM(so_price)as totalPrice, discount  from sales_order WHERE txID = '$SI'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)){

                    $gDiscount = $row['discount'];
                    $Total = $row['totalPrice'];

                  }

                  $gTotal = $Total-$gDiscount;

                }


                ?>

                <tfooter>
                  <td>No of Items : <?php echo $num_rows; ?></td>
                  <td></td>
                  <td align="right">
                    <h4>Sub-total: &nbsp;</h4>
                    <h4>Discount: &nbsp;</h4>
                    <h4>Grand Total: &nbsp;</h4>
                  </td>
                  <td>
                    <h4> ₱ <?php echo number_format((float)$Total,2);?></h4>
                    <h4> ₱ <?php echo number_format((float)$gDiscount,2);?></h4>
                    <h4> ₱ <?php echo number_format((float)$gTotal,2);?></h4>
                  </td>
                </tfooter>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <form  method="POST"  class="pull-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?txID=<?php echo $trans_id; ?>">

                <button onclick="Print()" target="_blank" class='btn btn-primary' name='Approved'> Print</button>

                <?php 
                if($mop == 'Void'){

                  echo "<button type='submit' class='btn btn-secondary' name='Void' id='void' disabled> Void</button>";

                }else {

                  echo "<button type='submit' class='btn btn-secondary' name='Void' id='void'> Void</button>";

                }

                ?>
              </form>

            </div>
          </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
      </div>

      <!-- =========================== FOOTER =========================== -->
      <footer class="main-footer no-print">
        <?php include('template/footer.php'); ?>
      </footer>


      <!-- =========================== JAVASCRIPT ========================= -->
      <?php include('template/js.php'); ?>
      <script>
        function Print() {
          window.print();
        }

        function voidSI() {

          var txID = $('#txID').val();
          $('#stock-id tr').each(function(){
            var stockID = $(this).find('td:first').html();
            console.log(stockID);

            $.ajax({
              type: 'POST',
              url: 'void2-query.php',
              data: {'stockID':stockID, 'txID':txID},
              success:function(data){

              }
            });

          });
        }

        $('#void').click(function(evt){
          evt.preventDefault();
          if(confirm('Are you sure you want to void this invoice?')){
            voidSI();
            location.reload();
            logs();
          } else {
            evt.preventDefault();
          }

        });

        function logs() {

          var txID = $('#txID').val();
          var session = '<?php echo $_SESSION['username']; ?>';
          var info =  session + ' voided a invoice';
          var info2 = 'Details: Transaction ID: ' + txID;
          var url_t = 'logs-query.php';

          $.ajax({
            type: 'POST',
            url: 'logs-query.php',
            data: {'info2':info2, 'info':info},
            success:function(d){

           } 
         });
          
        }

      </script>


    </body>
    </html>
