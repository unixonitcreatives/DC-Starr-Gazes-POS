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

                <b>Mode of Payment:</b>
                  <?php
                  echo $mop;
                  ?>



            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product Description</th>
                    <th>qty</th>
                    <th class='pull-right'>Total Price</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  require_once "config.php";
                  $query = "SELECT so_desc, SUM(so_qty) as Qty, SUM(so_price) as Price from sales_order WHERE txID = '$SI' GROUP BY so_desc ";
                  $result = mysqli_query($link, $query) or die(mysqli_error($link));
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)){

                      $totalPrice  =  $row['Price'];

                      echo "<tr>";
                      //echo "<td>" .$row['po_trans_id'] . "</td>";
                      //echo "<td>" . $row['delivery'] . "</td>";
                      //echo "<td>" . $row['stock_ID'] . "</td>";
                      echo "<td>" . $row['so_desc'] . "</td>";
                      echo "<td>" . $row['Qty'] . "</td>";

                      echo "<td class='pull-right'>₱ " . number_format($row['Price'],2) . "</td>";

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
                $query = "SELECT SUM(so_price)as totalPrice, SUM(discount) as Discount  from sales_order WHERE txID = '$SI'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)){

                    $gDiscount = $row['Discount'];
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
                      <h4> ₱ <?php echo number_format((float)$totalPrice,2);?></h4>
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
        <form  method="POST"  class="pull-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $users_id; ?>">
            <button onclick="Print()" target="_blank" class='btn btn-primary' name='Approved'> Print</button>
            <button onclick="Print()" target="_blank" class='btn btn-secondary' name='Approved'> Void</button>
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
</script>


</body>
</html>
