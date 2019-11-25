<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
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
                <!-- <div class="form-group">
                <label>Product</label>


                <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="product_SKU" id="product_SKU" required>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query execution
                        $query = "";
                        // original query niyo $query = "SELECT * FROM stock WHERE stock_status = 'In Stock' ";
                        $query="select product_description, product_sku from product_model order by product_description";
                        // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                          while($row = mysqli_fetch_array($result)){

                            // echo "<option value='".$row['custID']."'>" .$row['custID']. " | " .$row['PO_ID']. " | " .$row['stock_status']."</option>";

                             echo "<option value='".$row['product_sku']."'>" .$row['product_description']."</option>";

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
                  </div> -->


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

                            echo "<option value='".$row['custID']."'>" . $row['lastName'] . "," . $row['firstName'].  "</option>";
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
      <span>Discount/s:  <input type="number" id="discount"/ placeholder="0"><br>
      <span>GRAND TOTAL: <label id="grand_total">0</label></span>

    </div>
    <!-- /.box-body -->
  </div>
</form>

  <div class="box-footer">

  <input type="text" class="my-input" id="my-putin" autofocus style="width:0px;top:-100000px;height:0px;position:absolute;" />

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

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- =========================== PAGE SCRIPT ======================== -->

<!-- Alert animation -->
<script type="text/javascript">
$(document).ready(function () {

  window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
      $(this).remove();
    });
  }, 1000);

});
</script>
<script type="text/javascript">
 var orders=[];
    var custID;

  $(function () {

    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })


    // November 18, 2019
    // codes begins here
    document.addEventListener("keypress", function (e) {
        if (e.target.tagName !== "INPUT") {
            var input = document.querySelector("#my-putin");
            input.focus();
          if (e.key.charCodeAt() == 13) {
              input.focus();
          }
          input.value = input.value + e.key;
          e.preventDefault();
        }
       $('#my-putin').keypress(function (e) {
            var d = new Date();
            if (e.key == 'Enter') {
                var id = $('#my-putin').val();
                // lost focus on textbox
                $(this).blur();
                // check stock
                check_stock(id);
                // clear barcode scan text
                e.key = '';
            }
        });

        $('#my-putin').blur(function (e) {
            $('#my-putin').val('');

        });
    });
    // button save only. not save print
    $('#btnsave').on('click',function(){
        $.ajax({
          type: 'POST',
          url: 'so-checkout.php',
          // need to stringify array object list
          data: {'orders': JSON.stringify(orders)},
          dataType: 'json',
          success: function(data){
            if(data.success===true) //if success close modal and reload page
                {
                    $('#modal-checkout').modal('hide');
                    location.reload();
                }
          }
        });
    });
    //manual data entry
    $('#btnadd').on('click',function(){
        check_stock($('#warehouse_name').val());
         $('#modal-add-product').modal('hide');
    });
    //loop trough object in array
    function findObjectByKey(array, key, value) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][key] === value) {
                return array[i];
            }
        }
        return null;
    }

    function check_stock(id){

       $.ajax({
          type: 'POST',
          url: 'so-get_stocks.php',
          data: {'custID':id},
          dataType: 'json',
          success: function(response){

             if(response==null){
                Notify("No stocks.","");
             }else{
                var obj = findObjectByKey(orders, 'custID', response.custID);
                if(obj!=null){
                  Notify("Product already exist.","");
                  return;
                }
                var tmp={
                  so_cust:$('#customer_ID').val(),
                  custID:response.custID,
                  warehouseID:response.warehouse_ID,
                  product_SKU:response.product_SKU,
                  Description:response.product_description,
                  Category:response.category_name,
                  Qty:1,
                  UnitPrice:response.sell_price,
                  TotalPrice:response.sell_price*1

                }
                orders.push(tmp);
                get_orders();
             }
          }

        });

    }

  });
function get_orders(){
       var indx = 0;
       $('#tOrders').DataTable({
            destroy: true,
            paging: false,
            searching:false,
            lengthChange:false,
            data: orders,
            bInfo:false,
            columns: [
                { data: "Description" },
                { data: "Category" },
                { data: "Qty" },
                { data: "UnitPrice" },
                { data: "TotalPrice" },
                {
                    data: function (data) {
                        indx++;
                        return '<input id="' + indx + '"  type="button" class="btn btn-small btn-danger" value="-"  onclick="RemoveItem(\'' + data.custID + '\')" />';
                    }
                }
            ]
        });
       //bibilangin nya ung sales order items
       $('#num_items').text(orders.length);
       //computation para sa grand total ng mga inorder
       var grand_total=0;
       for (var i = 0; i < orders.length; i++) {
         grand_total=grand_total+orders[i].TotalPrice;
       }
        $('#grand_total').text(grand_total);
        $('#grand_total1').text(grand_total);
        $('#cust_name').text($('#customer_ID option:selected').text());
        console.log(orders);
    }
  function RemoveItem(id){
    var r = confirm("Are you sure you want to remove " + id + "?" );
    if (r == true) {
      for(var i=0 ; i<orders.length; i++)
        {
            if(orders[i].custID==id)
                orders.splice(i);
        }

        get_orders();
      }
    }

</script>


  <!-- Notify -->
<script src="dist/js/notify.js"></script>
<!-- Notify -->
<script src="dist/js/notify.min.js"></script>

<script>

  function upperCase(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);

  }

  //Notify
  function Notify(msg,mode){
    $.notify(msg,mode,{ position:"top left" });
  }


  function submit()

  {
    $.notify("its asd","warn");
  }

</script>

<!-- Alert animation -->
<script type="text/javascript">
$(document).ready(function () {

  window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
      $(this).remove();
    });
  }, 1000);

});
</script>


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
                             b.product_SKU,b.sell_price,c.category_name
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
                    <td><label>Warehouse:</label></td>
                    <td>MAIN WAREHOUSE</td>
                  </tr>
                  <tr>
                    <td><label>No. of Items:</label></td>
                    <td id="num_items"></td>
                  </tr>
                  <tr>
                    <td><label>Discount:</label></td>
                    <td id="discount"></td>
                  </tr>
                  <tr>
                    <td><label>Grand Total:</label></td>
                    <td id="grand_total1"></td>
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
                <button class="btn btn-default btn" data-dismiss="modal">Close</button>
                <button id="btnsave" class="btn btn-warning btn">Save</button>
                <button id="btnsaveprint" class="btn btn-success btn">Print &amp; Save</button>
              </div>
            </div>
          </div>
          <!-- /.modal-dialog -->
    </div>


</body>
</html>
