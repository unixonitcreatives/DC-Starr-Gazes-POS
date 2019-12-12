<!-- ======================= SESSION =================== -->
<?php include('template/session.php');?>
<!-- =================================================== -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> DC Star Gazes | Dashboard</title>
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
           Generate SO<br>
          <small>DC Starr Gazes Inventory Management System</small>
        </h1>
      </section>
    <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Sales Order's Details</h3>
            <br><a href="so-manage.php" class="text-center">Manage SO</a>
          </div>
          <!-- /.box-header -->
          <!-- form start   action="functions/incoming_so.php-->
          <form action="functions/incoming_so.php">
            <div class="box-body">

              <!-- <?php echo $alertMessage; ?> -->

              <div class="col-md-6">
                <div class="form-group">
                  <label>Customer</label>
                  <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="customer_ID" id="customer_ID" required>
                    <?php
                    // Include config file
                    require_once "config.php";
                    // Attempt select query execution
                    $query = "";
                    $query = "SELECT * FROM customers ORDER BY lastName, firstName asc";
                    // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                    if($result = mysqli_query($link, $query)){
                      if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                          echo "<option value='".$row['custID']."'>" . $row['lastName'] . "," . $row['firstName'] .  "</option>";
                        }

                        // Free result set
                        mysqli_free_result($result);
                      } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                      }
                    } else{
                      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    ?>
                  </select>
                </div>


                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" id="username_ID" name="username_ID" value=<?php echo $_SESSION['username']; ?> disabled>
                </div>


                <!--  <div class="form-group">
                <label>Warehouse</label>
                <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="warehouse_name" id="warehouse_name" required>
                <?php
                // Include config file
                require_once "config.php";
                // Attempt select query execution
                $query = "";
                $query = "SELECT * FROM warehouse ORDER BY warehouse_name asc";
                if($result = mysqli_query($link, $query)){
                if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                echo "<option value='".$row['custID']."'>" . $row['warehouse_name'] .  "</option>";
              }

              // Free result set
              mysqli_free_result($result);
            } else{
            echo "<p class='lead'><em>No records were found.</em></p>";
          }
        } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }

      //mysqli_close($link);

      ?>
    </select>
  </div>

  <div class="form-group">
  <label>Quantity</label>
  <input type="text" class="form-control" placeholder="Quantity" name="qty" oninput="upperCase(this)" maxlength="50" required>
</div> -->

</div>

<div class="col-md-6 ">
<table class="table table-borderless " id="tOrders">
  <thead>
    <tr>
      <th>Description</th>
      <th>Category</th>
      <th>Qty</th>
      <th>Unit Price</th>
      <th>Total Price</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    <!--
    <?php
    require_once ('config.php');
    $desc=$qty=$price="";

    $query  = "SELECT so_desc AS DESCRIPTION, so_cat as CATEGORY, COUNT(so_qty) AS QTY, COUNT(so_unit_price) AS UNITPRICE, SUM(so_price) AS PRICE  from sales_order GROUP BY so_desc";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    $desc = $row['DESCRIPTION'];
    $cat = $row['CATEGORY'];
    $qty = $row['QTY'];
    $uprice = $row['UNITPRICE'];
    $price = $row['PRICE'];
    echo "<tr>";
    echo "<td>" . $desc . "</td>";
    echo "<td>" . $qty . "</td>";
    echo "<td>" . $price . "</td>";
    echo "</tr>";

  }
} else {
echo "<center>0 results on database</center>";
}

//mysqli_close($link);

?>

<?php
require_once 'config.php';
$gTotal="";
$totalQuery = "SELECT SUM(so_price) AS totalAmount FROM sales_order";
$totalResult = mysqli_query($link, $totalQuery);

while ($row = mysqli_fetch_assoc($totalResult)){
$gTotal = $row['totalAmount'];

}
?> -->


</tbody>
</table>
<span>GRAND TOTAL: <label id="grand_total">0</label></span>

</div>
<!-- /.box-body -->
</div>
</form>

<div class="box-footer">

<input type="text" class="my-input" id="my-putin" autofocus /><!--  style="width:0px;top:-100000px;height:0px;position:absolute;" /> -->

<a class="btn btn-primary" data-toggle="modal" data-target="#modal-add-product" >Add Product Manually</a>
<a class="btn btn-success" data-toggle="modal" data-target="#modal-checkout" >Check out</a>
</div>


</div>
<!-- /.box -->


</div>

</section>
<!-- /.content-wrapper -->
</div>

<!-- =========================== FOOTER =========================== -->
<footer class="main-footer">
<?php include('template/footer.php'); ?>
</footer>


<!-- =========================== JAVASCRIPT ========================= -->
<?php include('template/js.php'); ?>

<!-- =========================== MODAL ======================== -->

<div class="modal modal-default fade" id="modal-add-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-l" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">TYPE STOCK COUNT NUMBER</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Stock No. (SCxxxxxxxxx)</label>

          <!--<input type="text" class="form-control" placeholder="SC No." name="SC_no" oninput="upperCase(this)" maxlength="50" required> -->
          <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="warehouse_name" id="warehouse_name"  required>
            <?php
            // Include config file
            require_once "config.php";
            // Attempt select query execution
            $query = "";
            $query = "SELECT a.custID,a.warehouse_ID,b.product_description,
            b.product_SKU,b.suggested_retail_price,c.category_name
            FROM stock a
            INNER JOIN product_model b on b.product_SKU=a.PO_ID
            INNER JOIN  categories c on c.custID=b.product_category
            WHERE a.qty>0";
            if($result = mysqli_query($link, $query)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                  echo "<option value='".$row['custID']."'>" .$row['custID']. "-" .$row['product_description']. "</option>";


                }

                // Free result set
                mysqli_free_result($result);
              } else{
                echo "<p class='lead'><em>No records were found.</em></p>";
              }
            } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }

            mysqli_close($link);

            ?>
          </select>

        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default btn" data-dismiss="modal">No</button>
        <button class="btn btn-success btn" id="btnadd">Add</button>

      </div>
    </div>
  </div>
  <!-- /.modal-content -->
</form>
</div>




<!-- MODAL CHECKOUT -->
<div class="modal modal-default fade" name="modal-checkout" id="modal-checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-l" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ORDER SUMMARY</h4>
      </div>
      <div class="modal-body">

        <table class="table table-bordered table-striped">
          <tr>
            <td><label>Customer:</label></td>
            <td id="cust_name"></td>
          </tr>
          <tr>
            <td><label>No. of Items:</label></td>
            <td id="num_items"></td>
          </tr>
          <tr>
            <td><label>Grand Total:</label></td>
            <td id="grand_total1"></td>
          </tr>

          <tr>
            <td><label>Mode of Payment</label></td>
            <td>

                  <select class="form-control" id="mop_ID" required>
                    <option value="Cash">Cash</option>
                    <option value="Installment">Installment</option>
                  </select>
            </td>
          </tr>

          <tr>
            <td><label>Discount:</label></td>
            <td><input type="text" name="discount" id="discount" class="form-control"></td>
          </tr>
        </table>



      </div>
      <div class="modal-footer">
        <button class="btn btn-default btn" data-dismiss="modal">Close</button>
        <button id="btnsave" class="btn btn-warning btn">Save</button>
      </div>
    </div>
  </div>
  <!-- /.modal-dialog -->
</div>


</body>
</html>
