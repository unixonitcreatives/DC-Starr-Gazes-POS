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
           Generate Sales Invoice<br>
          <small>DC Starr Gazes Inventory Management System</small>
        </h1>
      </section>
    <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
<div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Sales Invoice's Details</h3>
            <br><a href="si-manage.php" class="text-center">Manage Sales Invoice</a>
          </div>
          <!-- /.box-header -->
          <!-- form start   action="functions/incoming_so.php-->
          <form action="functions/incoming_si.php">
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
                  <!--<label>Username</label>-->
                  <input type="hidden" class="form-control" id="username_ID" name="username_ID" value=<?php echo $_SESSION['username']; ?> readonly>
                </div>


                <!--  <div class="form-group">
                <label>Warehouse</label>
                <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="warehouse_name" id="warehouse_name" required>
                <?php
                // Include config file
      //           require_once "config.php";
      //           // Attempt select query execution
      //           $query = "";
      //           $query = "SELECT * FROM warehouse ORDER BY warehouse_name asc";
      //           if($result = mysqli_query($link, $query)){
      //           if(mysqli_num_rows($result) > 0){

      //           while($row = mysqli_fetch_array($result)){

      //           echo "<option value='".$row['custID']."'>" . $row['warehouse_name'] .  "</option>";
      //         }

      //         // Free result set
      //         mysqli_free_result($result);
      //       } else{
      //       echo "<p class='lead'><em>No records were found.</em></p>";
      //     }
      //   } else{
      //   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      // }

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
</div>
</section>
<!-- /.content-wrapper -->
</div>



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
            INNER JOIN  categories c on c.category_name=b.product_description
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

            //mysqli_close($link);

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
        <button id="btnsave" class="btn btn-warning btn" onclick="logs()">Save</button>
      </div>
    </div>
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- =========================== JAVASCRIPT ========================= -->
<?php include('template/js.php'); ?>

<?php
                            $IDtype = "SI";
                            $m = date('m');
                            $y = date('y');
                            $d = date('d');

                            // Attempt select query execution
                            $qry = mysqli_query($link,"SELECT MAX(soID) FROM `sales_order`"); // Get the latest ID sa database ng sales_order
                            $resulta = mysqli_fetch_assoc($qry);
                            $newID = $resulta['MAX(soID)'] + 1; //Get the latest ID then Add 1
                            $custID = str_pad($newID, 5, '0', STR_PAD_LEFT); //Prepare custom ID with 8 Paddings
                            $custnewID = $IDtype.$m.$d.$y.$custID;

?>

<script>
  
  function logs() {
    
    var custnewID = $('#custnewID').val();
    var session = '<?php echo $_SESSION['username']; ?>';
    var info =  session + ' added a new invoice';
    var info2 = 'Details: Transaction ID: <?php echo $custnewID; ?>';
    var url_t = 'logs-query.php';

    $.ajax({
      type: 'POST',
      url: 'logs-query.php',
      data: {'info2':info2, 'info':info},
      success:function(d){
         $('#modal-checkout').modal('hide');
         location.reload();
      } 
    });
    
  }

</script>

<!-- =========================== FOOTER =========================== -->
<footer class="main-footer">
<?php include('template/footer.php'); ?>
</footer>
