<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- =================================================== -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DC Star Gazes | Dashboard</title>
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
            <!-- form start -->
            <form method="post" action="functions/incoming_so.php" class="form-group">
              <div class="box-body">
                <!--<?php echo $alertMessage ?>-->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Stock No. (SCxxxxxxxxx)</label>
                    <!--<input type="text" class="form-control" placeholder="SC No." name="SC_no" oninput="upperCase(this)" maxlength="50" required> -->
                    <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="scNum" required>
                      <?php
                      // Include config file
                      require_once "config.php";
                      // Attempt select query execution
                      $query = "";
                      $query = "SELECT * FROM stock ORDER BY custID, stock_status asc";
                      if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                          while($row = mysqli_fetch_array($result)){

                            echo "<option value='".$row['custID']."'>" .$row['custID']. " | " .$row['product_SKU']. " | " .$row['stock_status']."</option>";

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
                    <label>Customer</label>
                    <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="customer_ID" required>
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

                            echo "<option value='".$row['custID']."'>" . $row['lastName'] . ", " . $row['firstName'].  "</option>";
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
                    <label>Warehouse</label>
                    <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="warehouse_name" required>
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
                  <!--
                  <div class="form-group">
                  <label>Quantity</label>
                  <input type="text" class="form-control" placeholder="Quantity" name="qty" oninput="upperCase(this)" maxlength="50" required>
                </div>
              -->
              <!--
              <div class="form-group">
              <label>Sell Price</label>
              <input type="text" class="form-control" placeholder="Sell Price" name="sell_price" oninput="upperCase(this)" maxlength="50" required>
            </div>

            <div class="form-group">
            <label>Detail</label>
            <textarea class="form-control" rows="3" maxlength="300" id="" oninput="upperCase(this)" placeholder="This text area has a limit of 300 char" name="product_detail"></textarea>
          </div>
        -->
      </div>
      <div class="col-md-6 ">
        <table class="table table-borderless ">
          <thead>
            <tr>
              <th>Option</th>
              <th>Stock No.</th>
              <th>Description</th>
              <th>Qty</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>


              <?php
              require_once ('config.php');

              $query  = "SELECT * from sales_order";
              $result = mysqli_query($link, $query);

              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td><a href='#' methodtitle='Remove Item' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a></td>";
                  echo "<td>" .$row['stock_ID']. "</td>";
                  echo "<td>" .$row['so_desc']. "</td>";
                  echo "<td>" .$row['so_qty']. "</td>";
                  echo "<td>" .$row['so_price']. "</td>";
                  echo "</tr>";

                }
              } else {
                echo "<center>0 results on database</center>";
              }

              //mysqli_close($link);

              ?>
              <!--  <td>1</td>
              <td>SC1234567890</td>
              <td>GRN_APPLE</td>
              <td>1</td>
              <td>25</td>
            </tr>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>DISCOUNT:</td>
            <td>0</td>
          </tr>
          <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>TAX:</td>
          <td>0</td>-->


        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>GRANDTOTAL:</td>
          <td>25</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<div class="box-footer">
  <a class="btn btn-primary" data-toggle="modal" data-target="#modal-add-product" >Add Product</a>
  <button class="btn btn-primary" type="submit" name="add" value="add" >List Product</button>
  <a class="btn btn-default" data-toggle="modal" data-target="#" >Other</a>
  <a class="btn btn-default" data-toggle="modal" data-target="#" >Other</a>
  <a class="btn btn-default" data-toggle="modal" data-target="#" >Other</a>
  <a class="btn btn-default" data-toggle="modal" data-target="#" >Other</a>

  <a class="btn btn-success" data-toggle="modal" data-target="#modal-checkout" >Check out</a>
</div>
</form>

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
          <form method="post" action="functions/incoming_so.php">
            <div class="form-group">
              <label>Stock No. (SCxxxxxxxxx)</label>
              <!--<input type="text" class="form-control" placeholder="SC No." name="SC_no" oninput="upperCase(this)" maxlength="50" required> -->
              <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="warehouse_name" required>
                <?php
                // Include config file
                require_once "config.php";
                // Attempt select query execution
                $query = "";
                $query = "SELECT * FROM stock ORDER BY custID, stock_status asc";
                if($result = mysqli_query($link, $query)){
                  if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_array($result)){

                      echo "<option value='".$row['custID']."'>" .$row['custID']. " | " .$row['product_SKU']. " | " .$row['stock_status']."</option>";

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
            <a href="" class="btn btn-default btn" data-dismiss="modal">No</a>
            <button class="btn btn-success btn" name="incoming_so_btn" value="incoming_so_btn" type="submit">Add</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </form>
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal modal-default fade" id="modal-checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <td>CACHILA, VINCE</td>
              </tr>
              <tr>
                <td><label>Warehouse:</label></td>
                <td>MAIN WAREHOUSE</td>
              </tr>
              <tr>
                <td><label>No. of Items:</label></td>
                <td>1</td>
              </tr>
              <tr>
                <td><label>Discount:</label></td>
                <td>0.00</td>
              </tr>
              <tr>
                <td><label>Tax:</label></td>
                <td>0.00</td>
              </tr>
              <tr>
                <td><label>Grand Total:</label></td>
                <td>25</td>
              </tr>
            </table>


            <div class="form-group">
              <label>Mode of Payment</label>
              <select class="form-control" required>
                <option>Cash</option>
                <option>Bank Deposit</option>
                <option>Card</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <a href="" class="btn btn-default btn" data-dismiss="modal">Close</a>
            <a href="" class="btn btn-warning btn">Save</a>
            <a href="" class="btn btn-success btn">Print & Save</a>

          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </body>
  </html>
